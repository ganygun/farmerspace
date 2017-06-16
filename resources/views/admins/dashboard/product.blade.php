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
        padding: 10px 10px!important;
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

    #dataNews {
        color: #9DA5BE;
    }
    table.fixeds { table-layout:fixed; }
    table.fixeds td { overflow: hidden; }
</style>
    <!--header start here-->
    <div class="header-main" style="padding: 1.7em 2em;">
        <div class="header-left" style="width: 50%">
            <h2 style="margin-top: 0.3em;color: #6495ed">
                            <small style="font-size: 24px;font-weight: 300;">
                               Add Product / Create
                            </small>
                        </h2>
            <div class="clearfix"> </div>
        </div>
        <div class="header-right" style="width: 50%">
            <form role="search" method="GET" action="{{ url('/admins/search') }}">
                {{ csrf_field() }}
                <!--search-box-->
                <div class="search-box">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <input type="submit" value="">
                </div>
            </form>
            <!--//end-search-box-->
            <div class="profile_details_left">
                <!--notifications of menu start -->
                <div class="clearfix"> </div>
            </div>
            <!--notification menu end -->
            <div class="profile_details">
                <ul>
                    <li class="dropdown profile_details_drop">
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!--heder end here-->

    <!--inner block start here-->
    <div class="inner-block">
        <!--mainpage chit-chating-->
        <div class="chit-chat-layer1">
            <div class="col-md-12 chit-chat-layer1-left">
                <div id="table" class="work-progres">
                        @if($result =='found')
                        <!-- Product Thai-->
                        <div class="col-md-6" >
                                @if(!empty($jsonDecode['dataListProduct']))
                                    <table class="table borderless fixeds" >
                                        <tr id="underline-th">
                                        <td>ID</td>
                                        <td>Product</td>
                                        <td></td>
                                        </tr>
                                        <tr style="background-color: #F0F0F2;margin-left: 20px;">
                                        <td colspan="3"><h3 style="padding: 10px 0;">ภาษาไทย</h3></td>
                                        </tr>
                                        <tbody>
                                        <col width="75px" />
                                        <col width="75px" />
                                        <col width="75px" />
                                            @foreach($jsonDecode['dataListProduct'] as $dataListProduct)
                                            @if(substr($dataListProduct['ProductID'], 2, 2) == 'TH')
                                                <tr id="dataNews">
                                                    <td>{{ $dataListProduct['ProductID'] }}</td>
                                                    <td>{{ $dataListProduct['ProductName'] }}</td>
                                                    <td width="" style="text-align: left;padding-right: 30px!important;">
                                                    <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteProduct('{{ $dataListProduct['ProductID'] }}')">
                                                        <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                                    </a>
                                                    <a class="btn btn-lg btn_news_func" href="/admins/product/{{ $dataListProduct['ProductID'] }}/edit" >
                                                        <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                        </div>
                         <!-- Product English-->
                        <div class="col-md-6" >
                                @if(!empty($jsonDecode['dataListProduct']))
                                    <table class="table borderless fixeds" >
                                        <tr id="underline-th">
                                        <td>ID</td>
                                        <td>Product</td>
                                        <td></td>
                                        </tr>
                                        <tr style="background-color: #F0F0F2;margin-left: 20px;">
                                        <td colspan="3"><h3 style="padding: 10px 0;">English</h3></td>
                                        </tr>
                                        <tbody>
                                        <col width="75px" />
                                        <col width="75px" />
                                        <col width="75px" />
                                            @foreach($jsonDecode['dataListProduct'] as $dataListProduct)
                                            @if(substr($dataListProduct['ProductID'], 2, 2) == 'EN')
                                                <tr id="dataNews">
                                                    <td>{{ $dataListProduct['ProductID'] }}</td>
                                                    <td>{{ $dataListProduct['ProductName'] }}</td>
                                                    <td width="" style="text-align: left;padding-right: 30px!important;">
                                                    <a class="btn btn-lg btn_news_func" href="#" onclick="DeleteProduct('{{ $dataListProduct['ProductID'] }}')">
                                                        <span><i aria-hidden="true" class="fa fa-trash" style="color: #6495ed"></i></span>
                                                    </a>
                                                    <a class="btn btn-lg btn_news_func" href="/admins/product/{{ $dataListProduct['ProductID'] }}/edit" >
                                                        <span><i aria-hidden="true" class="fa fa-pencil" style="color: #6495ed"></i></span>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                        </div>
                        @else
                        <div class="col-md-12 text-center" style="height: 100vh">
                            <h3 style="font-size:2.5em;color:rgb(80, 147, 225);margin-top: 80px">ไม่พบ "{{ $search_result }}" ในรายชื่อสินค้า</h3>
                            <div style="margin: 40px;font-size: 18px;color: #9DA5BE">
                                ไม่พบรายชื่อสินค้านี้ในระบบ
                                <br>
                                กรุณาเพิ่มสินค้าดังกล่าวในระบบ
                            </div>
                            <a class="btn btn-lg" href="{{ url('/admins/product/create?search_result=') }}{{ $search_result }}" style="border-radius: 0px;background-color: #6495ed;color:#fff">
                                <span>
                                    <h3 style="font-size:1.5em;padding: 4px 50px;color:#fff;margin: 10px 0;">  เพิ่มชื่อสินค้า
                                        <i aria-hidden="true" class="fa fa-plus-circle" style="margin-bottom: 0px;padding-left:10px">
                                        </i>
                                    </h3>
                                </span>
                            </a>
                        </div>
                        @endif

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--main page chit chating end here-->
        <!--market updates updates-->
        <div class="market-updates">

        </div>
        <!--market updates end here-->
    </div>
    <!--inner block end here-->
<script type="text/javascript">
    function DeleteProduct(id) {
        if (confirm('Do you want to delete ' + id)) {
            if (id.substring(2,4) == "TH") {
                var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteProduct_THA", "ProductID": id});
                fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
            }
            else{
                var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteProduct_ENG", "ProductID": id});
                fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
            }
            $('#table').load(document.URL +  ' #table');
        } else {
            // Do nothing!
        }
    }
</script>
 <script>
    $( document ).ready(function() {
        $('#product-text a').css('color', '#5093E1');
        $('#product-text').css('border-left', '4px solid #5093E1');
    });
    </script>
@endsection

