<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller {

	public function checkUser($username){

		$client = new Client();

			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
				['query' =>
					['Method' => 'ShowUserProfile',
						'UserID' => $username,
					],
				]);

			$bodyProfile = $response->getBody();
			$jsonDecode = json_decode($bodyProfile, true);

		//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
			if (!empty($jsonDecode['dataListProfile'])) {
				return $jsonDecode['dataListProfile'][0]['Company'];
			}
			else{
				return 'Notfound';
			}
	}

	public function confirm_register() {
		$username = Input::get('email');
		$password = Input::get('password');
		$uri = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Check_Login&Phone=" . $username . "&PWD=" . $password . "";
		$responseLogin = \Httpful\Request::post($uri)
			->contentType("text/html; charset=utf-8")
			->send();

		if ($responseLogin == "True") {
			//check role admin
			$client = new Client([
				// Base URI is used with relative requests
				// You can set any number of default request options.
				'timeout' => 10.0,
			]);

			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
				['query' =>
					['Method' => 'ShowUserInfo',
						'Phone' => $username,
						'PWD' => $password,
					],
				]);

			$bodyCheckRole = $response->getBody();
			$jsonDecodeCheckRole = json_decode($bodyCheckRole, true);
			$roleVerify = $jsonDecodeCheckRole['dataListUserInfo'][0]['Userlevel'];

			if ($roleVerify == 'Admin') {
				return view('admins.dashboard.register.form.type5')->with('RegistType', '05');
			} else {
				flash('This user is not enough authority', 'warning');
				return back()->withInput();
			}

		} else {
			flash('Username or Password incorrect', 'danger');
			return back()->withInput();
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admins.dashboard.register.step_1');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (\Request::get('RegistType') == '01') {
			return view('admins.dashboard.register.form.type1');
		} elseif (\Request::get('RegistType') == '02') {
			return view('admins.dashboard.register.form.type2');
		} elseif (\Request::get('RegistType') == '03') {
			return view('admins.dashboard.register.form.type3');
		} elseif (\Request::get('RegistType') == '04') {
			return view('admins.dashboard.register.form.type4');
		} elseif (\Request::get('RegistType') == '05') {
			return view('admins.dashboard.register.form.type5_confirm');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		$FirstName = $request->input('FirstName');
		$LastName = $request->input('LastName');
		$Phone = $request->input('Phone');
		$password = $request->input('password');
		$Institution = $request->input('Institution');
		$Address = $request->input('Address');
		$Province = $request->input('Province');
		$District = $request->input('District');
		$SubDistrict = $request->input('SubDistrict');
		$Zipcode = $request->input('Zipcode');
		$PathFile = $request->input('PathFile');
		$Score = $request->input('Score');
		$PenName = $request->input('PenName');
		$Description = $request->input('Description');

		try {
			if (\Request::get('RegistType') == '01') {

				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_User';

				//Query
				$postData = 'FirstName='. $FirstName .'&LastName='. $LastName .'&Phone='. $Phone .'&Password='. $password .'&FarmName='. $Institution .'&Address='. $Address .'&Province='. $Province .'&District='. $District .'&SubDistrict='. $SubDistrict .'&Zipcode='. $Zipcode .'&QRCode=&AcceptCondition=true&CreateDate='. date("Y-m-d H:i:s") .'&PictureProfile='. $PathFile .'&Score=0&PenName=&Description=';

				$data = $postData;

				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method' => 'POST',
						'content' => $data,
					),
				);

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				

				//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
				if ($result == 'Valid') {
					//echo $request->input('RegistType');
					//echo "<br>เกษตรกร";
					//echo $bodyRegister;
					flash('You have been successfully registered.','success');
					return redirect('/admins');
				}
				else{
					flash($result,'dangers');
					return back()->withInput();
				}
				
			} elseif (\Request::get('RegistType') == '02') {
				
				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_User';

				//Query
				$postData = 'FirstName='. $FirstName .'&LastName='. $LastName .'&Phone='. $Phone .'&Password='. $password .'&FarmName='. $Institution .'&Address='. $Address .'&Province='. $Province .'&District='. $District .'&SubDistrict='. $SubDistrict .'&Zipcode='. $Zipcode .'&QRCode=&AcceptCondition=true&CreateDate='. date("Y-m-d H:i:s") .'&PictureProfile='. $PathFile .'&Score=0&PenName=&Description=';

				$data = $postData;

				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method' => 'POST',
						'content' => $data,
					),
				);

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				

				//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
				if ($result == 'Valid') {
					//echo $request->input('RegistType');
					//echo "<br>เกษตรกร";
					//echo $bodyRegister;
					flash('You have been successfully registered.','success');
					return redirect('/admins');
				}
				else{
					flash($result,'danger');
					return back()->withInput();
				}

			} elseif (\Request::get('RegistType') == '03') {

				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_Writer';

				//Query
				$postData = 'FirstName='. $FirstName .'&LastName='. $LastName .'&Phone='. $Phone .'&Password='. $password .'&FarmName='. $Institution .'&Address='. $Address .'&Province='. $Province .'&District='. $District .'&SubDistrict='. $SubDistrict .'&Zipcode='. $Zipcode .'&QRCode=&AcceptCondition=true&CreateDate='. date("Y-m-d H:i:s") .'&PictureProfile='. $PathFile .'&Score=0&PenName='.$PenName.'&Description='.$Description.'';

				$data = $postData;

				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method' => 'POST',
						'content' => $data,
					),
				);

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
				if ($result == 'Valid') {
					//echo $request->input('RegistType');
					//echo "<br>นักเขียน";
					flash('You have been successfully registered.','success');
					return redirect('/admins');
				}
				else{
					flash($result,'dangers');
					return back()->withInput();
				}

			} elseif (\Request::get('RegistType') == '04') {
				
				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_User';

				//Query
				$postData = 'FirstName='. $FirstName .'&LastName=&Phone='. $Phone .'&Password='. $password .'&FarmName=&Address='. $Address .'&Province='. $Province .'&District='. $District .'&SubDistrict='. $SubDistrict .'&Zipcode='. $Zipcode .'&QRCode=&AcceptCondition=true&CreateDate='. date("Y-m-d H:i:s") .'&PictureProfile='. $PathFile .'&Score=0&PenName=&Description=';

				$data = $postData;

				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method' => 'POST',
						'content' => $data,
					),
				);

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
				if ($result == 'Valid') {
					//echo $request->input('RegistType');
					//echo "<br>เกษตรกร";
					//echo $bodyRegister;
					flash('You have been successfully registered.','success');
					return redirect('/admins');
				}
				else{
					flash($result,'danger');
					return back()->withInput();
				}
				
			} elseif (\Request::get('RegistType') == '05') {

				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_Writer';

				//Query
				$postData = 'FirstName='. $FirstName .'&LastName='. $LastName .'&Phone='. $Phone .'&Password='. $password .'&FarmName='. $Institution .'&Address='. $Address .'&Province='. $Province .'&District='. $District .'&SubDistrict='. $SubDistrict .'&Zipcode='. $Zipcode .'&QRCode=&AcceptCondition=true&CreateDate='. date("Y-m-d H:i:s") .'&PictureProfile='. $PathFile .'&Score=0&PenName='.$PenName.'&Description='.$Description.'';

				$data = $postData;

				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method' => 'POST',
						'content' => $data,
					),
				);

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				//http://farmerspace.azurewebsites.net/handlerforweb.ashx/?Method=ShowUserProfile&UserID=DCEF031495262
				if ($result == 'Valid') {
					//echo $request->input('RegistType');
					//echo "<br>ผู้ดูแลระบบ";
					flash('You have been successfully registered.','success');
					return redirect('/admins');
				}
				else{
					flash($result,'dangers');
					return back()->withInput();
				}
				
			}
		} catch (Exception $e) {
            return $e->getMessage();
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
