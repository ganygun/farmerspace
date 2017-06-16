@extends('admins.layouts.master') @section('content')
<style>
    h3 {
        font-weight: 300;
        color: #6495ed;
        margin-bottom: -10px;
    }

    .borderless td,
    .borderless th {
        vertical-align: middle!important;
        border-top: none!important;
    }
    .borderless #underline-th{
         border-bottom: 1px solid #ddd;
    }
    table {
        margin-top: 10px;
        margin: 0 auto;
            margin-bottom: 10px!important;
    }

    td {
        padding:  15px!important;
    }

    .tag {
        color: #fff;
        padding: 8px;
        background-color: #66CC00;
        font-size: 12px;
        font-weight: 300;
    }

    .btn_news_func {
        margin: 0 3px;
        border: 2px solid #6495ed;
        border-radius: 50%;
        background-color: transparent;
        color: #fff;
        outline: none;
        width: 35px;
        height: 35px;
        padding: 3px;
    }

    .btn_news_func i {
        vertical-align: middle;
    }

    .title {
        word-break: break-word;
        overflow: hidden;
        display: -webkit-box;
        line-height: 25px!important;
        /* fallback */
        max-height: 65px;
        /* fallback */
        -webkit-line-clamp: 2;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        padding-top: 18px!important;
        padding-right: 60px!important;
    }

    #dataEvent {
        color: #9DA5BE;
    }
    table.fixeds { table-layout:fixed; }
    table.fixeds td { overflow: hidden; }
    table { width: 1017px!important; }
  
</style>
<!--header start here-->
<div class="header-main" style="padding: 1.8em 2em;">
    <div class="header-center">
        <span style="font-weight: 300;font-size: 28px;color: #5d5d5d">
        <i aria-hidden="true" class="fa fa-paper-plane " style="color: #6495ed;vertical-align: middle;padding-right: 10px;font-size: 1em">
                            </i>  
            <small style="font-size: 24px;font-weight: 300;">
                News Review
            </small>
                            </span>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>

<!--heder end here-->


