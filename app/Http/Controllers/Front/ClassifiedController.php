<?php

namespace App\Http\Controllers\Front;

use App\Models\Classified;
use App\Models\Feed;
use App\Models\User;
use App\Models\ClassifiedCategory;
use App\Models\ClassifiedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use Session;

class ClassifiedController extends ModuleController
{
	
    public function getClassifieds()
    {
        $current_user = get_current_user_info();
        
		$classifieds = Classified::where('user_id', $current_user->id)
            ->orderBy('id', 'desc')
            ->paginate(20);
			
        return view('front.user.classified.index', compact('classifieds'));
    }

    public function getCreateClassified(Request $request)
    {
		$classified_categories = ClassifiedCategory::pluck('name', 'id');
        return view('front.user.classified.create', compact('classified_categories'));
    }

    public function postCreateClassified(Request $request)
    {
        // echo "<pre>request - "; print_r($request->all()); die;
         $rules = [
        'classified_id' => 'nullable|exists:classifieds,id',
            'title' => 'required',
			'description' => 'required',
            
    ];
	
	$niceNames = [
            'title' => 'Title',
		     'description' => 'Description',
        
    ];
	
       $this->validate($request, $rules, [], $niceNames);

        try {

            // DB::beginTransaction();

            $current_user = get_current_user_info();
            $data = $request->only(Classified::$fillable_shadow);
            $data['user_id'] = $current_user->id;
			$data['added_by'] = 1;
			
			$data['status'] = 1;
			$data['description'] = $request->description;

            $classifiedData = Classified::updateOrCreate(['id' => $request->classified_id], $data);

            // echo "<pre>classifiedData - "; print_r($classifiedData); //die;
            if((isset($classifiedData) && !empty($classifiedData))  && !empty($request->feed_check == 'on')) {

                $feedData = array(
                    'user_id' => $current_user->id,
                    'type' => 6,
                    'title' =>$classifiedData['title'],
                    'caption' =>$classifiedData['description'],
                    'category_id' =>$classifiedData['category_id'],
                    'url' =>$classifiedData['profile_url'],
                    'product_name' => $classifiedData['slug'],
                    'time' => time(),
                    'check_post' => 1
                );
                // echo "<pre>feedData - "; print_r($feedData); die;  
                $feedInsert = Feed::updateOrCreate(['id' => $classifiedData['feed_id']], $feedData);
                Classified::where('id',$classifiedData->id)->update(['feed_id'=>$feedInsert->id]);
            }

            // DB::commit();
			Session::flash('classified_data_saved_flag', 1);
            return successMessage('Classified saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdateClassified($slug)
    {
        $current_user = get_current_user_info();
        $classified = Classified::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail();
		$classified_categories = ClassifiedCategory::pluck('name', 'id');	
        return view('front.user.classified.create', compact('classified', 'classified_categories'));
    }

    public function getDeleteClassified($slug)
    {
        $current_user = get_current_user_info();
        Classified::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail()
            ->delete();
			
		Session::flash('classified_data_deleted_flag', 1);	

        return redirect()->route('front.user.classified.index');
    }
	
	
	public function postClassifiedApplicant(Request $request)
	{
		$data = array();
		
		try {
       
                DB::beginTransaction();
             
			$current_user = get_current_user_info();
			$current_user_id = @$current_user->id;
			
			$int_classified_id = @$request->int_classified_id;
			
			$classified_applicant_row = ClassifiedApplication::where('applicant_user_id', $current_user_id)->where('classified_id', $int_classified_id)->first();
			
			
			$classified_data_row = Classified::where('id', $int_classified_id)->first();
			
			$classified_data_row_title = @$classified_data_row->title;
			$classified_data_row_user_id = @$classified_data_row->user_id;
			
			$user_data_row = User::where('id', $classified_data_row_user_id)->first();
			
			$str_user_email = $user_data_row->email;
			
			if(!empty($user_data_row->name))
			{
				$str_user_name = @$user_data_row->name;
			}
			else
			{
			   $str_user_name = @$user_data_row->first_name . ' '. @$user_data_row->last_name;	
			}
			
			if(!empty($current_user->name))
			{
				$str_current_user_name = @$current_user->name;
			}
			else
			{
			   $str_current_user_name = @$current_user->first_name . ' '. @$current_user->last_name;	
			}
              			
			$data['str_current_user_name'] = $str_current_user_name;
			$data['user_name'] = $str_user_name;
			$data['classified_title'] = $classified_data_row_title;
			$base_url = url('/');
			$str_user_url_new = Utilities::get_user_url($base_url, $current_user);
			
			$data['profile_user_link_url_new'] = $str_user_url_new;
			$data['mail_title'] =  'Response to POP Classified Ad - '. $classified_data_row_title;
			
			if(empty($classified_applicant_row->id))
			{
				$classified_applicant = new ClassifiedApplication();
				$classified_applicant->classified_id = $request->int_classified_id;
				$classified_applicant->applicant_user_id = $current_user->id;
				$classified_applicant->status = 1;
				$classified_applicant->added_by = 1;
				$classified_applicant->save();
				
				$this->send_mail_by_phpmailer(trim($str_user_email), $data['mail_title'], 'mail.auth.classified_creator', $data);
			}
			
         
            DB::commit();
            return successMessage('Application Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
		
	}
}
