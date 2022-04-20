<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;

use Carbon\Carbon;
use DB;
use Session;

class ManageNotesController extends Controller
{
	
	public function __construct()
    {
		$this->_arr_destinations_list = Utilities::get_destination_types_list();        
	}
	
    public function getIndex()
    {
		//$advertisement_category = AdvertisementCategory::pluck('category', 'id');
		return view('admin.notes.index');
    }
	
    public function getList()//, $category_id
    {
		//DB::enableQueryLog();
# your laravel query builder goes here
		
        $notes = \App\Models\Note::select(['notes.*', DB::raw("CONCAT(u.first_name,' ',u.last_name) AS user_name_new"),
		'p.name as product_name','u.name as user_full_name'])->with(['product_data','user_data']);
        
		$notes->leftJoin('users as u', 'notes.assign_profile_id', '=', 'u.id');
		$notes->leftJoin('products as p', 'notes.assign_product_id', '=', 'p.id');
				
		return \DataTables::of($notes)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
           
            ->editColumn('name_data', function ($query) {
                
				if(!empty($query->destination_id) && $query->destination_id == 1)
				{
				   $str_user_name = Utilities::getUserName(@$query->user_data);
					
				   if(!empty(@$query->user_data->name))
					return @$query->user_data->name;
				   else
					return @$str_user_name;	
				}
				
				if(!empty($query->destination_id) && $query->destination_id == 2)
				{
				    return @$query->product_data->name;
				}	
				
				//$laQuery = DB::getQueryLog();

      //print_r($laQuery);
				
            })
            ->make();
					   			   
			
	# optionally disable the query log:
//	DB::disableQueryLog();	
			
    }

    public function getDelete($id)
    {

		try {
        
            DB::beginTransaction();
			
			Note::where('id', $id)->delete();
			
            DB::commit();
			 $message = ['msg' => adminTransLang('success')];
            return response()->json($message, 200);
	    } catch (\Exception $e) {
            DB::rollback();
            throw $e;
		    return errorMessage($e->getMessage(), true);            
        }
    }
	
	public function showAddNotes(Request $request)
    {
		echo $this->saveAddEditNotes($request, 0);
	}

    public function showEditNotes(Request $request, $notes_id)
    {
      echo $this->saveAddEditNotes($request, $notes_id);
        
	}	
	
	public function saveAddEditNotes(Request $request, $notes_id)
    {
		
		$notes_id_edit_mode = $notes_id;
		$error_msg = '';
		$int_destination_id = 0;
		
      $int_assign_product_id = $int_assign_profile_id = $notes_data = $page_type = 0;
		
		if ($request->isMethod('post')) 
        {
			
			$destination_id = $request->input('notes_meta.destination_id');
				// dd($request->all());		 
			 $data = array();
			 $data_media = '';
			 //$gallery_type = 1;
			 
			 $rules = [
			'notes_meta.destination_id' => 'required',
			'notes_meta.notes_1' => 'required',
			'notes_meta.notes_2' => 'required',
			'notes_meta.notes_3' => 'required',
			];
			
			if($destination_id == 1)
			{
				$rules['notes_meta.assign_profile_id'] = 'required';
			}
			
			if($destination_id == 2)
			{
				$rules['notes_meta.assign_product_id'] = 'required';
			}
		 
		   $this->validate($request, $rules);
			 
			//$request->validate(Gallery::validateGallery());
			try {
				
				DB::beginTransaction();
				
				$destination_id = $request->input('notes_meta.destination_id');
				
				$assign_product_id = $request->input('notes_meta.assign_product_id');
				$assign_profile_id = $request->input('notes_meta.assign_profile_id');
				
				$notes_1 = $request->input('notes_meta.notes_1');
				$notes_2 = $request->input('notes_meta.notes_2');
				$notes_3 = $request->input('notes_meta.notes_3');
				
				if(empty($assign_product_id))
				{
				  $assign_product_id = 0;	
				}
				
				if(empty($assign_profile_id))
				{
				  $assign_profile_id = 0;	
				}
				
				$data = [
						'destination_id' => $destination_id,
						'assign_product_id' => $assign_product_id,
						'assign_profile_id' => $assign_profile_id,
						'notes_1' => $notes_1,
						'notes_2' => $notes_2,
						'notes_3' => $notes_3,
						'status' => 1,
					];
					
				 if(!empty($notes_id))
				  $notes_data = Note::updateOrCreate(['id' => $notes_id], $data);
				 else
				  $notes_data = Note::create($data); 	 
				
				DB::commit();
				Session::flash('notes_data_saved_flag', 1); 

				return successMessage('');
			} catch (\Exception $e) {
				DB::rollback();
				throw $e;
				return errorMessage($e->getMessage(), true);
			}
		
    	}
		
		$arr_destinations_list = $this->_arr_destinations_list;		
		$arr_destinations_list_keys = array_keys($arr_destinations_list);
		
		if(!empty($notes_id))
		{
		  $notes_data  = Note::findOrFail($notes_id);
		  $int_destination_id = @$notes_data->destination_id;
		  $int_assign_product_id = @$notes_data->assign_product_id;
		  $int_assign_profile_id = @$notes_data->assign_profile_id;
		}
		
		return view('admin.notes.add_update_notes', 
		['arr_destinations_list' => $arr_destinations_list, 'int_destination_id' => $int_destination_id,
'int_assign_product_id' => $int_assign_product_id, 'int_assign_profile_id' => $int_assign_profile_id, 
'arr_destinations_list_keys' => $arr_destinations_list_keys, 
		'notes_data' => $notes_data, 'notes_id' => $notes_id, 'page_type' => $page_type]);
	
	}
	
	public function getUserProductEvents(Request $request)
    {
		$dest_id = $request->dest_id;
		$int_product_id = $request->int_product_id;
		$int_profile_id = $request->int_profile_id;
		$page_type = $request->page_type;
		$arr_product_data = Product::get_product_list_dropdown();
	    $arr_user_data = User::get_all_user_list_by_email_name();
		
        return view('admin.includes.get_event_product_dropdown', ['arr_product_data' => $arr_product_data, 'arr_user_data' => $arr_user_data, 'dest_id'=>$dest_id, 'int_product_id' => $int_product_id, 'int_profile_id' => $int_profile_id, 'page_type'=>$page_type]);
    }

}
