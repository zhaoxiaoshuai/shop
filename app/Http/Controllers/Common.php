<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
class Common extends Controller
{
	public function __construct()
	{
		//导航
        $navs = DB::table('navs')->take(8)->get();
		view()->share('navs',$navs);
	}
}