<?php

namespace App\Http\Controllers\Front;

use App\Models\Feed;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\FeedBack;
use App\Models\ProductOfficialLink;
use App\Models\MetaData;
use App\Models\Gallery;
use App\Models\GalleryProductTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryPeopleTag;
use App\Models\Report;
use App\Models\GalleryOtherTag;
use App\Models\MediaList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;
use App\Models\Tag;
use App\Models\Feed_like;
use Illuminate\Support\Facades\Hash;
use Validator;

class FeedsController extends ModuleController
{

  /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

  public function __construct()
  {
   parent::__construct();   
   $this->_current_url = url()->current();
   $this->_create_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'create');
   $this->_delete_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'delete');
   $this->_main_gallery_url = Utilities::getGalleryUrls($this->_current_url, '');
   $this->_base_url = url('/'); 
}


    public function commentSave(){

        $is_pimage = $this->request->getVar('is_pimage');
        $code = $this->request->getVar('pimage_code');
        // $images = $this->base_model->select_data('upload_images',array('code'=>$code));
        $images = $this->db->table('upload_images')->select('upload_images.*')->where(array('code'=>$code))->get()->getResult();
        $files_array='';
        foreach($images as $img){
            $files_array .= $img->id.',';	
        }
        // echo rtrim($files_array,',');die;
        $files =rtrim($files_array,',');
        $data =array(
            'customer_id'=>session()->get('id'),
            'post_id'=>$this->request->getVar('post_id'),
            'comment'=>trim($this->request->getVar('comment')),
            'is_pimage'=>trim($this->request->getVar('is_pimage')),
            'file'=>$files,
            'type' => trim($this->request->getVar('type')),
            'user_type' => trim($this->request->getVar('user_type')),
            'updated_at'=>time(),
            'created_at'=>time(),
        );
        $commentsModel = new Comment_model();
        $commentsModel->insert($data);
        // $uid = $this->base_model->insert_data('common_comments',$data);
        $answer_data = $this->get_comments(trim($this->request->getVar('type')),trim($this->request->getVar('time')),trim($this->request->getVar('post_id')),trim($this->request->getVar('url_type')),$this->request->getVar('post_slug'),$this->request->getVar('allpost'),$this->request->getVar('top_title'));
        $res =array('status'=>1,'answer_data'=>$answer_data);
        echo json_encode($res);die;
		
	}

