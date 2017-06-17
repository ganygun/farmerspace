<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller {

	public function SearchProduct() {
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);
		$search = \Request::get('search'); //<-- we use global request to get the param of URI

		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'Search_Product',
					'ProductName' => $search,
				],
			]);
		$bodySearch = $response->getBody();
		$jsonDecode = json_decode($bodySearch, true);
		if (!empty($jsonDecode['dataListProduct'])) {
			return view('admins.dashboard.product')
				->with('jsonDecode', json_decode($bodySearch, true))
				->with('result', 'found');
		} else {
			return view('admins.dashboard.product')->with('result', 'notfound')
			->with('search_result', $search);
		}

		//$offices = Office::where('name','like','%'.$search.'%')
		//    ->orderBy('name')
		//     ->paginate(20);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Session::get('role') != 'Admin') {
			return Redirect('/admins/myarticle');
		}
		/**
		 * Check User Logon !!
		 */
		if (empty(Session::get('key'))) {
			return Redirect(url('/admins'));
		}

		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 10.0,
		]);

		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'Search_Product',
					'ProductName' => '',
				],
			]);

		$bodySearch = $response->getBody();
		$jsonDecode = json_decode($bodySearch, true);
		if (!empty($jsonDecode['dataListProduct'])) {
			return view('admins.dashboard.product')
				->with('jsonDecode', json_decode($bodySearch, true))
				->with('result', 'found');
		}
		else{
			return view('admins.dashboard.product')
			->with('result', 'notfound');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admins.dashboard.product.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$ProductName = ($_POST["productName"]);
		$PathFile = $_POST["PathFile"];
		$ReferenceThai = $_POST["referenceText"];

		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);

		// Add product detail and get id product
		// Product Thai
		if ($_POST["language"] == "tha") {
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Insert_Product_THA',
						'UserID' => Session::get('key'),
						'ProductName' => $ProductName,
						'Species' => 'Overview',
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyProduct = $response->getBody();
		}
		// Product English
		elseif ($_POST["language"] == "eng") {
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Insert_Product_ENG',
						'UserID' => Session::get('key'),
						'ProductName' => $ProductName,
						'Species' => 'Overview',
						'ReferenceThai' => $ReferenceThai,
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyProduct = $response->getBody();
		}
		// --------------------------------------------

		// Implicitly cast the body to a string and echo it
		if ($bodyProduct != "Duplicate Key") {
			Session::put('productKey', (string) $bodyProduct);

			// Add Overview Species TH
			if (substr(Session::get('productKey'), 2, 2) == 'TH') {
				$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_THA';
				$postData = '&UserID=' . Session::get('key') . '&ProductID=' . Session::get('productKey') . '&Species=Overview&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';

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
				$bodyOverview = $result;
			}
			// Add Overview Species ENG
			elseif(substr(Session::get('productKey'), 2, 2) == 'EN'){
				$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_ENG';
				$postData = '&UserID=' . Session::get('key') . '&ProductID=' . Session::get('productKey') . '&Species=Overview&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';

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
				$bodyOverview = $result;
			}
		

			// Add spicies's Name
			if (!empty($_POST["spiciesName"])) {
				foreach ($_POST["spiciesName"] as $value) {
					if (substr(Session::get('productKey'), 2, 2) == 'TH') {
						$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_THA';
						$postData = '&UserID=' . Session::get('key') . '&ProductID=' . (string) $bodyProduct . '&Species=' . $value . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';
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
						$bodySpecies = $result;
					} 
					elseif(substr(Session::get('productKey'), 2, 2) == 'EN') {
						$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_ENG';
						$postData = '&UserID=' . Session::get('key') . '&ProductID=' . (string) $bodyProduct . '&Species=' . $value . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';
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
						$bodySpecies = $result;
					}
				}
			}
			// ------------ End

			// Add product's image
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Insert_Product_Pic',
						'UserID' => Session::get('key'),
						'ProductID' => Session::get('productKey'),
						'Image' => $PathFile,
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyImage = $response->getBody();
			if ((string) $bodyImage == "Completed") {
				flash('new product was successfully added', 'success');
				return redirect('/admins/product/overview/' . Session::get('productKey') . '/edit')->with('error', '1');
			} else {
				flash('Images Uncompleted, but you can edit after this', 'warning');
				return redirect('/admins/product/overview/' . Session::get('productKey') . '/edit')->with('error', '0');
			}
			// ----------------------------------------
		} else {
			flash('Duplicate Key please try again', 'danger');
			return redirect('/admins/product/create')->withInput();
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
		Session::put('productKey', $id);

		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);
		// Show Image --------------------------------------
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowProductPicture',
					'ProductID' => $id,
				],
			]);
		$bodyImage = $response->getBody();
		$jsonDecode_bodyImage = json_decode($bodyImage, true);
		// --------------------------------------------
		// Show Product --------------------------------------
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'ShowProduct',
					'ProductID' => $id,
				],
			]);
		$bodyProduct = $response->getBody();
		$jsonDecode_bodyProduct = json_decode($bodyProduct, true);
		// --------------------------------------------
		// Show Species --------------------------------------
		$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
			['query' =>
				['Method' => 'Show_AllSpecies',
					'ProductID' => $id,
				],
			]);
		$bodySpecies = $response->getBody();
		$jsonDecode_bodySpecies = json_decode($bodySpecies, true);
		// --------------------------------------------

		if (!empty($jsonDecode_bodyProduct['dataListProduct']) || !empty($jsonDecode_bodyImage['dataListProductPicture']) || !empty($jsonDecode_bodySpecies['dataListSpecies'])) {
			return view('admins.dashboard.product.create')
				->with('jsonDecode_bodyProduct', json_decode($bodyProduct, true))
				->with('jsonDecode_bodyImage', json_decode($bodyImage, true))
				->with('jsonDecode_bodySpecies', json_decode($bodySpecies, true));
			//->with('result', $search);
		} else {
			flash('Search is not found', 'danger');
			return redirect('/admins/product/');
		}
		//flash('Message', 'info');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 10.0,
		]);

		// -------------- Update Product Thai
		if ($request->input('language') == "tha") {
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Update_Product_THA',
						'ProductID' => $id,
						'UserID' => Session::get('key'),
						'ProductName' => $request->input('productName'),
						'Species' => 'Overview',
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyProduct = $response->getBody();
		}
		// -------------- Update Product English
		elseif ($request->input('language') == "eng") {
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Update_Product_ENG',
						'ProductID' => $id,
						'UserID' => Session::get('key'),
						'ProductName' => $request->input('productName'),
						'Species' => 'Overview',
						'ReferenceThai' => $request->input('referenceText'),
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyProduct = $response->getBody();
		}
		// --------------------------------------------

		// -------------- Check New Species
		if (!empty($request->input('spiciesName'))) {
			foreach ($request->input('spiciesName') as $value) {

				if (substr(Session::get('productKey'), 2, 2) == 'TH') {
					$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_THA';
					$postData = '&UserID=' . Session::get('key') . '&ProductID=' . $id . '&Species=' . $value . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';
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
					$bodySpecies = $result;
				} 
				elseif(substr(Session::get('productKey'), 2, 2) == 'EN') {
					$url = 'http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?Method=Insert_SpeciesItem_ENG';
					$postData = '&UserID=' . Session::get('key') . '&ProductID=' . $id . '&Species=' . $value . '&CreateDate=' . date("Y-m-d H:i:s") . '&ItemDescription=&GrowingGuide=';
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
					$bodySpecies = $result;
				}

			}
		}
		// --------------------------------------------
		if ($request->input('imageID') != '') {
			// -------------- Update Product Image
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Update_Product_Pic',
						'ID' => $request->input('imageID'),
						'UserID' => Session::get('key'),
						'ProductID' => $id,
						'Image' => $request->input('PathFile'),
						'UpdateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyImage = $response->getBody();
			// --------------------------------------------
		} else {
			// -------------- Add Product Image
			$response = $client->request("GET", "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx",
				['query' =>
					['Method' => 'Insert_Product_Pic',
						'UserID' => Session::get('key'),
						'ProductID' => $id,
						'Image' => $request->input('PathFile'),
						'CreateDate' => date("Y-m-d H:i:s"),
					],
				]);
			$bodyImage = $response->getBody();
			// --------------------------------------------
		}

		// -------------- Success
		if ($bodyProduct == "Updated") {
			flash('product was successfully updated', 'success');
			return redirect('admins/product/overview/' . $id . '/edit');
		} else {
			flash('Something worng please check it out <br>' . (string) $bodyProduct . '', 'danger');
			return redirect('admins/product/' . $id . '/edit');

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

	
}