<!--inner block start here-->
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-12 chit-chat-layer1-left ">

                @include('flash::message')
                @if($result == 'found')
            <!-- EVENT -->
                <div class="col-md-12" >
                        @if(!empty($jsonDecodeEvent['dataListEventUnApprove']))
                        <div id="tableEvent">
                            <table class="table borderless fixeds" >
                                <tr style="background-color: #F0F0F2;margin-left: 20px;">
                                <td colspan="6"><h3>EVENT</h3></td>
                                </tr>
                                <tr id="underline-th">
                                <td class="text-center">#</td>
                                <td>Headline</td>
                                <td>Writer</td>
                                <td>Insitution</td>
                                <td>Date</td>
                                <td></td>
                                </tr>
                                <tbody>
                                <col width="20px" />
                                <col width="75px" />
                                <col width="50px" />
                                <col width="60px" />
                                <col width="50px" />
                                <col width="60px" />
                                    @foreach($jsonDecodeEvent['dataListEventUnApprove'] as $key => $dataListEventUnApprove)
                                    <form action="/admins/writing/{{ $dataListEventUnApprove['EventID'] }}/edit" method="POST">
                                        <input name="page" type="hidden" value="Review">
                                        <input name="Title" type="hidden" value="{{ $dataListEventUnApprove['Headline'] }}">
                                        <input name="Abstract" type="hidden" value="{{ $dataListEventUnApprove['Highlight'] }}">
                                        <input name="Detail" type="hidden" value="{{ $dataListEventUnApprove['Content'] }}">
                                        <input name="Picture" type="hidden" value="{{ $dataListEventUnApprove['HeadlinePic'] }}">
                                        <input name="CreatedBy" type="hidden" value="{{ $dataListEventUnApprove['Writer'] }}">
                                        <input name="Insitution" type="hidden" value="{{ $dataListEventUnApprove['Insitution'] }}">
                                        <input name="Tag" type="hidden" value="{{ $dataListEventUnApprove['Tag'] }}">
                                        <input name="CreatedDate" type="hidden" value="{{ $dataListEventUnApprove['CreatedDate'] }}">
                                        <input name="IsVerify" type="hidden" value="{{ $dataListEventUnApprove['IsVerify'] }}">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                        <tr id="dataEvent" style="border-bottom: 10px #F0F0F2 solid;">
                                            <td style="padding-left: 30px!important;">
                                                {{ $key+1 }}
                                            </td>
                                            <td class="title">
                                                {{ $dataListEventUnApprove['Headline'] }}
                                            </td>
                                            <td>
                                              {{ $dataListEventUnApprove['Writer'] }}
                                            </td>
                                            <td >
                                               <?php
                                                    $client = new GuzzleHttp\Client;
                                                    // Get company name by company id.
                                                    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                                        ['query' =>
                                                            ['Method' => 'ShowUserProfile',
                                                                'UserID' => $dataListEventUnApprove['Insitution'],
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
                                                        echo $Company;
                                                ?>
                                            </td>
                                             <td class="text_date">
                                            <div class="">
                                                {{ Carbon\Carbon::parse($dataListEventUnApprove['CreatedDate'])->format('d / m / Y') }}
                                            </div>
                                            </td>
                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                            <a class="btn btn-lg btn_news_func" href="{{ URL::to('/event/'.$dataListEventUnApprove['EventID'] .'?preview=true&type=event') }}">
                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                            </a>
                                            <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteEvent('{{ $dataListEventUnApprove['Headline'] }}','{{ $dataListEventUnApprove['EventID'] }}')">
                                                <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                            </a>
                                            <button class="btn btn-lg btn_news_func" type="submit">
                                                <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                            </button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                </div>
            <!-- VIDEO -->
                <div class="col-md-12" >
                        @if(!empty($jsonDecodeVideo['dataListVDOUnapprove']))
                        <div id="tableVideo">
                            <table class="table borderless fixeds" >
                                <tr style="background-color: #F0F0F2;margin-left: 20px;">
                                <td colspan="6"><h3>VIDEO CONTENT</h3></td>
                                </tr>
                                <tr id="underline-th">
                                <td class="text-center">#</td>
                                <td>Headline</td>
                                <td>Writer</td>
                                <td>Insitution</td>
                                <td>Date</td>
                                <td></td>
                                </tr>
                                <tbody>
                                <col width="20px" />
                                <col width="75px" />
                                <col width="50px" />
                                <col width="60px" />
                                <col width="50px" />
                                <col width="60px" />
                                    @foreach($jsonDecodeVideo['dataListVDOUnapprove'] as $key => $dataListVDOUnapprove)
                                    <form action="/admins/writing/{{ $dataListVDOUnapprove['VdoID'] }}/edit" method="POST">
                                        <input name="page" type="hidden" value="Review">
                                        <input name="Title" type="hidden" value="{{ $dataListVDOUnapprove['Headline'] }}">
                                        <input name="Abstract" type="hidden" value="{{ $dataListVDOUnapprove['Highlight'] }}">
                                        <input name="Picture" type="hidden" value="{{ $dataListVDOUnapprove['VdoUrl'] }}">
                                        <input name="Writer" type="hidden" value="{{ $dataListVDOUnapprove['Writer'] }}">
                                        <input name="Insitution" type="hidden" value="{{ $dataListVDOUnapprove['Insitution'] }}">
                                        <input name="Tag" type="hidden" value="{{ $dataListVDOUnapprove['Tag'] }}">
                                        <input name="CreatedDate" type="hidden" value="{{ $dataListVDOUnapprove['CreatedDate'] }}">
                                        <input name="IsVerify" type="hidden" value="{{ $dataListVDOUnapprove['IsVerify'] }}">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                        <tr id="dataEvent" style="border-bottom: 10px #F0F0F2 solid;">
                                            <td style="padding-left: 30px!important;">
                                                {{ $key+1 }}
                                            </td>
                                            <td class="title">
                                                {{ $dataListVDOUnapprove['Headline'] }}
                                            </td>
                                            <td>
                                              {{ $dataListVDOUnapprove['Writer'] }}
                                            </td>
                                            <td >
                                               <?php
                                                    $client = new GuzzleHttp\Client;
                                                    // Get company name by company id.
                                                    $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                                        ['query' =>
                                                            ['Method' => 'ShowUserProfile',
                                                                'UserID' => $dataListVDOUnapprove['Insitution'],
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
                                                        echo $Company;
                                                ?>
                                            </td>
                                             <td class="text_date">
                                            <div class="">
                                                {{ Carbon\Carbon::parse($dataListVDOUnapprove['CreatedDate'])->format('d / m / Y') }}
                                            </div>
                                            </td>
                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                             <a class="btn btn-lg btn_news_func" href="{{ URL::to('/video/'.$dataListVDOUnapprove['VdoID'] .'?preview=true&type=video') }}">
                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                            </a>
                                            <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteVideo('{{ $dataListVDOUnapprove['Headline'] }}','{{ $dataListVDOUnapprove['VdoID'] }}')">
                                                <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                            </a>
                                            <button class="btn btn-lg btn_news_func" type="submit">
                                                <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                            </button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                </div>
            <!-- ARTICLE -->
                <div class="col-md-12" >
                        @if(!empty($jsonDecodeNews['dataListNewsUnApprove']))
                        <div id="tableArticle">
                            <table class="table borderless fixeds" >
                                <tr style="background-color: #F0F0F2;margin-left: 20px;">
                                <td colspan="6"><h3>ARTICLE</h3></td>
                                </tr>
                                <tr id="underline-th">
                                <td class="text-center">#</td>
                                <td>Headline</td>
                                <td>Writer</td>
                                <td>Insitution</td>
                                <td>Date</td>
                                <td></td>
                                </tr>
                                <tbody>
                                <col width="20px" />
                                <col width="75px" />
                                <col width="50px" />
                                <col width="60px" />
                                <col width="50px" />
                                <col width="60px" />
                                    @foreach($jsonDecodeNews['dataListNewsUnApprove'] as $key => $dataListNewsUnApprove)
                                    <form action="/admins/writing/{{ $dataListNewsUnApprove['NewsID'] }}/edit" method="POST">
                                        <input name="page" type="hidden" value="Review">
                                        <input name="Title" type="hidden" value="{{ $dataListNewsUnApprove['Title'] }}">
                                        <input name="Abstract" type="hidden" value="{{ $dataListNewsUnApprove['Abstract'] }}">
                                        <input name="Detail" type="hidden" value="{{ $dataListNewsUnApprove['Detail'] }}">
                                        <input name="Picture" type="hidden" value="{{ $dataListNewsUnApprove['Picture'] }}">
                                        <input name="Writer" type="hidden" value="{{ $dataListNewsUnApprove['Writer'] }}">
                                        <input name="Insitution" type="hidden" value="{{ $dataListNewsUnApprove['Insitution'] }}">
                                        <input name="Tag" type="hidden" value="{{ $dataListNewsUnApprove['Tag'] }}">
                                        <input name="CreatedDate" type="hidden" value="{{ $dataListNewsUnApprove['CreatedDate'] }}">
                                        <input name="IsVerify" type="hidden" value="{{ $dataListNewsUnApprove['IsVerify'] }}">
                                        <input name="ProductID" type="hidden" value="{{ $dataListNewsUnApprove['ProductID'] }}">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                        <tr id="dataEvent" style="border-bottom: 10px #F0F0F2 solid;">
                                            <td style="padding-left: 30px!important;">
                                                {{ $key+1 }}
                                            </td>
                                            <td class="title">
                                                {{ $dataListNewsUnApprove['Title'] }}
                                            </td>
                                            <td>
                                              {{ $dataListNewsUnApprove['Writer'] }}
                                            </td>
                                            <td >
                                            <?php
                                                $client = new GuzzleHttp\Client;
                                                // Get company name by company id.
                                                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                                                    ['query' =>
                                                        ['Method' => 'ShowUserProfile',
                                                            'UserID' => $dataListNewsUnApprove['Insitution'],
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
                                                    echo $Company;
                                            ?>
                                            </td>
                                             <td class="text_date">
                                            <div class="">
                                                {{ Carbon\Carbon::parse($dataListNewsUnApprove['CreatedDate'])->format('d / m / Y') }}
                                            </div>
                                            </td>
                                            <td width="" style="text-align: left;padding-right: 30px!important;">
                                            <a class="btn btn-lg btn_news_func" href="{{ URL::to('/news/'.$dataListNewsUnApprove['NewsID'] .'?preview=true&type=article') }}">
                                                <span><i aria-hidden="true" class="fa fa-eye" style="color: #6495ed"></i></span>
                                            </a>
                                            <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteNews('{{ $dataListNewsUnApprove['Title'] }}','{{ $dataListNewsUnApprove['NewsID'] }}')">
                                                <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                            </a>
                                            <button class="btn btn-lg btn_news_func" type="submit">
                                                <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                            </button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                </div>

                @elseif($result == 'notfound')
                   <div class="col-md-12 text-center" style="height: 100vh">
                    <h3 style="font-size:2.5em;color:rgb(80, 147, 225);margin-top: 80px">ไม่พบบทความ</h3>
                    <div style="margin: 40px;font-size: 18px;color: #9DA5BE">คุณได้ตรวจสอบ บทความ วีดีโอ กิจกรรม เรียบร้อยแล้ว
                        <br> เรารู้ว่าคุณทำได้! มาร่วมพัฒนาองค์ความรู้เพิ่มเติม
                        <br> เพื่อพัฒนาศักยภาพเกษตรกร สร้างคุณค่า และเพื่อคุณภาพสังคมที่ยั่งยืน </div>
                    <a class="btn btn-lg" href="/admins/writing" style="border-radius: 0px;background-color: #6495ed;color:#fff">
                        <span>
                            <h3 style="font-size:1.6em;padding: 4px 50px;color:#fff;margin: 10px 0;">  เริ่มเขียนบทความ
                                <i aria-hidden="true" class="fa fa-pencil" style="margin-bottom: 0px;padding-left:10px">
                                </i>
                            </h3>
                        </span>
                    </a>
                </div>
                @endif
        </div>
        <div class="clearfix">
        </div>
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
    <!-- Trigger the modal with a button -->
    <script type="text/javascript">
        function DeleteEvent(Headline,id) {
            if (confirm('Do you want to delete Event : ' + Headline)) {
                    var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteEvent", "EventID": id});
                    fetch(url,{
                        mode: 'no-cors',
                        method: 'get',
                    });
                    location.reload();
            } else {
                // Do nothing!
            }
        }
        function DeleteVideo(Headline,id) {
            if (confirm('Do you want to delete Video : ' + Headline)) {
                    var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeletelVdo", "VdoID": id});
                    fetch(url,{
                        mode: 'no-cors',
                        method: 'get',
                    });
                    location.reload();
            } else {
                // Do nothing!
            }
        }
        function DeleteNews(Title,id) {
            if (confirm('Do you want to delete Article : ' + Title)) {
                    var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteNews", "NewsID": id});
                    fetch(url,{
                        mode: 'no-cors',
                        method: 'get',
                    });
                    location.reload();
            } else {
                // Do nothing!
            }
        }
    </script>
    <script>
    $( document ).ready(function() {
        $('#verify-text a').css('color', '#5093E1');
        $('#verify-text').css('border-left', '4px solid #5093E1');
    });
    </script>



</div>
<!--inner block end here-->
@endsection
