<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Feed;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;

class TinyImageController extends ModuleTwoController
{
	
	public function store(Request $request) 
	{ 
	$file=$request->file('file');
	$path= url('/img/').'/'.$file->getClientOriginalName();
	$imgpath=$file->move(public_path('/img/'),$file->getClientOriginalName());
	$fileNameToStore= $path;


	return json_encode(['location' => $fileNameToStore]); 

	}
}
