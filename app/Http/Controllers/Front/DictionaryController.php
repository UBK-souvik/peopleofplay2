<?php

namespace App\Http\Controllers\Front;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class DictionaryController extends Controller
{
	
    public function getDictionaries()
    {
        $current_user = get_current_user_info();
        
		$dictionaries = Dictionary::where('user_id', $current_user->id)
            ->orderBy('id', 'desc')
            ->paginate(20);
			
        return view('front.user.dictionary.index', compact('dictionaries'));
    }

    public function getCreateDictionary(Request $request)
    {
        return view('front.user.dictionary.create');
    }

    public function postCreateDictionary(Request $request)
    {
         $rules = [
        'dictionary_id' => 'nullable|exists:dictionaries,id',
            'title' => 'required',
			'description' => 'required',
            
    ];
	
	$niceNames = [
            'title' => 'Title',
		     'description' => 'Description',
        
    ];
	
       $this->validate($request, $rules, [], $niceNames);

        try {

            DB::beginTransaction();

            $current_user = get_current_user_info();
            $data = $request->only(Dictionary::$fillable_shadow);
            $data['user_id'] = $current_user->id;
			$data['added_by'] = 1;
			
			$data['status'] = 0;
			$data['description'] = $request->description;

            Dictionary::updateOrCreate(['id' => $request->dictionary_id], $data);

            DB::commit();
			Session::flash('dictionary_data_saved_flag', 1);
            return successMessage('Dictionary saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdateDictionary($slug)
    {
        $current_user = get_current_user_info();
        $dictionary = Dictionary::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail();
        return view('front.user.dictionary.create', compact('dictionary'));
    }

    public function getDeleteDictionary($slug)
    {
        $current_user = get_current_user_info();
        Dictionary::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail()
            ->delete();
			
		Session::flash('dictionary_data_deleted_flag', 1);	

        return redirect()->route('front.user.dictionary.index');
    }
}
