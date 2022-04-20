<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeedPreferenceIama;
use App\Models\FeedPreferenceIlove;
use Illuminate\Http\Request;
use App\Models\EventAwardNominee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeedPreferenceController extends Controller
{
    public function getIndexiama()
    {
       return view('admin.feed_preference.iama.index');
    }

    public function getList()
    {
        $event_awards = \App\Models\FeedPreferenceIama::select('*')->get();
        return \DataTables::of($event_awards)
            ->make();
    }

    public function getIamaCreate()
    {
        return view('admin.feed_preference.iama.create');
    }

    public function postIamaCreate(Request $request)
    {          
        $messages = [
            'level.required' => 'The Level is required.',
            'categories.required' => 'The Categories is required.',
            ];
         $errorArr =  [
             'id' => 'nullable|exists:feed_preference_iama,id',
            'level' => 'required',
            'categories.*' => 'required'
          
        ];
        $request->validate($errorArr,$messages);
        try{
           DB::beginTransaction();
        if(!empty($request->id))
        {
           $model = FeedPreferenceIama::find($request->id);
        }
        else
        {
           $model = new \App\Models\FeedPreferenceIama();
        }   
        $categories = implode(",",$request->categories);
        $model->level = $request->level;
        $model->categories = $categories;
        $model->save();
           
            DB::commit();
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getIamaUpdate($id)
    {

        $row = FeedPreferenceIama::findOrFail($id);
        return view('admin.feed_preference.iama.create', compact('row'));
    }

    public function getIamaDelete($id)
    {
        $row = FeedPreferenceIama::findOrFail($id)->delete();
        return redirect()->back();
    }

       public function getIndexilove()
    {
       return view('admin.feed_preference.ilove.index');
    }

    public function getIloveList()
    {
        $event_awards = \App\Models\FeedPreferenceIlove::select('*')->get();
        return \DataTables::of($event_awards)
         ->editColumn('group', function ($query) {
            if($query->group ==1) {
                return 'Toy';
            } else{
                return 'Game';
            }
            })
            ->make();
    }

    public function getIloveCreate()
    {
        return view('admin.feed_preference.ilove.create');
    }

    public function get_category_BYGroup(Request $request)
    {
        $id = $request->id;
        $category  = Category::where('group_id',$id)->get();

        $html = '<option value="">Select Category</option>';
        foreach ($category as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->category_name.'</option>';
        }
        return $html;
        return json_encode(['status' => true, 'html' => $html]);
    }

        public function postIloveCreate(Request $request)
    {          
        $messages = [
            'level.required' => 'The Level is required.',
            'group.required' => 'The Group is required.',
            'categories.required' => 'The Categories is required.',
            ];
         $errorArr =  [
            'id' => 'nullable|exists:feed_preference_ilove,id',
            'level' => 'required',
            'group' => 'required',
            'categories.*' => 'required'
          
        ];
        $request->validate($errorArr,$messages);
        try{
           DB::beginTransaction();
        if(!empty($request->id))
        {
           $model = FeedPreferenceIlove::find($request->id);
        }
        else
        {
           $model = new \App\Models\FeedPreferenceIlove();
        }   
        $categories = implode(",",$request->categories);
        $model->level = $request->level;
        $model->group = $request->group;
        $model->categories = $categories;
        $model->save();
           
            DB::commit();
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getIloveUpdate($id)
    {

        $row = FeedPreferenceIlove::findOrFail($id);
        return view('admin.feed_preference.ilove.create', compact('row'));
    }


}
