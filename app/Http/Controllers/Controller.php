<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
    	$this->setdefaultTime();
    }

    public function setdefaultTime()
    {
    	$timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']
    $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
    date_default_timezone_set($timezone_name);	
    }

    }


