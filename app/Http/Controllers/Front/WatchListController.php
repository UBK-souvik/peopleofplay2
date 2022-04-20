<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\BrandList;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class WatchListController extends Controller
{
    public function getWatchList()
    {
        $current_user = get_current_user_info();
        $watch_list = Watchlist::where('user_id', $current_user->id)->paginate(50);

        return view('front.pages.watch_list', compact('watch_list'));
    }

    public function getAddToWatchList(Request $request)
    {
        
        $request->validate([
            'type' => 'in:1,2,3,4,5',
            'value' => 'numeric'
        ]);

        $current_user = get_current_user_info();
        $type = $request->type;
        $value = $request->value;

        if (check_watch_list($type, $value)) {
            return redirect()->back()->withErrors('Already added to watchlist');
        }

        switch ($type) {
            case 1:
                User::findOrFail($value);
                break;
            case 2:
               Product::findOrFail($value);
               
                break;
            case 3:
                Event::findOrFail($value);
                break;
            case 4:
                //
                break;
            case 5:
                BrandList::findOrFail($value);
                break;
			default:
                abort(404);
                break;
        }

        $watch_list = new Watchlist();
        $watch_list->user_id = $current_user->id;
        $watch_list->type = $type;
        $watch_list->value_id = $value;
        $watch_list->save();
        $id = $watch_list->id;

        // return successMessage('Added to watch list');
        echo json_encode(['msg'=>'Added to Favorite','id'=>$id]);

        //return redirect()->back()->withSuccess('Added to watchlist');
    }

    public function getRemoveWatchlist($id)
    {
       
        Watchlist::findOrFail($id)->delete();
        Session::flash('watchlist_deleted_flag', 1);
        echo json_encode(['msg'=>'Removed from to Favorite']);
        // return redirect()->back()->withSuccess('Removed from to watchlist');
    }
}
