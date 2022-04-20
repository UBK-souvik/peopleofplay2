<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductBuyFrom;

use App\Models\ProductCollaborator;
use App\Models\ProductOfficialLink;
use App\Models\MetaData;
use App\Models\ProductCommunityStat;
use App\Models\ProductClassification;
use App\Models\ProductAdditionalSuggestion;
use App\Models\ProductCategory;
use App\Models\ProductGalleryMetaData;
use App\Helpers\Utilities;
use App\Models\ProductOther;
use App\Models\ProductVideo;
use App\Models\ProductSocialMedia;
use App\Models\ProductStatistic;
use App\Models\UsersUserRole;
use App\Models\SubCategory;

use Auth;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    protected $_collaboratorPhotosFolder;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_collaboratorPhotosFolder = Utilities::get_collaborator_upload_folder_path();        
    }

    public function getIndex()
    {
        return view('admin.category.Index');
    }

    public function getList()
    {
        $users_roles = SubCategory::select('*');
        $data = \DataTables::of($users_roles)
            ->editColumn('category_id', function ($query) {
                return category_byID( $query->category_id );
            })
            ->make();
        // pr($data,1);
        return $data;
    }

    public function getCreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            // pre($request->all(),1);
            $where  = [ 'id' => $request->sub_category_id ];
            $update = [ 
                'category_id'   => $request->category_id, 
                'sub_category'  => $request->sub_category, 
            ];

            SubCategory::updateOrCreate($where,$update);
            return redirect()->route('admin.sub_category.index');
        }
        return view('admin.category.create');
    }

    public function getUpdate($id)
    {
        $sub_category = SubCategory::where('id', $id)->firstOrFail();
        return view('admin.category.create', compact('sub_category'));
    }

    public function getDelete($id)
    {				//try {            // Start Transaction            //\DB::beginTransaction();					Product::where('category_id', $id)->delete();	
        $product  = Category::findOrFail($id)->delete();
        return back();				// Commit Transaction            //\DB::commit();            //$response = ['msg' => adminTransLang('request_processed_successfully')];            //return response()->json($response, 200);        //} catch (\Illuminate\Database\QueryException $e) {            // Rollback Transaction            //\DB::rollBack();          //  errorMessage($e->errorInfo[2], true);        //}
    }

    public function category_getIndex()
    {
        return view('admin.category.category');
    }

    public function category_getList()
    {
        $users_roles = Category::select('*');
        $data = \DataTables::of($users_roles)
            ->editColumn('group_id', function ($query) {
                $retVal = (!empty($query->group_id)) ? $query->group_id : 1 ;
                return config('cms.group')[$retVal];
            })
            ->filterColumn('group_id', function ($query, $keyword) {
                if ($keyword == 'toy') {
                    $keyword = 1;
                } elseif ($keyword == 'game') {
                    $keyword = 2;
                }
                // $keyword = strtolower($keyword) == "toy" ? 1 : 2;
                $query->where("group_id", $keyword);              
            })
            ->make();
        return $data;
    }

    public function category_getCreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            // pre($request->all(),1);
            $where  = [ 'id' => $request->category_id ];
            $update = [ 
                'group_id'          => $request->group_id, 
                'category_name'     => $request->category_name, 
                'en_category_name'  => $request->category_name, 
            ];

            Category::updateOrCreate($where,$update);
            return redirect()->route('admin.category.index')->with('message', 'Category Created!');
        }
        return view('admin.category.category_create');
    }

    public function category_getUpdate($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('admin.category.category_create', compact('category'));
    }

    public function bulk_upload()
    {
        $arrayName = array(
            '3-D Puzzles',
            'Brain Teasers',
            'Floor Puzzles',
            'Jigsaw Puzzles',
            'Pegged Puzzles',
            'Puzzle Accessories',
            'Puzzle Play Mats',
            'Sudoku Puzzles',





        );

        foreach ($arrayName as $key => $value) {
            $update = [ 
                'category_id'   => 26, 
                'sub_category'  => $value, 
            ];

            SubCategory::create($update);

        }
    }

}
