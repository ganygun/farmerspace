<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);

        try {
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
            
            Session::put('countPage', '2'); //+2 ทีละ 2
            
            if (!empty($jsonDecodeEventAll['dataListEvent'])) {
                return view('homepage.event')
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
    
        try {
            if (empty(\Request::get('preview')) && empty(\Request::get('type'))) {
                // get news content by id.
                    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                       ['query' =>
                            ['Method' => 'ShowAllEventSearch',
                                'EventID' => '',
                                'Number' => '0',
                                'Language' => 'THA',
                            ],
                        ]);

                    $bodyEventNewsContent = $response->getBody();
                    $jsonDecodeEventContent = json_decode($bodyEventNewsContent, true);

                foreach ($jsonDecodeEventContent['dataListEvent'] as $key => $value) {
                    if ($jsonDecodeEventContent['dataListEvent'][$key]['EventID'] == $id) {
            
                        // get writer profile by create by.
                            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                ['query' =>
                                    ['Method' => 'ShowUserProfile',
                                        'UserID' => $jsonDecodeEventContent['dataListEvent'][$key]['CreatedBy'],
                                    ],
                                ]);

                            $bodyShowUserProfile = $response->getBody();
                            $jsonDecodeShowUserProfile = json_decode($bodyShowUserProfile, true);

                        
                        // get company name by company id.
                            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                ['query' =>
                                    ['Method' => 'ShowUserProfile',
                                        'UserID' => $jsonDecodeShowUserProfile['dataListProfile'][0]['Company'],
                                    ],
                                ]);

                            $bodyGetCompanyName = $response->getBody();
                            $jsonDecodeGetCompanyName = json_decode($bodyGetCompanyName, true);
                            if (isset($jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'])) {
                                $Company =  $jsonDecodeGetCompanyName['dataListProfile'][0]['PenName'];
                            }
                            else{
                                $Company = 'Not Company';
                            }

                        //------------- news Content---------------
                            return view('homepage.event_content')
                            ->with('ID', $jsonDecodeEventContent['dataListEvent'][$key]['EventID'])
                            ->with('Title', $jsonDecodeEventContent['dataListEvent'][$key]['Headline'])
                            ->with('Abstract', $jsonDecodeEventContent['dataListEvent'][$key]['Highlight'])
                            ->with('Detail', $jsonDecodeEventContent['dataListEvent'][$key]['Content'])
                            ->with('Picture', $jsonDecodeEventContent['dataListEvent'][$key]['HeadlinePic'])
                            ->with('CreatedDate', $jsonDecodeEventContent['dataListEvent'][$key]['CreatedDate'])
                            ->with('Tag', $jsonDecodeEventContent['dataListEvent'][$key]['Tag'])
                            ->with('Type', 'Event')
                        //------------- Profile---------------
                            ->with('PictureProfile', $jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile'])
                            ->with('PenName', $jsonDecodeShowUserProfile['dataListProfile'][0]['PenName'])
                            ->with('Description', $jsonDecodeShowUserProfile['dataListProfile'][0]['Description'])
                            ->with('Company', $Company);
                    }
                }
            }
        
            // preview event.
            elseif (\Request::get('preview') == 'true' && \Request::get('type') == 'event') {
                // get news content by id.
                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                   ['query' =>
                        ['Method' => 'ShowAllEventUnApprove',
                            'EventID' => '',
                            'Language' => '',
                        ],
                    ]);

                $bodyNewsContent = $response->getBody();
                $jsonDecodeEventContent = json_decode($bodyNewsContent, true);

                foreach ($jsonDecodeEventContent['dataListEventUnApprove'] as $key => $value) {
                    if ($jsonDecodeEventContent['dataListEventUnApprove'][$key]['EventID'] == $id) {

                        //------------- news Content---------------
                            return view('homepage.event_content')
                            ->with('ID', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['EventID'])
                            ->with('Title', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['Headline'])
                            ->with('Abstract', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['Highlight'])
                            ->with('Detail', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['Content'])
                            ->with('Picture', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['HeadlinePic'])
                            ->with('Tag', $jsonDecodeEventContent['dataListEventUnApprove'][$key]['Tag'])
                            ->with('Type', 'Event')
                        //------------- Profile---------------
                            ->with('PictureProfile', 'https://s3.amazonaws.com/whisperinvest-images/default.png')
                            ->with('PenName', 'PenName PenName')
                            ->with('Description', 'Description Description')
                            ->with('Company', 'Company Company')
                        //------------- Product Detail---------------
                            ->with('preview', 'true');
                    }
                }
            }
            else{
                return redirect('/');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
