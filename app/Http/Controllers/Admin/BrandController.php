<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\Brand;
use Carbon\Carbon;
use DB;
use Session;

class BrandController extends Controller
{
	
	public function __construct()
    {
		
	}
	
    public function getIndex()
    {
        return view('admin.brands.index');
    }
	
    public function getList()
    {
        $brands = \App\Models\Brand::select(['brands.id', 'brands.name', 'brands.status', 'brands.created_at']);
    	
		return \DataTables::of($brands)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);				
            })
            ->make();
    }

    public function getDelete($id)
    {
		$brand = \App\Models\Brand::find($id)->delete();
		
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddBrand(Request $request)
    {
		echo $this->saveAddEditBrand($request, 0);
	}

    public function showEditBrand(Request $request, $brand_id)
    {
        echo $this->saveAddEditBrand($request, $brand_id);        
	}	
	
	public function saveAddEditBrand(Request $request, $brand_id)
    {
		
		$brand_id_edit_mode = $brand_id;
		$error_msg = '';
		
		if ($request->isMethod('post')) 
        {
          $rules = [
				'name' => 'required',  				
            ];
			
    	    $niceNames = array();     
            $this->validate($request, $rules, [], $niceNames);
    			 
			try 
            {
				// Start Transaction
				\DB::beginTransaction();

				if(!empty($brand_id))
				{
				   $obj_brand = \App\Models\Brand::find($brand_id);
				   $obj_brand->updated_at = new \DateTime();
				}
				else
				{
				   $obj_brand = new \App\Models\Brand();
                   $obj_brand->status = 1; 
                }				
				
				$obj_brand->name =  $request->name;
				$obj_brand->created_at = new \DateTime();			    
				
				$obj_brand->save();
				$obj_brand_id = $obj_brand->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('brand_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$brand_data = \App\Models\Brand::find($brand_id);		
		
	    return view('admin.brands.add_update_brand', ['brand_data' => $brand_data, 'brand_id' => $brand_id]);	
    }

}
