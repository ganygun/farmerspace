@extends('admins.layouts.master') @section('content')
<!--header start here-->
<div class="header-main">
    <div class="header-left">
        <h4 style="margin-top: 0.5em;">
                            Add Product / Overview
                        </h4>
        <div class="clearfix"> </div>
    </div>
    <div class="header-right">
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

<style type="text/css">
.thumb-image {
    position: relative;
    padding: 0px;
    width: 250px;
}
</style>
<style>
    .hovereffect {
        width:100%;
        height:100%;
        float:left;
        overflow:hidden;
        position:relative;
        text-align:center;
        cursor:default;
    }

    .hovereffect .overlay {
        width:100%;
        height:100%;
        position:absolute;
        overflow:hidden;
        top:0;
        left:0;
        opacity:0;
        background-color:rgba(0,0,0,0.5);
        -webkit-transition:all .4s ease-in-out;
        transition:all .4s ease-in-out
    }

    .hovereffect img {
        display:block;
        position:relative;
        -webkit-transition:all .4s linear;
        transition:all .4s linear;
    }

    .hovereffect h2 {
        text-transform:uppercase;
        color:#fff;
        text-align:center;
        position:relative;
        font-size:17px;
        background:rgba(0,0,0,0.6);
        -webkit-transform:translatey(-100px);
        -ms-transform:translatey(-100px);
        transform:translatey(-100px);
        -webkit-transition:all .2s ease-in-out;
        transition:all .2s ease-in-out;
        padding:10px;
    }

    .hovereffect a.info {
        text-decoration:none;
        display:inline-block;
        text-transform:uppercase;
        color:#fff;
        border:0px;
        background-color:transparent;
        opacity:0;
        filter:alpha(opacity=0);
        -webkit-transition:all .2s ease-in-out;
        transition:all .2s ease-in-out;
        margin:80px 0 0;
        padding:7px 14px;
    }

    .hovereffect a.info:hover {
        box-shadow:0 0 3px #000;
    }

    .hovereffect:hover img {
        -ms-transform:scale(1.2);
        -webkit-transform:scale(1.2);
        transform:scale(1.2);
    }

    .hovereffect:hover .overlay {
        opacity:1;
        filter:alpha(opacity=100);
    }

    .hovereffect:hover h2,.hovereffect:hover a.info {
        opacity:1;
        filter:alpha(opacity=100);
        -ms-transform:translatey(0);
        -webkit-transform:translatey(0);
        transform:translatey(0);
    }

    .hovereffect:hover a.info {
        -webkit-transition-delay:.2s;
        transition-delay:.2s;
    }
