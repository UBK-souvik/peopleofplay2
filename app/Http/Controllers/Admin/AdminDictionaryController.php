<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dictionary;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class AdminDictionaryController extends Controller
{
    public function getIndex()
    {
        return view('admin.dictionary.index');
    }

    public function getList()
    {
        $dictionary = \App\Models\Dictionary::select('*')->with(['user']);
        return \DataTables::of($dictionary)
		    ->addColumn('name_new', function ($query) {
				
				if(!empty($query->user->name))
				{
                  return $query->user->name;
				}
				else
				{
				  return @$query->user->first_name . ' ' . @$query->user->last_name;	
				}	
				
            }) 
            ->editColumn('status', function ($query) {
                return config('cms.dictionary_status')[@$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        $users = User::get_total_user_list_by_email();
		return view('admin.dictionary.create', compact('users'));
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'dictionary_id' => 'nullable|exists:dictionaries,id',
            'user_id' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:0,1'
        ]);

        if(!empty($request->user_id) ) {
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only(Dictionary::$fillable_shadow);
			
			$int_dictionary_id = $request->dictionary_id;
			
			if(empty($request->user_id))
			{
			  $data['added_by'] = 2; 	
			}
			else
			{
			  $data['added_by'] = 1;	
			}
			
			$str_date_to_be_published =  $data['date_to_be_published'];			
			
			$dictionary_chk_dup_data = Dictionary::select('id', 'title')->where('date_to_be_published', $str_date_to_be_published)->first();
			
			// if there is already a word on this date show a message
			if(!empty($str_date_to_be_published) && $request->confirm_flag>0 && !empty($dictionary_chk_dup_data->id) && $dictionary_chk_dup_data->id>0)
			{
			   DB::rollback();	
				   return response()->json([
					'status' => 2,
					'msg' => "There is already a word '".$dictionary_chk_dup_data->title."' on this date. Do you want to over ride?",
				], 200);
			
			}
			
			// update all the previous word of day to null
			$dictionary_update = Dictionary::where('date_to_be_published', $str_date_to_be_published)
				->update(['date_to_be_published' => '']);
			
            Dictionary::updateOrCreate(['id' => $int_dictionary_id], $data);

            DB::commit();
			Session::flash('dictionary_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
	
	

    public function getUpdate($id)
    {
        $dictionary  = Dictionary::findOrFail($id);
        $users = User::get_total_user_list_by_email();
        
		return view('admin.dictionary.create', compact('dictionary', 'users'));
    }

    public function getDelete($id)
    {
        $blog  = Dictionary::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
	
	// for calendar page
	public function getCalendarDictionary(Request $request)
    {
		$str_current_selected_date_new = '';
		$dictionary_chk_data = '';
		
		if( $request->has('current_selected_date') ) {
                 $str_current_selected_date_new = $request->query('current_selected_date');
               }
			   
		if(!empty($str_current_selected_date_new))
		{			
		  $dictionary_chk_data = Dictionary::select('id', 'description')->where('date_to_be_published', $str_current_selected_date_new)->first();	   
        }
		
		//where('status', 1)->
	    $words_list = Dictionary::orderBy('title', 'asc')->groupBy('id')->pluck('title', 'id');	  	  
	    
        return view('admin.dictionary.calendar_dictionary', compact('words_list', 'str_current_selected_date_new', 'dictionary_chk_data'));
    }
	
	public function getDictionaryDescription($word_id)
    {
		
        try {
            DB::beginTransaction();

            
			$dictionary_data = Dictionary::select('id','description')->where('id', $word_id)->first();
			
            DB::commit();
			Session::flash('dictionary_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'description' => @$dictionary_data->description,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
	
	public function postDictionaryCalendar(Request $request)
    {
		$str_tag = '';

        try {
            DB::beginTransaction();

			$str_date_to_be_published =  $data['date_to_be_published'] = $request->date_to_be_published;

            $int_dictionary_id = $data['word_id'] = $request->word_id;  			
			
			$dictionary_chk_dup_data = Dictionary::select('id', 'title')->where('date_to_be_published', $str_date_to_be_published)->first();
			
			// if there is already a word on this date show a message
			if(!empty($str_date_to_be_published) && $request->confirm_flag>0 && !empty($dictionary_chk_dup_data->id) && $dictionary_chk_dup_data->id>0)
			{
			   DB::rollback();	
				   return response()->json([
					'status' => 2,
					'msg' => "There is already a word '".$dictionary_chk_dup_data->title."' on this date. Do you want to over ride?",
				], 200);
			
			}
			
			// update all the previous word of day to null
			$dictionary_update = Dictionary::where('date_to_be_published', $str_date_to_be_published)
				->update(['date_to_be_published' => '']);
			
            Dictionary::updateOrCreate(['id' => $int_dictionary_id], $data);

            DB::commit();
			Session::flash('dictionary_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }


}
