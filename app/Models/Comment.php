<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Comment extends Model
{
   protected $table = 'common_comments';
    
    protected $fillable = ['customer_id', 'user_id', 'post_id', 'file', 'comment', 'is_pimage', 'type', 'is_best_answer', 'created_at', 'updated_at','user_type'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


    public function get_answers($post_id,$customer_id,$time="recent",$type,$allpost="",$user_type){
		
        $where2['common_comments.post_id']=$post_id;
        $where2['common_comments.type']=$type;
        if($allpost!='all'){
            $where2['common_comments.customer_id']=$customer_id;
        }
        
        if($user_type!='all'){
            $where2['common_comments.user_type']=$user_type;
        }

        if($time=="recent"){
            $order_by='common_comments.id desc';
        }else{
            $order_by='common_comments.id asc';
        }
        $commentsData = $this->select('common_comments.*')->where($where2)
        ->orderBy($order_by)->get();
        if($commentsData){
            foreach ($commentsData as $key => $comment) {
				$commentsData[$key]->customer_info = "";
				$commentsData[$key]->customer_info = DB::table('users')->select('users.*')->where(['customer.id'=>$comment->customer_id])->first();
				// if(isset($commentsData[$key]->customer_info->customer_profile) && !empty($commentsData[$key]->customer_info->customer_profile)){
				// 	// $commentsData[$key]->customer_info->customer_profile = site_url('uploads/front/account_settings/').$commentsData[$key]->customer_info->customer_profile;
					

				// }
				
			}
        }
        return $commentsData;
		
	}

    public function get_answers_reply($post_id,$comment_id){
	
        $where2=array('common_comments_reply.post_id'=>$post_id,'common_comments_reply.comment_id'=>$comment_id);
		// ,'common_comments_reply.user_id'=>0
        $order_by='common_comments_reply.id asc';

        $commentsData = DB::table('common_comments_reply')->select('common_comments_reply.*')->where($where2)
        ->orderBy($order_by)
        ->get()->getResult();

        if($commentsData){
            foreach ($commentsData as $key => $comment) {
                $commentsData[$key]->customer_info = "";
                $commentsData[$key]->user_info = "";
                $commentsData[$key]->customer_info = DB::table('users')->select('users.*')->where(['users.id'=>$comment->customer_id])->first();
    //             if(isset($commentsData[$key]->customer_info->customer_profile) && !empty($commentsData[$key]->customer_info->customer_profile)){
				// 	 $commentsData[$key]->customer_info->customer_profile = site_url('uploads/front/account_settings/').$commentsData[$key]->customer_info->customer_profile; 
					
				// }
                
            }
        }

        return $commentsData;
       
    }
    
	public function get_answers_sub_reply($post_id,$comment_id){
		$aws = new Aws();
        $where2=array('common_comments_reply.post_id'=>$post_id,'common_comments_reply.comment_id'=>$comment_id,'common_comments_reply.user_id!='=>0);

        $order_by='common_comments_reply.id asc';

        $commentsData = DB::table('common_comments_reply')->select('common_comments_reply.*')->where($where2)
        ->orderBy($order_by)
        ->get()->getResult();

        if($commentsData){
            foreach ($commentsData as $key => $comment) {
                $commentsData[$key]->customer_info = "";
                $commentsData[$key]->user_info = "";
                if($comment->user_type=='customer'){
                    $commentsData[$key]->customer_info = DB::table('customer')->select('customer_info.*,customer_info.fname as name,upload_images.file as customer_profile')->leftJoin('customer_info','customer_info.user_id=customer.id')->leftJoin('upload_images','upload_images.id=customer_info.image_id')->where(['customer.id'=>$comment->customer_id])->get()->getRow();
                    $commentsData[$key]->user_info = DB::table('customer_info')->select('customer_info.fname as name')->where(['customer_info.user_id'=>$comment->user_id])->get()->getRow();
                    if(isset($commentsData[$key]->customer_info->customer_profile) && !empty($commentsData[$key]->customer_info->customer_profile)){
						/* $commentsData[$key]->customer_info->customer_profile = site_url('uploads/front/account_settings/').$commentsData[$key]->customer_info->customer_profile; */
						$pathInS31 = 'customer/'.$commentsData[$key]->customer_info->customer_profile;
						$fileImage1 = $aws->getAWSImages($pathInS31);
						$commentsData[$key]->customer_info->customer_profile = $fileImage1;
					}
                } else if($comment->user_type=='astrologer'){
                    $commentsData[$key]->customer_info = DB::table('astrologer_details')->select('astrologer_details.*,upload_images.file as customer_profile')->leftJoin('upload_images','upload_images.id=astrologer_details.image')->where(['astrologer_details.id'=>$comment->customer_id])->get()->getRow();
					$commentsData[$key]->user_info = DB::table('astrologer_details')->select('astrologer_details.name')->where(['astrologer_details.user_id'=>$comment->user_id])->get()->getRow();
                    if(isset($commentsData[$key]->customer_info->customer_profile) && !empty($commentsData[$key]->customer_info->customer_profile)){
						/* $commentsData[$key]->customer_info->customer_profile = site_url('uploads/admin/astrologer_details/').$commentsData[$key]->customer_info->customer_profile; */
						$pathInS31 = 'astrologer/'.$commentsData[$key]->customer_info->customer_profile;
						$fileImage1 = $aws->getAWSImages($pathInS31);
						$commentsData[$key]->customer_info->customer_profile = $fileImage1;
					}
                } else if($comment->user_type=='pandit'){
                    $commentsData[$key]->customer_info = DB::table('pandit_details')->select('pandit_details.*,upload_images.file as customer_profile')->leftJoin('upload_images','upload_images.id=pandit_details.image')->where(['pandit_details.id'=>$comment->customer_id])->get()->getRow();
					$commentsData[$key]->user_info = DB::table('pandit_details')->select('pandit_details.name')->where(['pandit_details.user_id'=>$comment->user_id])->get()->getRow();
                    if(isset($commentsData[$key]->customer_info->customer_profile) && !empty($commentsData[$key]->customer_info->customer_profile)){
						/* $commentsData[$key]->customer_info->customer_profile = site_url('uploads/admin/pandit_details/').$commentsData[$key]->customer_info->customer_profile; */
						$pathInS31 = 'pandit/'.$commentsData[$key]->customer_info->customer_profile;
						$fileImage1 = $aws->getAWSImages($pathInS31);
						$commentsData[$key]->customer_info->customer_profile = $fileImage1;
					}
                }
            }
        }

        return $commentsData;
       
    }

    public function formatSizeUnits($bytes)
    {
	        if ($bytes >= 1073741824)
	        {
	            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
	        }
	        elseif ($bytes >= 1048576)
	        {
	            $bytes = number_format($bytes / 1048576, 2) . ' MB';
	        }
	        elseif ($bytes >= 1024)
	        {
	            $bytes = number_format($bytes / 1024, 2) . ' KB';
	        }
	        elseif ($bytes > 1)
	        {
	            $bytes = $bytes . ' bytes';
	        }
	        elseif ($bytes == 1)
	        {
	            $bytes = $bytes . ' byte';
	        }
	        else
	        {
	            $bytes = '0 bytes';
	        }

	        return $bytes;
	}
}
