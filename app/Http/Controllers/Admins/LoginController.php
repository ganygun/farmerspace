<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use flash;
use GuzzleHttp\Client;
use Httpful;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class LoginController extends Controller {
	public function showLogin() {
		// show the form
		//if (DB::connection()->getDatabaseName()) {
		//	echo "connected successfully to database " . DB::connection()->getDatabaseName();
		//}
		//$user = DB::table('tb_User')->where('UserID', 'USID000000001')->first();
		if (Session::get('key')) {
			return view('admins.dashboard.index');
		} else {
			return view('admins.dashboard.login');
		}
	}

	public function doLogin() {
		$username = Input::get('email');
		$password = Input::get('password');

		try {
			$uri = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Check_Login&Phone=" . $username . "&PWD=" . $password . "";
			$response = \Httpful\Request::post($uri)
				->contentType("text/html; charset=utf-8")
				->send();

			if ($response == "True") {

				$client = new Client();

				$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
					['query' =>
						['Method' => 'ShowUserInfo',
							'Phone' => $username,
							'PWD' => $password,
						],
					]);

				$bodyCheckRole = $response->getBody();
				$jsonDecode = json_decode($bodyCheckRole, true);

			
				if (!empty($jsonDecode['dataListUserInfo'][0]['Userlevel'])) {
					Session::put('role', $jsonDecode['dataListUserInfo'][0]['Userlevel']);
					if ($jsonDecode['dataListUserInfo'][0]['Userlevel'] == 'User') {
						flash('This user is not enough authority', 'danger');
						return Redirect::to('admins');
					}

					Session::put('phone', $jsonDecode['dataListUserInfo'][0]['Phone']);
					Session::put('key', $jsonDecode['dataListUserInfo'][0]['UserID']);
					Session::put('pwd', $password);
					if (Session::get('role') == 'Admin') {
						return redirect('/admins/dashboard');
					} elseif (Session::get('role') == 'Writer') {
						return redirect('/admins/myarticle');
					}
				}

				# code...
			} else {
				flash('Username or Password incorrect', 'danger');
				return back()->withInput();
				
			}
		} catch (Exception $e) {
            return $e->getMessage();
		}

	}

	public function doLogout() {

		Session::forget('key');
		Session::forget('pwd');
		Session::forget('farmname');
		Session::forget('phone');
		Session::forget('role');
		Session::forget('myname');
		if (!Session::has('key') && !Session::forget('pwd')) {
			return Redirect::to('admins'); // redirect the user to the login screen
		}

	}
}
