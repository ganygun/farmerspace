@extends('admins.layouts.master') @section('content')
    <!--header start here-->
    <div class="header-main">
                    <div class="header-left">
                        <h2 style="margin-top: 0.3em;">
                            Product Form
                        </h2>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="header-right">
                 <form  role="search" method="GET" action="{{ url('/admins/form/search') }}">
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
    <!-- script-for sticky-nav -->
    <script>
                    $(document).ready(function() {
                        var navoffeset = $(".header-main").offset().top;
                        $(window).scroll(function() {
                            var scrollpos = $(window).scrollTop();
                            if (scrollpos >= navoffeset) {
                                $(".header-main").addClass("fixed");
                            } else {
                                $(".header-main").removeClass("fixed");
                            }
                        });

                    });
    </script>
    <!-- /script-for sticky-nav -->
<!--inner block start here-->
<style type="text/css">
    .jumbotron > #rcorners4 {
        border-radius: 0px 300px 0px 0px;
        color:#fff;
        background-color: #000;
        opacity: 0.7;
        margin-left: -15px;
        margin-bottom: -30px;
        width:600px;
    }
    .jumbotron > #rcorners4 >  {
        border-radius: 0px 300px 0px 0px;
        color:#fff;
        background-color: #000;
        opacity: 0.7;
        margin-left: -15px;
        margin-bottom: -30px;
        width:600px;
    }
    .jumbotron > #rcorners4 > .ItemDescription {
        width:80%;
        word-break:break-word;
    }
    .jumbotron > #rcorners4 > h1 {
        width:70%;
        word-break:break-word;
    }
