<?php

namespace App\Http\Controllers\Front;

use App\Models\Quiz;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use Validator;

class GameRoomController extends ModuleController
{

  /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {
     parent::__construct();   
    $this->_current_url = url()->current();
    $this->_create_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'create');
    $this->_delete_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'delete');
    $this->_main_gallery_url = Utilities::getGalleryUrls($this->_current_url, '');
    $this->_base_url = url('/'); 
  }
	
	public function index()
    { 
        $quizs = Quiz::where('status', 1)->get();
		 return view('front.game_room.index',compact('quizs'));
	}  
}