</style>
<!--inner block start here-->
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <form  role="search" method="GET" action="{{ url('/admins/product/overview/search') }}">
            <!--search-box-->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>           
            <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center" style="margin-bottom: 20px;">
                <p class=" text-center">@include('flash::message')</p>
                <!-- {{ session('productKey') }} -->
                <div class="col-md-6 col-md-offset-2">
                    <div class="form-group">
                        <select class="selectpicker form-control" data-live-search="true" name="search" id="search" required>
                         <option data-tokens="null" value="null" disabled selected>ระบุ Species Name</option>
                          @if(!empty($jsonDecodeGetProduct['dataListProduct']))
                                @foreach($jsonDecodeGetProduct['dataListProduct'] as $dataListProduct)
                                  <option data-tokens="{{ $dataListProduct['ProductName'] }}" value="{{ $dataListProduct['ProductID'] }}">{{ $dataListProduct['ProductName'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="submit" id="btn_search" class="btn btn-block btn-primary" value="Search Species">
                    </div>
                </div>
                <script>
                    $('#search').on("change", function () {
                        if( $('#search').val().length > 0 ) {
                            $('#btn_search').prop("disabled", false);
                        } else {
                            $('#btn_search').prop("disabled", true);
                        }
                    });
                </script>

            </div>
        </form>
        <form action="/admins/product/overview/{{ session('productKey') }}" method="POST">
            {{ csrf_field() }}
            <!-- <input name="_token" type="hidden" value="{{ csrf_token() }}"/> -->
            <input type="hidden" id="productKey" value="{{ session('productKey') }}">
            <input name="_method" type="hidden" value="PUT">
            <br>
            <!-- Panel 2 -->
            <div class="panel" id="panel2">
                @if(!empty($jsonDecode_bodySearch['dataListSpecies']))
                    @foreach($jsonDecode_bodySearch['dataListSpecies'] as $dataListSpecies)
                        <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center">
                            <h1>{{ $dataListSpecies['Specy'] }}</h1>
                         <input name="seacrh" type="hidden" value="{{$dataListSpecies['Specy']}}">
                        <input type="hidden" id="speciesName" value="{{$dataListSpecies['Specy']}}">
                            <hr>
                        </div>
                        <div class="col-md-4 col-md-offset-2 ">
                        @if(!empty($jsonDecode_bodyImage['dataListSpeciesPicture']))
                            @foreach($jsonDecode_bodyImage['dataListSpeciesPicture'] as $key=>$dataListSpeciesPicture)
                                @if($key==0)
                                    <div class="hovereffect" style="margin-bottom: 20px;">
                                        <img id="imagePreview" src="{{ $dataListSpeciesPicture['Image'] }}" alt="" width="350px" height="200px" class="img center-block" style="margin-bottom: 10px;" name="{{ $dataListSpeciesPicture['ID'] }}">
                                    </div>
                                @endif
                            @endforeach

                            @foreach($jsonDecode_bodyImage['dataListSpeciesPicture'] as $key=>$dataListSpeciesPicture)
                                <img id="imageid" onmouseover="preview(this)" src="{{ $dataListSpeciesPicture['Image'] }}" alt="" width="80px" name="{{ $dataListSpeciesPicture['ID'] }}">
                            @endforeach
                            <br>
                        @endif
                        <script type="text/javascript">
                        function preview(p) {
                            $('#imagePreview').attr('src', $(p).attr('src'));
                            $('#imagePreview').attr('name', $(p).attr('name'));
                            //$('#deleteImage').attr('name', $(p).attr('name'));
                        }
                        </script>
                            <br>
                            <label for="productFile">Upload Images</label>
                            <input id="fileUpload" type="file" name="file"/>
                            <output id="result" />
                            <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
                            <script src="{{ URL::asset('/admin/js/uploadImages_multiple.js') }}"></script>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <label for="productaItem">Item Description</label>
                            <div class="form-group">
                                <textarea maxlength="4000" name="productItem" rows="5" class="form-control">{{ $dataListSpecies['ItemDescription'] }}</textarea>
                            </div>
                            <label for="productGrowing">Growing Guides</label>
                            <div class="form-group">
                                <textarea maxlength="4000" name="productGrowing" rows="5" class="form-control">{{ $dataListSpecies['GrowingGuide'] }}</textarea>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center">
                        <h1>Overview</h1>
                         <input name="seacrh" type="hidden" value="Overview">
                        <hr>
                    </div>
                    <div class="col-md-4 col-md-offset-2 ">
                        <br>
                        <label for="productFile">Upload Images</label>
                        
                        <input id="fileUpload" type="file" name="file"/>
                        <div class="progress" style="height: 20px;display: none;">
                            <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;margin:auto;padding: auto;">
                            </div>
                        </div>
                        <output id="result" />
                        <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
                        <script src="{{ URL::asset('/admin/js/uploadImages_multiple.js') }}"></script>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label for="productaItem">Item Description</label>
                        <div class="form-group">
                            <textarea name="productItem" rows="5" class="form-control"></textarea>
                        </div>
                        <label for="productGrowing">Growing Guides</label>
                        <div class="form-group">
                            <textarea name="productGrowing" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                @endif

                <div class="col-md-8 col-md-offset-2 ">
                    <input type="submit" class="btn btn-success pull-right" style="margin: 10px;" value="Update">
                    <a href="{{ url('admins/product') }}" class="btn btn-warning pull-right" style="margin: 10px;">Back</a>
                </div>
            </div>
            <div class="clearfix"> </div>
            <!-- End Panel 2 -->
        </form>
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
</div>
<!--inner block end here-->
<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fileUpload").change(function() {
    readURL(this);
});
</script>
<script>
function langugeCheck() {
    if (document.getElementById('eng').checked) {
        document.getElementById('referenceLanguage').style.display = 'block';
        document.getElementById('referenceText').required = true;
    } else {
        document.getElementById('referenceLanguage').style.display = 'none';
        document.getElementById('referenceText').required = false;
    }
}
</script>
@endsection
