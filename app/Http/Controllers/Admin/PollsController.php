<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poll;
use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PollAnswer;

class PollsController extends Controller
{

    public function getIndex()
    {
        return view('admin.polls.index');
    }

    public function getList()
    {
        $polls = Poll::select('*');
        return \DataTables::of($polls)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.polls.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'id' => 'nullable|exists:polls,id',
            'question' => 'required',
            'type' => 'required|in:1,2,3,4',
            'options' => 'required|array|max:6',
            'status' => 'required|in:0,1'
        ]);
        try {

            DB::beginTransaction();

            $poll = new Poll();
            if ($request->filled('id')) {
                $poll = Poll::findOrFail($request->id);
            }
            $poll->question = $request->question;
            $poll->type = $request->type;
            $poll->status = $request->status;
            $poll->save();

            PollOption::where('poll_id', $poll->id)->delete();
            foreach ($request->options as $option) {
                $new_option = new PollOption();
                $new_option->poll_id = $poll->id;
                $new_option->type = $poll->type;
                $new_option->reference_id = $option;
                $new_option->save();
            }

            DB::commit();
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
        $poll  = Poll::findOrFail($id);
        return view('admin.polls.create', compact('poll'));
    }

    public function getDelete($id)
    {
        $polls  = Poll::findOrFail($id)->delete();
        PollOption::where('poll_id', $id)->delete();
        PollAnswer::where('poll_id', $id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    public function getDataOnBasisOfType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
            'query.term' => 'required'
        ]);
        $data = null;
        $term = $request->input('query.term');
        switch ($request->type) {
            case 1:
                $data = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;

            case 2:
                $data = Event::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;

            case 3:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('role', 2)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
            case 4:
                $data =User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('role', 3)
                    ->where(
                        function ($query) use ($term)
                        { $query->where('email', 'like', '%' . $term . '%')
                            ->orWhere('first_name', 'like', '%' . $term . '%');
                        })
                    ->paginate(50);
                break;
        }

        return response()->json($data, 200);
    }

    public function getStats($id)
    {
        $poll = Poll::findOrFail($id);
        $poll_answers = PollAnswer::select(
                            DB::raw('COUNT(id) as total'),
                            'poll_answers.*'
                        )
                        ->where([
                            'poll_id' => $id
                        ])
                        ->groupBy('option_id')
                        ->get();

        $poll_count = PollAnswer::where([
            'poll_id' => $id
        ])->count();

        return view('admin.polls.stats', compact('poll_answers', 'poll_count'));
    }
}
