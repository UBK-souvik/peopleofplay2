<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductOfficialLink;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\EventAward;
use App\Models\EventAwardNominee;

class AwardNomineeController extends Controller
{

    protected $_galleryPhotosFolder;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getIndex(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:event_awards,id'
        ]);
        $event_award =   EventAward::findOrFail($request->id);
        // $event_award_nominee = EventAwardNominee::where('event_award_id', $request->id)->get();
        return view('front.pages.award_nominee', compact('event_award'));
    }
}
