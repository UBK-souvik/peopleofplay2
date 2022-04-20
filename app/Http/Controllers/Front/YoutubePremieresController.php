<?php

namespace App\Http\Controllers\Front;

use App\Models\YoutubePremiere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class YoutubePremieresController extends Controller
{
    public function getIndex()
    {
        $data = YoutubePremiere::where('status',1)->get();
        return view('front.pages.youtube_premieres.index',compact('data'));
    }
}
