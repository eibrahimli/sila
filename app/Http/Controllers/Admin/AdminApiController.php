<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class AdminApiController extends Controller 
{
	public function __construct() {
		$this->middleware('admin:api');
	}
	public function setting() {
      $setting = Setting::first();
      return response()->json($setting);
    }
}

?>