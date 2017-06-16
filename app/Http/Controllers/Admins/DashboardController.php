<?php

namespace App\Http\Controllers\Admins; // กำหนดที่อยู่ของ Controller
use App\Http\Controllers\Controller;
use Session;

//เรียกใช้ Controller หลักของ Laravel 5.0

class DashboardController extends Controller {

	public function Index() {
		/**
		 * Check User Logon !!
		 */
		if (Session::get('key')) {
			return view('admins.dashboard.index');
		} else {

			return redirect('/admins');

		}

	}

}