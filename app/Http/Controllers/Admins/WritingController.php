<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class WritingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}else {
			return view('admins.dashboard.writing');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}

		if (empty(\Request::get('lang'))) {
			flash('Please Choose Langauge', 'danger');
			return back()->withInput();
		}
		if (empty(\Request::get('tag')) && \Request::get('type') != 'อีเวนท์') {
			flash('Please Choose Tag Type', 'danger');
			return back()->withInput();
		}
		if (empty(\Request::get('type'))) {
			flash('Please Choose Type', 'danger');
			return back()->withInput();
		}

		$lang = \Request::get('lang'); //<-- we use global request to get the param of URI
		$tag = '';
		//Get View Tyle Event
		if (\Request::get('type') == 'อีเวนท์') {
			$tag = 'อีเวนท์';
			return view('admins.dashboard.writing.type.event')
				->with('lang', $lang)
				->with('type', $tag);
		}
		//Get View Tyle Video
		elseif (\Request::get('type') == 'วีดีโอ') {
			$tagsName = \Request::get('tag');
			$tag = 'วีดีโอ,';
			foreach ($tagsName as $key => $value) {
				if ($key == 0) {
					$tag .= $value;
				} else {
					$tag .= ',' . $value;
				}
			}
			return view('admins.dashboard.writing.type.video')
				->with('lang', $lang)
				->with('type', $tag);
		}
		//Get View Tyle All
		elseif (\Request::get('type') == 'Article') {
			$tagsName = \Request::get('tag');
			foreach ($tagsName as $key => $value) {
				if ($key == 0) {
					$tag .= $value;
				} else {
					$tag .= ',' . $value;
				}
			}
			return view('admins.dashboard.writing.create')
				->with('lang', $lang)
				->with('type', $tag);
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}

		if (empty($request->input('tagsName'))) {
			flash('Please Enter Tag Name', 'danger');
			return back()->withInput();
		}
		$lang = $request->input('lang');
		$topic = $request->input('labelTopic');
		$abtract = $request->input('labelAbstract');
		$detail = $request->input('myTextarea');
		$image = $request->input('PathFile');
		$tagsName = '';
		$getView = 'a';
		$InsertType = '';

		foreach ($request->input('tagsName') as $key => $value) {
			if ($key == 0) {
				$tagsName .= $value;
			} else {
				$tagsName .= ',' . $value;
			}
		}

		foreach ($request->input('tagsName') as $value) {
			if ($value == 'วีดีโอ') {
				$getView = 'v';
			}
			if ($value == 'อีเวนท์') {
				$getView = 'e';
			}
		}

		try {
			//Get View Tyle Event
			if ($getView == 'e') {
				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_Event';

				$postData = '&EventID=&HeadlinePic=' . $image . '&Headline=' . $topic . '&Highlight=' . $abtract . '&Content=' . $detail . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

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
				if ($result === FALSE) { /* Handle error */}
				$InsertType = 'Event';
			}
			//Get View Tyle Video
			elseif ($getView == 'v') {

				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_Vdo';

				$postData = '&VdoID=&Headline=' . $topic . '&VdoUrl=' . $image . '&Highlight=' . $abtract . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

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
				if ($result === FALSE) { /* Handle error */}
				$InsertType = 'Video';

			}
			//Get View Tyle All
			elseif ($getView == 'a') {
				$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_News';

				$postData = '&NewsID=&ProductID=&Title=' . $topic . '&Abstract=' . $abtract . '&Detail=' . $detail . '&Picture=' . $image . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

				//test api
				//$postData = '&NewsID=&ProductID=PDEN000000030&Title=test&Abstract=test&Detail=test&Picture=test&CreatedBy=' . date("Y-m-d H:i:s") . '&CreatedDate=test&Tag=test';

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
				if ($result === FALSE) { /* Handle error */}
				$InsertType = 'News';
			}

			if ($result == 'Insert') {
				flash('Insert ' . $InsertType . ' Successful', 'success');
				return view('admins.dashboard.writing.detail');
			} else {
				flash('Something Worng. Please Check it <br>' . $result, 'danger');
				return back()->withInput();
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
		

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}

		$getView = 'a';
		foreach (explode(',', \Request::get('Tag')) as $value) {
			if ($value == 'วีดีโอ') {
				$getView = 'v';
			}
			if ($value == 'อีเวนท์') {
				$getView = 'e';
			}
		}

		// Get Product Name/ID --------------------------------------------------------------------------------
			$client = new Client();
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
				['query' =>
					['Method' => 'Search_Product',
						'ProductName' => '',
					],
				]);
			$bodyGetProduct = $response->getBody();
			$jsonDecodeGetProduct = json_decode($bodyGetProduct, true);
		// End --------------------------------------------------------------------------------

		return view('admins.dashboard.writing.edit')
			->with('ID', $id)
			->with('Title', \Request::get('Title'))
			->with('Abstract', \Request::get('Abstract'))
			->with('Detail', \Request::get('Detail'))
			->with('Picture', \Request::get('Picture')) //Video type : VdoUrl
			->with('Tag', \Request::get('Tag'))
			->with('CreatedDate', \Request::get('CreatedDate'))
			->with('CreatedBy', \Request::get('CreatedBy'))
			->with('ProductID', \Request::get('ProductID'))
			->with('page',\Request::get('page'))
			->with('jsonDecodeGetProduct', json_decode($bodyGetProduct, true))
			->with('EditType', $getView);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}
		
		if (empty($request->input('tagsName'))) {
			flash('Please Enter Tag Name', 'danger');
			return back()->withInput();
		}

		// global parameter
			$page = $request->input('page');
			$tagsName = '';
			$getApi = 'a';
			$UpdateType = '';

			// merge tag together
				foreach ($request->input('tagsName') as $key => $value) {
				if ($key == 0) {
					$tagsName .= $value;
				} else {
					$tagsName .= ',' . $value;
				}
				}

			// filter API type of news
				foreach ($request->input('tagsName') as $value) {
				if ($value == 'วีดีโอ') {
					$getApi = 'v';
				}
				if ($value == 'อีเวนท์') {
					$getApi = 'e';
				}
				}

			//Get Language News
				$lang = '';
				$getLang = substr($id, 1, 3);
				// -- THA w
				if ($getLang == 'THA') {
					$lang = 'THA';
				}
				// -- ENG e
				elseif ($getLang == 'ENG') {
					$lang = 'ENG';
				}
		// end global paraeter -------------------------------------------
		
		// Update condition
		if ($request->input('submit') == 'update') {

			try {
			
				//Get Api Type Event
				if ($getApi == 'e') {
					// define parameter Event type
					// -- type Event
						$topic = $request->input('labelTopic');
						$abtract = $request->input('labelAbstract');
						$detail = $request->input('myTextarea');
						$image = $request->input('PathFile');
					// -------------

					$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_Event';

					$postData = '&EventID=' . $id . '&HeadlinePic=' . $image . '&Headline=' . $topic . '&Highlight=' . $abtract . '&Content=' . $detail . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

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
					if ($result === FALSE) { /* Handle error */}
					$UpdateType = 'Event';
				}
				//Get Api Type Video
				elseif ($getApi == 'v') {
					// define parameter Video type
					// -- type Video
						$topic = $request->input('labelTopic');
						$abtract = $request->input('labelAbstract');
						$image = $request->input('PathFile');
					// -------------

					$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_Vdo';

					$postData = '&VdoID=' . $id . '&Headline=' . $topic . '&VdoUrl=' . $image . '&Highlight=' . $abtract . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

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
					if ($result === FALSE) { /* Handle error */}
					$UpdateType = 'Video';
				}
				//Get Api Type Article
				elseif ($getApi == 'a') {
					// define parameter Article type
					// -- type Article
						$topic = $request->input('labelTopic');
						$abtract = $request->input('labelAbstract');
						$detail = $request->input('myTextarea');
						$image = $request->input('PathFile');
					// -------------

					$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_News';

					$postData = '&NewsID=' . $id . '&ProductID=&Title=' . $topic . '&Abstract=' . $abtract . '&Detail=' . $detail . '&Picture=' . $image . '&CreatedBy=' . Session::get('key') . '&CreatedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=false';

					//test api
					//$postData = '&NewsID=&ProductID=PDEN000000030&Title=test&Abstract=test&Detail=test&Picture=test&CreatedBy=' . date("Y-m-d H:i:s") . '&CreatedDate=test&Tag=test';

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
					if ($result === FALSE) { /* Handle error */}
					$UpdateType = 'Article';
				}

				if ($result == 'Update') {
					flash('Update ' . $UpdateType . ' Successful', 'success');
					return view('admins.dashboard.writing.detail');
				} else {
					flash('Something Worng. Please Check it <br>' . $result, 'danger');
					return back()->withInput();
				}

			} catch (Exception $e) {
            	return $e->getMessage();
			}
		}
		// Admin Verify
		elseif ($request->input('submit') == 'verify') {
			if (Session::get('role') == 'Admin' && $page == 'Review') {
				try {
					if ($getApi == 'e'){
						// define parameter Eveny type
						// -- type Event
							$topic = $request->input('labelTopic');
							$abtract = $request->input('labelAbstract');
							$detail = $request->input('myTextarea');
							$image = $request->input('PathFile');
						// -------------

						$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_EventAdmin';

						$postData = '&EventID=' . $id . '&HeadlinePic=' . $image . '&Headline=' . $topic . '&Highlight=' . $abtract . '&Content=' . $detail . '&ApprovedBy=' . Session::get('key') . '&ApprovedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=true';

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
						if ($result === FALSE) { /* Handle error */}
						$UpdateType = 'Event';
					}
					elseif ($getApi == 'v'){
						// define parameter Video type
						// -- type Video
							$topic = $request->input('labelTopic');
							$abtract = $request->input('labelAbstract');
							$detail = $request->input('myTextarea');
							$vdourl = $request->input('PathFile');
						// -------------

						$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_VdoAdmin';

						$postData = '&VdoID=' . $id . '&Headline=' . $topic . '&VdoUrl=' . $vdourl . '&Highlight=' . $abtract . '&ApprovedBy=' . Session::get('key') . '&ApprovedDate=' . date("Y-m-d H:i:s") . '&Tag=' . $tagsName . '&Language=' . $lang . '&IsVerify=true';

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
						if ($result === FALSE) { /* Handle error */}
						$UpdateType = 'Video';

					}
					elseif ($getApi == 'a'){
						// define parameter Article type
						// -- product id
							$productID = $request->input('productID');
						// -- type Article
							$topic = $request->input('labelTopic');
							$abtract = $request->input('labelAbstract');
							$detail = $request->input('myTextarea');
							$image = $request->input('PathFile');
							//$writer = $request->input('CreatedBy');
						// -------------

						$url = 'https://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Edit_NewsAdmin';

						$postData = '&NewsID=' . $id . '&ProductID=' . $productID . '&Title=' . $topic . '&Abstract=' . $abtract . '&Detail=' . $detail . '&Picture=' . $image . '&Tag=' . $tagsName . '&ApprovedBy='. Session::get('key') .'&ApprovedDate=' . date("Y-m-d H:i:s") . '&Language=' . $lang . '&IsVerify=true';

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
						if ($result === FALSE) { /* Handle error */}
						$UpdateType = 'Article';

					}
					if ($result == 'Update') {
							flash('Verify ' . $UpdateType . ' Successful', 'success');
							return view('admins.dashboard.writing.detail');
					} else {
							flash('Something Worng. Please Check it <br>' . $result, 'danger');
							return back()->withInput();
					}
				} catch (Exception $e) {
            		return $e->getMessage();
				}
			}
		}

	

		
			

		

		

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

	public function SearchNews() {
		echo "News Search";
	}
}
