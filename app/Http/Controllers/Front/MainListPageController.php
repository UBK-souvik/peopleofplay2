<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductOfficialLink;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;

class MainListPageController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     
    }

    public function getIndex()
    {

        return view('front.pages.main_list');
    }

}
