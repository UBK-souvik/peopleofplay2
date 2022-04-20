<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CompanyCategory;
use App\Models\FeedsCategory;


use Auth;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeedsCategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function category_getIndex()
    {
        return view('admin.feeds_category.category');
    }

    public function category_getList()
    {
        $users_roles = FeedsCategory::select('*');
        $data = \DataTables::of($users_roles)
        ->addIndexColumn()
            // ->editColumn('group_id', function ($query) {
            //     $retVal = (!empty($query->group_id)) ? $query->group_id : 1 ;
            //     return config('cms.group')[$retVal];
            // })
            // ->filterColumn('group_id', function ($query, $keyword) {
            //     if ($keyword == 'toy') {
            //         $keyword = 1;
            //     } elseif ($keyword == 'game') {
            //         $keyword = 2;
            //     }
            //     // $keyword = strtolower($keyword) == "toy" ? 1 : 2;
            //     $query->where("group_id", $keyword);              
            // })
            ->make();
        return $data;
    }

    public function category_getCreate(Request $request)
    {
        // $this->bulk_upload($request); die;
        if($request->isMethod('post'))
        {
            // pre($request->all(),1);
            $where  = [ 'id' => $request->category_id ];
            $update = [ 
                'name'     => ucwords($request->name), 
                'created_at'     => time(), 
                'updated_at'     => time(), 
            ];

            // pr($update); die;
            FeedsCategory::updateOrCreate($where,$update);
            return redirect()->route('admin.feeds-category.index')->with('message', 'Category Created!');
        }
        return view('admin.feeds_category.category_create');
    }

    public function category_getUpdate($id)
    {
        $category = FeedsCategory::where('id', $id)->firstOrFail();
        return view('admin.feeds_category.category_create', compact('category'));
    }

    public function category_getDelete($id)
    {
        $product  = FeedsCategory::findOrFail($id)->delete();
        return redirect()->route('admin.feeds-category.index')->with('message', 'Category deleted!');
    }

    public function bulk_upload(Request $request)
    {
        echo 'here'; die;
        $arrayName = array(
            'financial',
            'market trends',
            'history',
            'safety',
            'licensing',

        );

        foreach ($arrayName as $key => $value) {
            $where  = [ 'id' => $request->category_id ];
            $update = [ 
                'name'     => ucwords($value), 
                'created_at'     => time(), 
                'updated_at'     => time(), 
            ];

            FeedsCategory::updateOrCreate($where,$update);

        }
    }

    public function news_feeds_user_status(Request $request){
        // pr($request->all()); die;

        if($request->news_val == 0){
            User::where('id',$request->id)->update(['is_news_feeds'=>1]);
        }else{
            User::where('id',$request->id)->update(['is_news_feeds'=>0]);
        }
        return response()->json(['status'=>1]);
    }

}
