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
use App\Models\CompanyCategory;


use Auth;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompanyCategoryController extends Controller
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
        return view('admin.company_category.category');
    }

    public function category_getList()
    {
        $users_roles = CompanyCategory::select('*');
        $data = \DataTables::of($users_roles)
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
        if($request->isMethod('post'))
        {
            // pre($request->all(),1);
            $where  = [ 'id' => $request->category_id ];
            $update = [ 
                'name'     => $request->name, 
            ];

            CompanyCategory::updateOrCreate($where,$update);
            return redirect()->route('admin.company-category.index')->with('message', 'Category Created!');
        }
        return view('admin.company_category.category_create');
    }

    public function category_getUpdate($id)
    {
        $category = CompanyCategory::where('id', $id)->firstOrFail();
        return view('admin.company_category.category_create', compact('category'));
    }

    public function category_getDelete($id)
    {
        $product  = CompanyCategory::findOrFail($id)->delete();
        return redirect()->route('admin.company-category.index')->with('message', 'Category deleted!');
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
