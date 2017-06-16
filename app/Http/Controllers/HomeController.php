<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
        
        $client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
        try {
	        //article.
	        $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
	            ['query' =>
	                ['Method' => 'ShowAllNews',
	                    'ProductID' => '',
	                    'Number' => '0',
	                    'Language' => 'THA',
	                ],
	            ]);

	        $bodyNewsAll = $response->getBody();
	        $jsonDecodeNewsAll = json_decode($bodyNewsAll, true);

	        //video.
            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                ['query' =>
                    ['Method' => 'ShowAllVDOSearch',
                        'VdoID' => '',
                        'Number' => '0',
                        'Language' => 'THA',
                    ],
                ]);

            $bodyVdoAll = $response->getBody();
            $jsonDecodeVdoAll = json_decode($bodyVdoAll, true);

            //event.
            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                ['query' =>
                    ['Method' => 'ShowAllEventSearch',
                        'EventID' => '',
                        'Number' => '0',
                        'Language' => 'THA',
                    ],
                ]);

            $bodyEventAll = $response->getBody();
            $jsonDecodeEventAll = json_decode($bodyEventAll, true);
        

	        if (!empty($jsonDecodeNewsAll['dataListNews']) || !empty($jsonDecodeVdoAll['dataListVDO']) || !empty($jsonDecodeEventAll['dataListEvent'])) {
	            return view('homepage.index')
	                ->with('jsonDecodeNewsAll', json_decode($bodyNewsAll, true))
	                ->with('jsonDecodeVdoAll', json_decode($bodyVdoAll, true))
                    ->with('jsonDecodeEventAll', json_decode($bodyEventAll, true));
	        }

   		} catch (\Exception $e) {
            return $e->getMessage();
        }

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
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

	/* Search Product */
	public function Search() {
		$client = new Client([
			// Base URI is used with relative requests
			// You can set any number of default request options.
			'timeout' => 2.0,
		]);
		$key = \Request::get('key'); //<-- we use global request to get the param of URI

		return view('homepage.search')
			->with('key', $key);

	}

	
}
