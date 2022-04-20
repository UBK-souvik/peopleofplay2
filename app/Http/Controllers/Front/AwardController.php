<?php

namespace App\Http\Controllers\Front;

use App\Models\Event;
use App\Models\EventAward;
use Illuminate\Http\Request;
use App\Models\EventAwardNominee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    public function getAwards($event_id)
    {
        $event_awards = EventAward::where('event_id', $event_id)
            ->paginate(30);
        $event = Event::findOrFail($event_id);

        return view('front.user.event_awards.index', compact('event_awards', 'event_id','event'));
    }

    public function getCreateAward($event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('front.user.event_awards.create', compact('event'));
    }

    public function postCreateAward(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            // 'nominee' => 'required|array',
            'winner_type'   => 'required',
            'winner'        => 'required_if:winner_type,1',
            'winner_tag'    => 'required_if:winner_type,2',
        ]);
        // if ($request->filled('winner')) {
        //     if (!in_array($request->winner, $request->nominee)) {
        //         return successMessage('Winner must be from nominee', null, 422);
        //     }
        // }

        $event = Event::find($request->event_id);
        $user_id = $event->user_id;
        try {
            $new_award = new EventAward();
            if ($request->filled('event_award_id')) {
                $new_award = EventAward::findOrFail($request->event_award_id);
            }
            $new_award->event_id = $request->event_id;
            $new_award->name = $request->name;
            $new_award->user_id = $user_id;
            $new_award->description = $request->description;
            $new_award->type = $request->type;
            $new_award->winner_type = $request->winner_type;
            $new_award->save();
			
			$str_nominee_tag = $arr_nominee_tag = (!empty($request->nominee_tag)) ? explode(',', $request->nominee_tag) : [];		
			// if(strpos($str_nominee_tag[0], ',')>0)
			// {
			//   $arr_nominee_tag = explode(',', $str_nominee_tag[0]);
			// }
			// else
			// {
			//   $arr_nominee_tag[] = $str_nominee_tag[0];	
			// }
			
            EventAwardNominee::where('event_award_id', $new_award->id)->delete();
            if(!empty($request->nominee) && count($request->nominee)>0)
            {
                foreach ($request->nominee as $nominee) {

                    /*$new_nominee = new EventAwardNominee();
                    $new_nominee->event_award_id = $new_award->id;
                    $new_nominee->user_id = $user_id;
                    $new_nominee->type = $new_award->type;
                    $new_nominee->reference_type = $request->reference_type;
                    $new_nominee->is_winner = 0;

                    if ($request->filled('winner')) {
                        if ($nominee == $request->winner) {
                            $new_nominee->is_winner = 1;
                        }
                    }

                    if ($request->reference_type == 1) {
                        $new_nominee->reference_id = $nominee;
                    } else {
                        $new_nominee->reference = $nominee;
                    }
                    $new_nominee->save();*/
    				
    				$this->save_eventaward_nominee($request, $new_award->id, $new_award->type, $user_id, 1, $request->winner, $nominee);
                }
			}
			
			if(!empty($arr_nominee_tag) && count($arr_nominee_tag)>0)
			{
                foreach ($arr_nominee_tag as $arr_nominee_tag_row) {
                    $this->save_eventaward_nominee($request, $new_award->id, $new_award->type, $user_id, 2, $request->winner, $arr_nominee_tag_row);
                }  
			}

            if(!empty($request->winner_type) && $request->winner_type == 1 && !empty($request->winner) )
            {
                $new_nominee = new EventAwardNominee();
                $new_nominee->event_award_id = $new_award->id;
                $new_nominee->type = $new_award->type;
                $new_nominee->user_id = $user_id;
                $new_nominee->reference_type = 1;
                $new_nominee->winner_type   = 1;
                $new_nominee->is_winner = 1;

                $new_nominee->reference_id = $request->winner;
                $new_nominee->save();
            } 
            else if(!empty($request->winner_type) && $request->winner_type == 2 && !empty($request->winner_tag))
            {
                $new_nominee = new EventAwardNominee();
                $new_nominee->event_award_id = $new_award->id;
                $new_nominee->type = $new_award->type;
                $new_nominee->user_id = $user_id;
                $new_nominee->reference_type = 2;
                $new_nominee->winner_type   = 2;
                $new_nominee->is_winner = 1;

                $new_nominee->reference = $request->winner_tag; 
                $new_nominee->save();
            }
			
			
            DB::commit();
            return successMessage('Award created');
        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }
	
	function save_eventaward_nominee(Request $request,$new_award_id, $new_award_type, $user_id, $reference_type, $is_winner, $nominee)
	{
	   $new_nominee = new EventAwardNominee();
                $new_nominee->event_award_id = $new_award_id;
                $new_nominee->type = $new_award_type;
                $new_nominee->user_id = $user_id;
                $new_nominee->reference_type = $reference_type;
                $new_nominee->is_winner = 0;

                // if ($request->filled('winner')) {
                //     if ($nominee == $request->winner) {
                //         $new_nominee->is_winner = 1;
                //     }
                // }

                if ($reference_type == 1) {
                    $new_nominee->reference_id = $nominee;
                } else {
                    $new_nominee->reference = $nominee;
                }
                $new_nominee->save();	
	}


    public function getUpdateAward($id)
    {
        $event_award = EventAward::findOrFail($id);
        $event = Event::findOrFail($event_award->event_id);
        // pr($event,1);
        return view('front.user.event_awards.create', compact('event_award','event'));
    }

    public function getDeleteAward($id)
    {
        $event = EventAward::findOrFail($id)->delete();
        return redirect()->back();
    }
}
