<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Session;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Get Post by page id.
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getPost($id) {

        $client = new Client([
            // Base URI is used with relative requests
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);
        try {
            //article.
            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                ['query' =>
                    ['Method' => 'ShowAllVDOSearch',
                        'VdoID' => '',
                        'Number' => '0',
                        'Language' => 'THA',
                    ],
                ]);

            $bodyVideoAll = $response->getBody();
            $jsonDecodeVdoAll = json_decode($bodyVideoAll, true);

            if (Session::get('cerentPage') > count($jsonDecodeVdoAll['dataListVDO'])) {
                echo '<script>';
                echo '$("#loading").show();';
                echo '$("#notfound").html("<p>ไม่พบรายการวีดีโอ</p>");';
                echo '$("#notfound").css("margin","40px 0");';
                echo '$("#notfound").addClass("text-center");';
                echo '$("#loading").hide();';
                echo '</script>';
            }
            else{
                echo '<script>';
                echo '$("#loading").show();';
                echo '$("#notfound").html("");';
                echo '$("#notfound").css("margin","40px 0");';
                echo '$("#notfound").addClass("text-center");';
                echo '</script>';
                // first, this page have 7 ea. and than we call more 1 ea.
                $id = Session::get('cerentPage');
                // count page to call in this times
                $countPage = count($jsonDecodeVdoAll['dataListVDO']);
                // increase 1 ea. to call 7-8 = 1 ea.
                $id++;
                // for call by countPage & array position -1 Ex. index[6-10] array[5-9]
                for ($i = $id; $i <= $countPage ; $i++) {
                        $VdoUrl = $jsonDecodeVdoAll['dataListVDO'][$i-1]['VdoUrl'];
                        $Headline = $jsonDecodeVdoAll['dataListVDO'][$i-1]['Headline'];
                        $Highlight = $jsonDecodeVdoAll['dataListVDO'][$i-1]['Highlight'];
                        $ID =$jsonDecodeVdoAll['dataListVDO'][$i-1]['VdoID'];
                        echo '<p class="text-center" style="margin: 40px 0;">"'.$Headline.'"</p>';
                        //echo '"'.Session('cerentPage').'"';

                    Session::put('cerentPage', $countPage);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

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
            
            Session::put('cerentPage', '7'); //+ๅ
            
            if (!empty($jsonDecodeVdoAll['dataListVDO'])) {
                return view('homepage.video')
                    ->with('jsonDecodeVdoAll', json_decode($bodyVdoAll, true));
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
                // get video content by id.
                    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                       ['query' =>
                            ['Method' => 'ShowAllVDOSearch',
                                'VdoID' => '',
                                'Number' => '10',
                                'Language' => 'THA',
                            ],
                        ]);

                    $bodyVideoContent = $response->getBody();
                    $jsonDecodeVideoContent = json_decode($bodyVideoContent, true);

                foreach ($jsonDecodeVideoContent['dataListVDO'] as $key => $value) {
                    if ($jsonDecodeVideoContent['dataListVDO'][$key]['VdoID'] == $id) {
            
                        // get writer profile by create by.
                            $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                ['query' =>
                                    ['Method' => 'ShowUserProfile',
                                        'UserID' => $jsonDecodeVideoContent['dataListVDO'][$key]['CreatedBy'],
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

                        //------------- video Content---------------
                            return view('homepage.video_content')
                            ->with('ID', $jsonDecodeVideoContent['dataListVDO'][$key]['VdoID'])
                            ->with('Title', $jsonDecodeVideoContent['dataListVDO'][$key]['Headline'])
                            ->with('Abstract', $jsonDecodeVideoContent['dataListVDO'][$key]['Highlight'])
                            ->with('VdoUrl', $jsonDecodeVideoContent['dataListVDO'][$key]['VdoUrl'])
                            ->with('Picture', 'https://i.ytimg.com/vi/'.substr($jsonDecodeVideoContent['dataListVDO'][$key]['VdoUrl'], strpos($jsonDecodeVideoContent['dataListVDO'][$key]['VdoUrl'], 'embed/') + 6) .'/hqdefault.jpg')
                            ->with('CreatedDate', $jsonDecodeVideoContent['dataListVDO'][$key]['CreatedDate'])
                            ->with('Tag', $jsonDecodeVideoContent['dataListVDO'][$key]['Tag'])
                            ->with('Type', 'Video')
                        //------------- Profile---------------
                            ->with('PictureProfile', $jsonDecodeShowUserProfile['dataListProfile'][0]['PictureProfile'])
                            ->with('PenName', $jsonDecodeShowUserProfile['dataListProfile'][0]['PenName'])
                            ->with('Description', $jsonDecodeShowUserProfile['dataListProfile'][0]['Description'])
                            ->with('Company', $Company)
                            ->with('Type', 'Video');
                    }
                }
            }
            // preview video.
            elseif (\Request::get('preview') == 'true' && \Request::get('type') == 'video') {
                // get news content by id.
                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                   ['query' =>
                        ['Method' => 'ShowAllVdoUnApprove',
                            'VdoID' => '',
                            'Language' => '',
                        ],
                    ]);

                $bodyVideoContent = $response->getBody();
                $jsonDecodeVideoContent = json_decode($bodyVideoContent, true);

                foreach ($jsonDecodeVideoContent['dataListVDOUnapprove'] as $key => $value) {
                    if ($jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['VdoID'] == $id) {

                        //------------- Video Content---------------
                            return view('homepage.video_content')
                            ->with('ID', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['VdoID'])
                            ->with('Title', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['Headline'])
                            ->with('Abstract', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['Highlight'])
                            ->with('VdoUrl', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['VdoUrl'])
                            ->with('Picture', 'https://i.ytimg.com/vi/'.substr($jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['VdoUrl'], strpos($jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['VdoUrl'], 'embed/') + 6) .'/hqdefault.jpg')
                            ->with('CreatedDate', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['CreatedDate'])
                            ->with('Tag', $jsonDecodeVideoContent['dataListVDOUnapprove'][$key]['Tag'])
                            ->with('Type', 'Video')
                        //------------- Profile---------------
                            ->with('PictureProfile', 'https://s3.amazonaws.com/whisperinvest-images/default.png')
                            ->with('PenName', 'PenName PenName')
                            ->with('Description', 'Description Description')
                            ->with('Company', 'Company Company')
                            ->with('preview', 'true');

                    }
                }
            }
            else{
                return redirect('/');
            }
        } catch (Exception $e) {
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
