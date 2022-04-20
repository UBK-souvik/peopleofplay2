<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\BrandList;
use App\Models\MainListPage;
use App\Models\MainListParagraph;
use Illuminate\Http\Request;
use App\Models\MainListPageDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\SideBar;
use App\Models\SideBarDetail;
use App\Models\News;
use App\Models\Blog;

class MainListPageController extends Controller
{
	public function getMainListParagraphIndex()
    {
        return view('admin.main_list_page.indexMainListParagraphs');
    }

    public function getMainListParagraphList(Request $request)
    {
        $main_list_page = MainListParagraph::select('*');
        if(isset($request->type) && !empty($request->type)){
            $main_list_page = $main_list_page->where('type',$request->type);
        }
        return \DataTables::of($main_list_page)
            ->editColumn('type', function ($query) {
                return @ucfirst(config('cms.drop_down_type')[$query->type]);
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }

	public function getMainListParagraphUpdate(Request $request)
    {
        $main_list_paragraph = MainListParagraph::find($request->id);
        if (!$main_list_paragraph) {
            return redirect()->route('admin.main_list_page.indexMainListParagraphs')->with(['fail' => adminTransLang('setting_not_found')]);
        }

        return view('admin.main_list_page.mainlist_paragraph_create', compact('main_list_paragraph'));
    }

    public function postMainListParagraphUpdate(Request $request)
    {


        $main_list_paragraph = MainListParagraph::find($request->main_list_paragraph_id);


        $main_list_paragraph->type = $request->type;
		$main_list_paragraph->status = $request->status;
        $main_list_paragraph->description = $request->description;
        $main_list_paragraph->save();


        return response()->json([
            'status'    => 1,
            'type'      => $request->type,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
    }


    public function getIndex()
    {
        return view('admin.main_list_page.index');
    }

    public function getList(Request $request)
    {
        $main_list_page = MainListPage::select('*');
        if(isset($request->type) && !empty($request->type)){
            $main_list_page = $main_list_page->where('type',$request->type);
        }
        return \DataTables::of($main_list_page)
            ->editColumn('type', function ($query) {
                return @ucfirst(config('cms.drop_down_type')[$query->type]);
            })
			->editColumn('category_id', function ($query) {
                $arr_mainlist_destination_types_list = Utilities::get_mainlist_destination_types_list();
				return @$arr_mainlist_destination_types_list[$query->category_id];
				//return @$query->category_id;
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }


    // get the update screen
    public function getUpdate(Request $request)
    {
		$arr_mainlist_destination_types_list = Utilities::get_mainlist_destination_types_list();

		//print_r($arr_mainlist_destination_types_list);exit;
		$main_list_page_id = @$request->id;
        $main_list_page = MainListPage::find($main_list_page_id);
        if (!$main_list_page) {
            return redirect()->route('admin.main_list_page.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }

		if(!empty(@$main_list_page->category_id))
		{
		  $int_category_id = @$main_list_page->category_id;
		}
		else
		{
		  $int_category_id = 0;
		}

        if(!empty($main_list_page->display_order) &&  ($main_list_page->display_order == 3 || $main_list_page->display_order == 11 || $main_list_page->display_order == 12 || $main_list_page->display_order == 13 || $main_list_page->display_order == 14 || $main_list_page->display_order == 15 || $main_list_page->display_order == 16))
		{
		   $int_video_category_id	= 8;
		}
        else
		{
		   $int_video_category_id	= 0;
		}

        return view('admin.main_list_page.update', compact('int_video_category_id', 'int_category_id','main_list_page_id', 'main_list_page', 'arr_mainlist_destination_types_list'));
    }

	// the drop down of categories in update screen
	public function getItemsByCategory(Request $request)
    {
		$category_id = $request->category_id;
		$main_list_page_id = @$request->main_list_page_id;
        $main_list_page = MainListPage::find($main_list_page_id);

		// in edit mode
		if($main_list_page->category_id)
		{
		  $category_id = $main_list_page->category_id;
		}
		//echo '<pre>';
		//print_r($main_list_page);
		//echo '</pre>';exit;

        return view('admin.main_list_page.mainlist_category_list', compact('category_id', 'main_list_page'));
	}

    // when a main list page is updated
    public function postUpdate(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'display_order' => 'required|digits_between:1,5',
            //'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
			'type' => 'required|in:' . implode(',', array_keys(config('cms.drop_down_type'))),
            'status' => 'required|in:0,1',
			'hidden_category_id' => 'required',
            'expandable' => 'nullable'
        );

        // for videos only
        if($request->display_order == 3 || $request->display_order == 11)
        {
            /*if($request->status == 1)
            {
                $rules['Link']    = 'required|array|min:5';
                $rules["Link.*"]  = "required";
            }*/
        }

		$niceNames = [
                'hidden_category_id' => 'Category',

            ];
        $this->validate($request, $rules, $niceNames);
        $main_list_page = MainListPage::find($request->id);

        MainListPageDetail::where('main_list_page_id', $main_list_page->id)->delete();
        MainListPage::where('display_order', $request->display_order)
            ->update([
                'display_order' => $main_list_page->display_order
            ]);

        $main_list_page->title = $request->title;
        $main_list_page->display_order = $request->display_order;
        $main_list_page->type = $request->type;
        $main_list_page->status = $request->status;
		$main_list_page->category_id =  $request->hidden_category_id;
        $main_list_page->save();

		//excluding the video for only items
        if ($request->filled('expandable') && in_array($request->type, [1, 2, 3, 4, 5, 6, 7, 8, 9]) && ($request->display_order != 3 && $request->display_order != 11 && $request->display_order != 12 && $request->display_order != 13 && $request->display_order != 14 && $request->display_order != 15 && $request->display_order != 16)) {
            foreach ($request->expandable ?? [] as $expandable) {
                $home_page_detail = new MainListPageDetail();
                $home_page_detail->main_list_page_id =  $main_list_page->id;
                $home_page_detail->type =  $main_list_page->type;
                $home_page_detail->reference_id =  $expandable;
				$home_page_detail->category_id =  $request->hidden_category_id;
                $home_page_detail->save();
            }
        }

         $int_video_title_flag  =1;
        // for videos type only
        if ($request->filled('Link') && in_array($request->type, [1, 2, 3, 4, 5, 6, 7, 8, 9]) && ($request->display_order == 3 || $request->display_order == 11 || $request->display_order == 12 || $request->display_order == 13 || $request->display_order == 14 || $request->display_order == 15 || $request->display_order == 16)) {
            // MainListPageDetail::where('main_list_page_id', $main_list_page->id)->delete();
            $video_title = array_values(array_filter($request->video_title));
            foreach ($request->Link ?? [] as $key => $link) {

                // give validation for only 3 videos
                if($int_video_title_flag<=3)
				{
                  $rule['video_title.'.$key] = "required";
				  $rule['Link.'.$key] = "required";
                }

				$this->validate($request, $rule);

				$home_page_detail = new MainListPageDetail();

				$int_video_title_flag++;

				if(!empty($video_title[$key]))
				{
					$home_page_detail->video_title  =  $video_title[$key];

				}

                if(!empty($link))
				{
					$home_page_detail->video_link   =  $link;
				}

					$home_page_detail->main_list_page_id =  $main_list_page->id;
					$home_page_detail->type =  $main_list_page->type;
					$home_page_detail->save();

            }
        }

        return response()->json([
            'status'    => 1,
            'type'      => $request->type,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    // items list in the drop down of update screen
    public function getDataOnBasisOfType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
            'query.term' => 'required'
        ]);
        $data = null;
        $term = $request->input('query.term');
        // pr($request->type,1);
        switch ($request->type) {
            case 1:
                $data = Product::where('name', 'like', '%' . $term . '%')->where('group_id',1)->select('name as text', 'id')->paginate(50);
                break;

            case 2:
                $data = Product::where('name', 'like', '%' . $term . '%')->where('group_id',2)->select('name as text', 'id')->paginate(50);
                break;
            case 3:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('stripe_id', '!=', NULL)
			        ->where('stripe_id', '<>',  '')
					->where('role', 3)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
            case 4:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('stripe_id', '!=', NULL)
			        ->where('stripe_id', '<>',  '')
					->where('role', 2)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
            case 5:
                $data = Event::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;
            case 6:
                $data = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                // $products = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id');
                // $result = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                //     ->where(
                //         function ($query) use ($term)
                //         { $query->where('email', 'like', '%' . $term . '%')
                //             ->orWhere('first_name', 'like', '%' . $term . '%');
                //         })
                //     ->union($products)->get();
                // $data['current_page'] = 1;
                // $data['data'] = $result;
                break;
			case 7:
                $data = BrandList::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                // $products = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id');
                // $result = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                //     ->where(
                //         function ($query) use ($term)
                //         { $query->where('email', 'like', '%' . $term . '%')
                //             ->orWhere('first_name', 'like', '%' . $term . '%');
                //         })
                //     ->union($products)->get();
                // $data['current_page'] = 1;
                // $data['data'] = $result;
                break;
        }

        return response()->json($data, 200);
    }

    public function sidebar_page_Index()
    {
        return view('admin.main_list_page.sidebar_index');
    }

    public function sidebar_page_getList(Request $request)
    {
        $main_list_page = SideBar::select('*');
        return \DataTables::of($main_list_page)
            ->editColumn('type', function ($query) {
                return @ucfirst(config('cms.sidebar_type')[$query->type]);
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function sidebar_page_getUpdate(Request $request)
    {
        $main_list_page = SideBar::find($request->id);
        if (!$main_list_page) {
            return redirect()->route('admin.sidebar_page.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }

        return view('admin.main_list_page.sidebar_update', compact('main_list_page'));
    }

    public function sidebar_page_postUpdate(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'display_order' => 'required|digits_between:1,8',
            'type' => 'required|in:' . implode(',', array_keys(config('cms.sidebar_type'))),
            'status' => 'required|in:0,1',
            'expandable' => 'nullable'
        );

        if($request->type == 2)
        {
            if($request->status == 1)
            {
                $rules['Link']    = 'required|array|min:1';
                $rules["Link.*"]  = "required";
            }
        }

        $this->validate($request, $rules);

        $main_list_page = SideBar::find($request->id);

        SideBar::where('display_order', $request->display_order)
            ->update([
                'display_order' => $main_list_page->display_order
            ]);

        $main_list_page->title = $request->title;
        $main_list_page->display_order = $request->display_order;
        $main_list_page->type = $request->type;
        $main_list_page->status = $request->status;
        $main_list_page->save();

        if ($request->filled('expandable') && in_array($request->type, [1, 2, 3, 4, 5, 6, 7, 8]) && $request->type != 2) {
            SideBarDetail::where('side_bars_id', $main_list_page->id)->delete();
            $content = array_values(array_filter($request->content));
            foreach ($request->expandable ?? [] as $key =>  $expandable) {

                $rule['content.'.$key] = "required";
                $this->validate($request, $rule);

                $home_page_detail = new SideBarDetail();
                $home_page_detail->side_bars_id =  $main_list_page->id;
                $home_page_detail->type =  $main_list_page->type;
                $home_page_detail->reference_id =  $expandable;
                $home_page_detail->content      =  $content[$key];
                $home_page_detail->save();
            }
        }

        if ($request->filled('Link') && in_array($request->type, [1, 2, 3, 4, 5, 6, 7, 8]) && $request->type == 2) {
            SideBarDetail::where('side_bars_id', $main_list_page->id)->delete();
            $content = array_values(array_filter($request->content));
            foreach ($request->Link ?? [] as $key => $link) {

                $rule['content.'.$key] = "required";
                $this->validate($request, $rule);

                $home_page_detail = new SideBarDetail();
                $home_page_detail->side_bars_id =  $main_list_page->id;
                $home_page_detail->type =  $main_list_page->type;
                $home_page_detail->video_link =  $link;
                $home_page_detail->content    =  $content[$key];
                $home_page_detail->save();
            }
        }

        return response()->json([
            'status'    => 1,
            'type'      => $request->type,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    public function getDataOnBasisOfType_sidebar(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys(config('cms.sidebar_type'))),
            'query.term' => 'required'
        ]);
        $data = null;
        $term = $request->input('query.term');
        // pr($request->type,1);
        switch ($request->type) {
            case 1:
                $data = Product::where('name', 'like', '%' . $term . '%')->where('group_id',1)->select('name as text', 'id')->paginate(50);
                break;

            case 2:
                $data = Product::where('name', 'like', '%' . $term . '%')->where('group_id',2)->select('name as text', 'id')->paginate(50);
                break;
            case 3:
                $data = News::where('title', 'like', '%' . $term . '%')->select('title as text', 'id')->paginate(50);
                break;
            case 4:
                $data = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;
            case 5:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('stripe_id', '!=', NULL)
			        ->where('stripe_id', '<>',  '')
					->where('role', 2)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
            case 6:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('stripe_id', '!=', NULL)
			        ->where('stripe_id', '<>',  '')
					->where('role', 3)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
            case 7:
                $data = Blog::where('title', 'like', '%' . $term . '%')->select('title as text', 'id')->paginate(50);
                break;
        }

        return response()->json($data, 200);
    }
}