public function featuredImage(){
				
				$path = 'front-assets/uploads/common_answer_images/';
				if (!is_dir($path)) {
				    mkdir($path, 0777, true);
				}
				$config = array(
					'upload_path'   => $path,
					'allowed_types' => 'pdf|jpg|png|jpeg|docx',
				);

               $this->load->library('upload', $config);

				$file_data = $errors=array();
   
				$count = count($_FILES['multiplefile']['name']);
				
				for($i=0;$i<$count;$i++){
    
				if(!empty($_FILES['multiplefile']['name'][$i])){
			
				  $_FILES['file']['name'] = $_FILES['multiplefile']['name'][$i];
				  $_FILES['file']['type'] = $_FILES['multiplefile']['type'][$i];
				  $_FILES['file']['tmp_name'] = $_FILES['multiplefile']['tmp_name'][$i];
				  $_FILES['file']['error'] = $_FILES['multiplefile']['error'][$i];
				  $_FILES['file']['size'] = $_FILES['multiplefile']['size'][$i];
		  
				 
				  $ext = pathinfo($_FILES['multiplefile']['name'][$i], PATHINFO_EXTENSION);
				  $new_name = time().'.'.$ext;
				  $config['file_name'] = $new_name;
		   
				   $this->upload->initialize($config);
			
				  if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();					
					$file_data[]  = $uploadData;
				  }else{
					 $errors[] =$this->upload->display_errors(); 
				  }
				}
		   
			  }
			  $errs_status=0;
			  $success_status =0;
			  $errs=$succ =$img_data='';
			  if(count($errors)>0){
				$errs_status=1;  
				$errs_imp = implode(',',$errors);
				$arr_err=array('file_error'=>$errs_imp);
				$errs = json_encode($arr_err);
			   }
			  if($this->input->post('pimage_code') !=''){
				  $code= $this->input->post('pimage_code');
			  }else{				  
				$code = rand().time();
			  }			  
			  if(count($file_data)>0){
				$success_status=1;  
				  foreach($file_data as $fdata){
						$data = array(
						'file'=>$fdata['file_name'],
						'code'=>$code,
						'ext'=>$fdata['file_ext'],
						'created_at'=>time(),
						'updated_at'=>time(),
						);
						$this->base_model->insert_data('upload_images',$data);
				  }
				  $idata['path']=$path;
				  $idata['image_data'] = $this->base_model->select_data('upload_images',array('code'=>$code));
				  $img_data = $this->load->view('comments/multiple_image_view',$idata,true);

			  }
			  
			  $res = array('success_status'=>$success_status,'errs_status'=>$errs_status,'img_data'=>$img_data,'error'=>$errs,'pimage_code'=>$code);
			  echo  json_encode($res);die;
			  
	}

	public function commentLike(){
	 	$likes = $this->db->table('common_comments_likes')->where(array('customer_id'=>session()->get('id'),'user_type'=>$this->request->getVar('user_type'),'post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'type'=>$this->request->getVar('type')))->get()->getRow();
         
		 if ($likes)
        {
	 		$this->db->table('common_comments_likes')->where(array('customer_id'=>session()->get('id'),'user_type'=>$this->request->getVar('user_type'),'post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'type'=>$this->request->getVar('type')))->delete();

	 		$likes_count = $this->db->table('common_comments_likes')->where(array('post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'type'=>$this->request->getVar('type')))->countAllResults();

            $jsonResp = array(
                "success" => 0,
                "likes_count" => $likes_count,
                "message" => 'Unlike Successfully.'
            );
        }else{
 		 	$data = array(
	 		 'customer_id'=>session()->get('id'),
	 		 'post_id'=>trim($this->request->getVar('post_id')),
	 		 'comment_id'=>trim($this->request->getVar('comment_id')),
	 		 'type' => $this->request->getVar('type'),
			'user_type' => trim($this->request->getVar('user_type')),
			 'created_at'=>time(),
 		 	);

	 		$this->db->table('common_comments_likes')->insert($data);
	 		$likes_count = $this->db->table('common_comments_likes')->where(array('post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'type'=>$this->request->getVar('type')))->countAllResults();
            $jsonResp = array(
                "success" => 1,
                "likes_count" => $likes_count,
                "message" => 'Like Successfully.'
            );
		        
        }
        $jsonResp['token'] = csrf_hash();
        return $this->response->setJSON($jsonResp);
	}

	public function commentReply(){
		$data['post_id'] =$this->request->getVar('post_id');
		$data['comment_id'] =$this->request->getVar('comment_id');
		$data['type'] =$this->request->getVar('type');
		$data['time'] =$this->request->getVar('time');
		$data['url_type'] =$this->request->getVar('url_type');
		$data['top_title'] =$this->request->getVar('top_title');
		$data['post_slug'] =$this->request->getVar('post_slug');
		$data['allpost'] =$this->request->getVar('allpost');
		$data['user_type'] = $this->request->getVar('user_type');
		$data['full_name'] = $this->request->getVar('full_name');
		$data['profile'] = $this->request->getVar('profile');
		$data['commReId'] = $this->request->getVar('commReId');
		$data['pimage_code'] = rand().time();
		$jsonResp['reply'] = view('front/comments/answer_reply',$data);
		$jsonResp['token'] = csrf_hash();
        return $this->response->setJSON($jsonResp);
	}

	public function commentReplySave(){
			$is_pimage = $this->request->getVar('is_pimage');
			$code = $this->request->getVar('pimage_code');
			$images = $this->db->table('upload_images')->where(array('code'=>$code))->get()->getResult();
			$files_array='';
			foreach($images as $img){
				$files_array .= $img->id.',';	
			}
			// echo rtrim($files_array,',');die;
			$files =rtrim($files_array,',');

			$commReId = $this->request->getVar('commReId');

			$commentsReply = $this->db->table('common_comments_reply')->where('id',$commReId)->get()->getRow();
			if($commentsReply){
				$user_id = $commentsReply->customer_id;
			}else{
				$user_id = 0;
			}

             $data =array(
             	'customer_id'=>session()->get('id'),
				'post_id'=>trim($this->request->getVar('post_id')),
				'comment_id'=>trim($this->request->getVar('comment_id')),
				'comment'=>trim($this->request->getVar('comment_reply')),
				'file'=>$files,
				'user_id'=>$user_id,
				'type'=>trim($this->request->getVar('type')),
				'user_type'=>trim($this->request->getVar('user_type')),
				'updated_at'=>time(),
				'created_at'=>time(),
			);
		$uid = $this->db->table('common_comments_reply')->insert($data);
		// echo $this->db->last_query();die();
		$answer_data = $this->get_comments(trim($this->request->getVar('type')),trim($this->request->getVar('time')),trim($this->request->getVar('post_id')),trim($this->request->getVar('url_type')),$this->request->getVar('post_slug'),$this->request->getVar('allpost'),$this->request->getVar('top_title'));
        $res =array('status'=>1,'answer_data'=>$answer_data);
        echo json_encode($res);die;
		 
	}

	public function commentReplyLike(){
	 	$likes = $this->db->table('common_comments_reply_likes')->where(array('customer_id'=>session()->get('id'),'user_type'=>$this->request->getVar('user_type'),'post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'comment_reply_id'=>$this->request->getVar('comment_reply_id'),'type'=>$this->request->getVar('type')))->get()->getRow();
		 if ($likes)
	 	 {
	 		$this->db->table('common_comments_reply_likes')->where(array('customer_id'=>session()->get('id'),'user_type'=>$this->request->getVar('user_type'),'post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'comment_reply_id'=>$this->request->getVar('comment_reply_id')))->delete();
	 		$likes_count = $this->db->table('common_comments_reply_likes')->where(array('post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'comment_reply_id'=>$this->request->getVar('comment_reply_id'),'type'=>$this->request->getVar('type')))->countAllResults();
            $jsonResp = array(
                "success" => 0,
                "likes_count" => $likes_count,
                "message" => 'Unlike Successfully.'
            );
	 	 }else{
 		 	$data = array(
	 		 'customer_id'=>session()->get('id'),
	 		 'post_id'=>trim($this->request->getVar('post_id')),
	 		 'comment_id'=>trim($this->request->getVar('comment_id')),
	 		 'comment_reply_id'=>trim($this->request->getVar('comment_reply_id')),
	 		 'type'=>$this->request->getVar('type'),
	 		 'user_type'=>$this->request->getVar('user_type'),
			 'created_at'=>time(),
 		 	);

	 		$this->db->table('common_comments_reply_likes')->insert($data);
	 		$likes_count = $this->db->table('common_comments_reply_likes')->where(array('post_id'=>$this->request->getVar('post_id'),'comment_id'=>$this->request->getVar('comment_id'),'comment_reply_id'=>$this->request->getVar('comment_reply_id'),'type'=>$this->request->getVar('type')))->countAllResults();
            $jsonResp = array(
                "success" => 1,
                "likes_count" => $likes_count,
                "message" => 'Like Successfully.'
            );
		        
        }
        $jsonResp['token'] = csrf_hash();
        return $this->response->setJSON($jsonResp);
	}

	public function delete_ans_image(){
		$this->base_model->delete_data('upload_images',array('id'=>$this->input->post('id')));
		$res =array('status'=>1);
		echo json_encode($res);die;
	}
	

	public function dropzonesData(){

        $validated = $this->validate([
            'image' => [
                'uploaded[file]'
                // 'max_size[file,4096]',
            ],
		]);

        if ($validated) {
            $avatar = $this->request->getFile('file');
            $fexist = ROOTPATH.'public/uploads/front/common_comment_images';
            if (!file_exists($fexist)) {
                mkdir($fexist, 0777, true);
            } 
            $path = 'public/uploads/front/common_comment_images';
            $ext = $avatar->getClientExtension();
            $new_name = time().'_'.rand(10,99).'.'.$ext;
            $avatar->move(ROOTPATH . $path,$new_name);
            $file_error = 0;
        }else{
            $m = json_encode($this->form_validation->getErrors());
	        $jsonResp = array(
	            "success" => 0,
	            "response" => $m
	        );
			$file_error = 1;
        }

		if($this->request->getVar('pimage_code') !=''){
		  	$code= $this->request->getVar('pimage_code');
	  	}else{				  
			//$code = rand().time();
	  	}	

		if($file_error == 0){
                $data = array(
                    'file'=>$new_name,
                    'code'=>$code,
                    'created_at'=>time(),
                    'updated_at'=>time(),
            );
            $this->db->table('upload_images')->insert($data);
            $insert_id = $this->db->insertID();
            //$file_data = $this->base_model->select_row('upload_images',array('id'=>$insert_id));
            $res = array('success_status'=>1,'pimage_code'=>$code,'pimage_id'=>$insert_id);
            echo  json_encode($res);die;
        }else{
            $res = array('success_status'=>0,'msg'=>$m);
                echo  json_encode($res);die;
        }
	}

	public function dropzonesDeleteComImage(){
		$path = ROOTPATH.'public/uploads/front/common_comment_images/';
		$upload_image = $this->db->table('upload_images')->where(array('id'=>$this->request->getVar('id')))->get()->getRow();
		if($upload_image->file!=''){
			unlink($path.$upload_image->file);
			$this->db->table('upload_images')->where(array('id'=>$this->request->getVar('id')))->delete();
		}
		$res =array('status'=>1);
		echo json_encode($res);die;
	}

	public function dropzonesFetchImages(){
		if($request == 'fetch'){
		  $fileList = [];
		  
		  $dir = $targetDir;
		  if (is_dir($dir)){
		    if ($dh = opendir($dir)){
		      while (($file = readdir($dh)) !== false){
		        if($file != '' && $file != '.' && $file != '..'){
		          $file_path = $targetDir.$file;
		          if(!is_dir($file_path)){
		             $size = filesize($file_path);
		             $fileList[] = ['name'=>$file, 'size'=>$size, 'path'=>$file_path];
		          }
		        }
		      }
		      closedir($dh);
		    }
		  }
		  
		  echo json_encode($fileList);
		  exit;
		}
	}

}