</style>
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-12 chit-chat-layer1-left ">
            <div class="work-progres">
                @include('flash::message')
                @if($result =='done')
                    <div class="jumbotron table-responsive" style="background-image: url('{{ $jsonDecode_bodySearch['dataListProduct'][0]['Image'] }}');background-repeat: no-repeat;background-size: cover;padding-top: 100px;">
                        <div id="rcorners4" class="container">
                             <h1 style="margin-top: 1em;">{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}</h1>
                            <p class="lead">{{ $jsonDecode_bodyProduct['dataListProduct'][0]['ReferenceThai'] }}</p>
                            <p class="ItemDescription">
                                {{ $jsonDecode_bodyOverview['dataListSpecies'][0]['ItemDescription'] }}
                            </p>
                        </div>
                    </div>
                    @if(empty($jsonDecode_bodyLink['dataListLink']))
                        <div class="form-group">
                            <label for="SaleThLink">Link For Sale (ภาษาไทย)</label><br>
                            <a  href="{{ url('admins/form/create?formtype=Sale Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                        </div>
                        <div class="form-group">
                            <label for="SaleENLink">Link For Sale (English)</label><br>
                            <a  href="{{ url('admins/form/create?formtype=Sale Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                        </div>
                        <div class="form-group">
                            <label for="PurchaseThLink">Link For Purchase (ภาษาไทย)</label><br>
                            <a href="{{ url('admins/form/create?formtype=Purchase Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                        </div>
                        <div class="form-group">
                            <label for="PurchaseENLink">Link For Purchase (English)</label><br>
                            <a href="{{ url('admins/form/create?formtype=Purchase Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                        </div>

                    @else
                        <?php $len = count($jsonDecode_bodyLink['dataListLink']);?>
                        <?php $sTha = 0;?>
                        <?php $sEng = 0;?>
                        <?php $pTha = 0;?>
                        <?php $pEng = 0;?>

                        @foreach($jsonDecode_bodyLink['dataListLink'] as $key => $dataListLink)
                            @if($dataListLink['Type'] == 'Sale')
                                @if($dataListLink['Language'] == 'THA')
                                    <div class="form-group">
                                        <label for="SaleThLink">Link For Sale (ภาษาไทย)</label><br>
                                        <input id="SaleThLink" type="text" readonly="true" size="35" class="form-control" value="{{ $dataListLink['Link'] }}"><br>
                                        <a href="{{ url('admins/form/'.session('productKey').'/edit?idform=') }}{{ $dataListLink['ID'] }}" class="btn btn-danger">Edit Form</a>
                                        <button class="btn btn-success" onclick="copyToClipboard('SaleThLink')">Copy Link</button>
                                    </div>
                                    <?php $sTha = 1;?>
                                @endif
                                @if($dataListLink['Language'] == 'ENG')
                                    <div class="form-group">
                                        <label for="SaleENLink">Link For Sale (English)</label><br>
                                        <input id="SaleENLink" type="text" readonly="true" size="35" class="form-control" value="{{ $dataListLink['Link'] }}"><br>
                                        <a  href="{{ url('admins/form/'.session('productKey').'/edit?idform=') }}{{ $dataListLink['ID'] }}" class="btn btn-danger">Edit Form</a>
                                        <button class="btn btn-success" onclick="copyToClipboard('SaleENLink')">Copy Link</button>
                                    </div>
                                    <?php $sEng = 1;?>
                                @endif
                            @endif
                        @endforeach

                        <!-- Sale Form -->
                        <!-- THA no ENG -->
                        @if($sTha == 1 && $sEng == 0)
                            <div class="form-group">
                                <label for="SaleENLink">Link For Sale (English)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Sale Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        <!-- ENG no THA -->
                        @elseif($sTha == 0 && $sEng == 1)
                            <div class="form-group">
                                <label for="SaleENLink">Link For Sale (ภาษาไทย)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Sale Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        <!-- no THA no ENG -->
                        @elseif($sTha == 0 && $sEng == 0)
                            <div class="form-group">
                                <label for="SaleThLink">Link For Sale (ภาษาไทย)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Sale Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                            <div class="form-group">
                                <label for="SaleENLink">Link For Sale (English)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Sale Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        @endif

                        @foreach($jsonDecode_bodyLink['dataListLink'] as $key => $dataListLink)
                            @if($dataListLink['Type'] == 'Purchase')
                                @if($dataListLink['Language'] == 'THA')
                                    <div class="form-group">
                                        <label for="PurchaseThLink">Link For Purchase (ภาษาไทย)</label><br>
                                        <input id="PurchaseThLink" type="text" readonly="true" size="35" class="form-control" value="{{ $dataListLink['Link'] }}"><br>
                                        <a href="{{ url('admins/form/'.session('productKey').'/edit?idform=') }}{{ $dataListLink['ID'] }}" class="btn btn-danger">Edit Form</a>
                                        <button class="btn btn-success" onclick="copyToClipboard('PurchaseThLink')">Copy Link</button>
                                    </div>
                                    <?php $pTha = 1;?>
                                @endif
                                @if($dataListLink['Language'] == 'ENG')
                                    <div class="form-group">
                                        <label for="PurchaseENLink">Link For Purchase (English)</label><br>
                                        <input id="PurchaseENLink" type="text" readonly="true" size="35" class="form-control" value="{{ $dataListLink['Link'] }}"><br>
                                        <a href="{{ url('admins/form/'.session('productKey').'/edit?idform=') }}{{ $dataListLink['ID'] }}" class="btn btn-danger">Edit Form</a>
                                        <button class="btn btn-success" onclick="copyToClipboard('PurchaseENLink')">Copy Link</button>
                                    </div>
                                    <?php $pEng = 1;?>
                                @endif
                            @endif
                        @endforeach

                        <!-- Purchase Form -->
                        <!-- THA no ENG -->
                        @if($pTha == 1 && $pEng == 0)
                            <div class="form-group">
                                <label for="PurchaseENLink">Link For Purchase (English)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Purchase Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        <!-- ENG no THA -->
                        @elseif($pTha == 0 && $pEng == 1)
                            <div class="form-group">
                                <label for="PurchaseTHLink">Link For Purchase (ภาษาไทย)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Purchase Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        <!-- no THA no ENG -->
                        @elseif($pTha == 0 && $pEng == 0)
                            <div class="form-group">
                                <label for="SaleThLink">Link For Purchase (ภาษาไทย)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Purchase Form | Thai&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                            <div class="form-group">
                                <label for="SaleENLink">Link For Purchase (English)</label><br>
                                <a  href="{{ url('admins/form/create?formtype=Purchase Form | English&pname=') }}{{ $jsonDecode_bodySearch['dataListProduct'][0]['ProductName'] }}" class="btn btn-primary">Create Form</a>
                            </div>
                        @endif

                    @endif
                @elseif($result == '')
                        <p class="text-center" style="margin-top: 50px;">Please Search Your Product Do You Want</p><br>
                        <p class="text-center" style="margin-bottom: 20px;"">OR</p>
                         <a  href="{{ url('/admins/product/create') }}" class="btn btn-info btn-sm center-block"><i class="fa fa-plus-square-o fa-5x" style="margin: 30px 0px 0px;"></i><p style="margin-bottom: 30px;">New Product</p></a>
                @else
                        <p class="text-center" style="margin-top: 50px;">No Product Match Your Search</p><br>
                         <a  href="{{ url('/admins/product/create') }}" class="btn btn-primary btn-sm center-block"><i class="fa fa-plus-square-o fa-5x" style="margin: 30px 0px 0px;"></i><p style="margin-bottom: 30px;">New Product</p></a>
                @endif
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
</div>
<!--inner block end here-->

    <script>
        function copyToClipboard(text) {

              var copyTextarea = document.querySelector('#'+text);
              copyTextarea.select();

              try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                alert('Copying was ' + msg);
              } catch (err) {
                alert('Oops, unable to copy');
              }
        }
    </script>
     <script>
    $( document ).ready(function() {
        $('#form-text a').css('color', '#5093E1');
        $('#form-text').css('border-left', '4px solid #5093E1');
    });
    </script>
@endsection
