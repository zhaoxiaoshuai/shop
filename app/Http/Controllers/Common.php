<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class Common extends Controller
{
	public function __construct()
	{
		$a = 123;
		view()->share('a',$a);
	}
}