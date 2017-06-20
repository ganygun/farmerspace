@extends('admins.layouts.master') @section('content')
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

<script src="{{ URL::asset('/admin/js/pekeUpload.js') }}"></script>
<!-- /script-for sticky-nav -->
<style type="text/css">
    .thumb-image {
        position: relative;
        padding: 0px;
        width: 250px;
    }
</style>

<!--inner block start here-->
<div class="inner-block">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <!-- FORM ADD PRODUCT-->
        @if(empty($jsonDecode_bodyProduct['dataListProduct']))
            <form action=" {{ url('admins/product') }} " method="POST" onsubmit="return confirm('Do you really want to submit the form ?');">
                {{ csrf_field() }}
                <!-- Panel 1 -->
                <div class="panel" id="panel1">
                    <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center">
                        <div class="panel panel-default">
                            <p class=" text-center">@include('flash::message')</p>
                            <div style="margin-top: 30px;"></div>
                            <img id="blah" src="{{ URL::asset('/admin/images/icon_picture.png') }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px" />
                            <br>
                            <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" style="display: none" >
                             <script type="text/javascript">
                                            document.getElementById('fileDelete').addEventListener("click", function(event) {
                                                (function(event) {
                                                    document.getElementById("blah").src = "{{ URL::asset('/admin/images/icon_picture.png') }}";
                                                    document.getElementById("PathFile").value = '';
                                                    document.getElementById("fileDelete").style.display = 'none';
                                                    document.getElementById("fileUpload").value = '';
                                                }).call(document.getElementById('fileDelete'), event);
                                            });
                                        </script>
                            <hr>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="progress" style="height: 20px;display: none;">
                                    <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;margin:auto;padding: auto;">
                                    </div>
                                </div>
                            </div>
                            <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;" class="btn btn-default" />
                            <input type="hidden" id="PathFile" name="PathFile" />
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-2 ">
                        <br>
                        <label for="productName">Product Name</label>
                        <div class="form-group">
                            <input type="text" name="productName" class="form-control" value="{{ \Request::get('search_result') }}{{ old('productName') }}" required="" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="Language">Language</label>
                            <div class="panel panel-default">
                                <input type="radio" name="language" id="tha" value="tha" onclick="javascript:langugeCheck();" required> ภาษาไทย
                                <br>
                                <input type="radio" name="language" id="eng" value="eng" onclick="javascript:langugeCheck();"> English
                                <div id="referenceLanguage" style="display: none">
                                    <p>* Please reference Thai language</p>
                                    <input type="text" id="referenceText" name="referenceText" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label for="productSpecies">Species</label>
                        <div class="panel panel-default">
                            <div class="form-group">
                                <input type="text" id="speciesAddName" placeholder="Species Name" class="form-control">
                            </div>
                            <!-- Add New if Search is not found -->
                            <button type="button" class="btn btn-primary btn-block" id="speciesAdd">Add Species</button>
                            <br>
                            <div style="height:200px;overflow:auto;">
                                <table class="table table-responsive table-hover" id="speciesTable">
                                    <thead>
                                        <tr>
                                            <th colspan="3">All Species</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2 ">
                        <input type="submit" id="submit" class="btn btn-primary pull-right" style="margin: 10px;" value="Save">
                        <a href="{{ url('/admins/product') }}" class="btn btn-danger pull-right" style="margin: 10px;">Back</a>
                    </div>
                </div>
                <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
                <script>
                // Initialize Firebase
                var config = {
                    apiKey: "AIzaSyAoq09FApuwQfdw6VnFIuVKO1UoaAvL6SA",
                    authDomain: "farmerspace-31fea.firebaseapp.com",
                    databaseURL: "https://farmerspace-31fea.firebaseio.com",
                    storageBucket: "farmerspace-31fea.appspot.com",
                    messagingSenderId: "104709186666"
                };
                firebase.initializeApp(config);
                </script>
                <script src="{{ URL::asset('/admin/js/uploadImages.js') }}"></script>
                <div class="clearfix"> </div>
                <!-- End Panel 1 -->
            </form>
        <!-- END FORM ADD PRODUCT-->

        <!-- FORM EDIT PRODUCT-->
        @else
            @foreach($jsonDecode_bodyProduct['dataListProduct'] as $dataListProduct)
                <form action="/admins/product/{{ session('productKey') }}" method="POST">
                    <input name="_method" type="hidden" value="PUT"> {{ csrf_field() }}
                    <!-- Panel 1 -->
                    <div class="panel" id="panel1">
                        <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left text-center">
                            <div class="panel panel-default">
                                <p class=" text-center">@include('flash::message')</p>
                                    @if(!empty($jsonDecode_bodyImage['dataListProductPicture']))
                                        @foreach($jsonDecode_bodyImage['dataListProductPicture'] as $dataListProductPicture)
                                        <img id="blah" src="{{ $dataListProductPicture['Image'] }}" class="thumb-image img img-responsive center-block" style="width: 200px" />
                                        <br>
                                        <input name="imageID" type="hidden" value="{{ $dataListProductPicture['ID'] }}">
                                        <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" onclick="DeleteProductPic('{{ $dataListProductPicture['ID'] }}')">
                                        <script type="text/javascript">
                                            document.getElementById('fileDelete').addEventListener("click", function(event) {
                                                (function(event) {
                                                    document.getElementById("blah").src = "{{ URL::asset('/admin/images/icon_picture.png') }}";
                                                    document.getElementById("PathFile").value = '';
                                                    document.getElementById("fileDelete").style.display = 'none';
                                                    document.getElementById("fileUpload").value = '';
                                                }).call(document.getElementById('fileDelete'), event);
                                            });
                                        </script>
                                        <hr>
                                        <div class="progress" style="height: 20px;display: none">
                                            <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                            </div>
                                        </div>
                                        <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;" class="btn btn-default" />
                                        <input type="hidden" id="PathFile" name="PathFile" value="{{ $dataListProductPicture['Image'] }}" />
                                        @endforeach
                                    @else
                                        <img id="blah" src="{{ URL::asset('/admin/images/icon_picture.png') }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px" />
                                        <br>
                                        <input name="imageID" type="hidden" value="">
                                        <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" style="display: none" onclick="deleteProductPic()">
                                        <hr>
                                        <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;" class="btn btn-default" />
                                        <input type="hidden" id="PathFile" name="PathFile" />
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2 ">
                            <br>
                            <label for="productName">Product Name</label>
                            <div class="form-group">
                                <input type="text" name="productName" class="form-control" value="{{ $dataListProduct['ProductName'] }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="Language">Language</label>
                                <div class="panel panel-default">
                                    @if(!empty($dataListProduct['ReferenceThai']))
                                    <input type="radio" name="language" id="tha" value="tha" onclick="javascript:langugeCheck();" required> ภาษาไทย
                                    <br>
                                    <input type="radio" name="language" id="eng" value="eng" onclick="javascript:langugeCheck();" checked> English
                                    <div id="referenceLanguage" style="display: none">
                                        <p>* Please reference Thai language</p>
                                        <input type="text" id="referenceText" name="referenceText" class="form-control" value="{{ $dataListProduct['ReferenceThai'] }}">
                                    </div>
                                    @else
                                    <input type="radio" name="language" id="tha" value="tha" onclick="javascript:langugeCheck();" required checked>ภาษาไทย
                                    <br>
                                    <input type="radio" name="language" id="eng" value="eng" onclick="javascript:langugeCheck();">English
                                    <div id="referenceLanguage" style="display: none">
                                        <p>* Please reference Thai language</p>
                                        <input type="text" id="referenceText" name="referenceText" class="form-control">
                                    </div>
                                    @endif
                                    <script>
                                    window.onload = function() {
                                        langugeCheck();
                                    };
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <label for="productSpecies">Species</label>
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <input type="text" id="speciesAddName" placeholder="Species Name" class="form-control">
                                </div>
                                <!-- Add New if Search is not found -->
                                <button type="button" class="btn btn-success btn-block" id="speciesAdd">Add Species</button>
                                <br>
                                <div style="height:200px;overflow:auto;">
                                    <table class="table table-responsive table-hover" id="speciesTable">
                                        <thead>
                                            <tr>
                                                <th colspan="3">All Species</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!--  Get All Species form this product   -->
                                        @if(!empty($jsonDecode_bodySpecies['dataListSpecies']))
                                            @foreach($jsonDecode_bodySpecies['dataListSpecies'] as $dataListSpecies)
                                                @if($dataListSpecies['Specy'] != "Overview" && $dataListSpecies['Specy'] != "overview")
                                                    <tr style="border-bottom:2px solid #5cb85c">
                                                            <td>
                                                                <input type="text" readOnly="true"  value="{{ $dataListSpecies['Specy'] }}" style="background-color: transparent;border: none;border-color: transparent;">
                                                                <!-- onBlur="spiciesUpdate(this)" onClick="this.readOnly=false" -->

                                                            </td>
                                                            <td></td>
                                                            <td> <a href="javascript:void(0);" class="DeleteSpecie pull-right btn btn-danger" style="display: inline;margin-left: 5px;"><span class="fa fa-trash" aria-hidden="true"></span></a>
                                                            </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2 ">
                            <input type="submit" id="submit" class="btn btn-success pull-right" style="margin: 10px;" value="Update">
                            <a href="{{ url('/admins/product') }}" class="btn btn-danger pull-right" style="margin: 10px;">Back</a>
                        </div>
                    </div>
                    <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
                    <script>
                    // Initialize Firebase
                    var config = {
                        apiKey: "AIzaSyAoq09FApuwQfdw6VnFIuVKO1UoaAvL6SA",
                        authDomain: "farmerspace-31fea.firebaseapp.com",
                        databaseURL: "https://farmerspace-31fea.firebaseio.com",
                        storageBucket: "farmerspace-31fea.appspot.com",
                        messagingSenderId: "104709186666"
                    };
                    firebase.initializeApp(config);
                    </script>
                    <script src="{{ URL::asset('/admin/js/uploadImages.js') }}"></script>
                    <div class="clearfix"> </div>
                    <!-- End Panel 1 -->
                </form>
            @endforeach
        @endif
        <!-- END FORM EDIT PRODUCT-->
    </div>
    <!--main page chit chating end here-->
    <!--market updates updates-->
    <div class="market-updates">
    </div>
    <!--market updates end here-->
</div>
<!--inner block end here-->


<!-- script Add species -->
<script>
                            $(document).ready(function() {
                                $("#speciesAdd").click(function() {
                                     if ($('#speciesAddName').val() == '') { alert('Please enter species name'); $('#speciesAddName').focus();return }
                                     else {
                                        var speciesAddName = $('#speciesAddName').val();
                                        //var intId = $("#speciesTable tr").length;
                                        var tr = $("<tr></tr>");
                                        var name = $("<td><input type=\"text\" name=\"spiciesName[]\" readOnly=\"true\" value=\"" + speciesAddName + "\" style=\"background-color: transparent;border: none;border-color: transparent;\"></td>");
                                        var blank = $("<td></td>");
                                        var btnTD = $("<td></td>");
                                        var deleteBtn = $("<a href=\"javascript:void(0);\" class=\"remCF pull-right btn btn-danger\" style=\"display: inline;margin-left: 5px;\"><span class=\"fa fa-trash\" aria-hidden=\"true\"></span></a>");
                                        tr.append(name);
                                        tr.append(blank);
                                        tr.append(btnTD);
                                        btnTD.append(deleteBtn);
                                        $("#speciesTable").append(tr);
                                        //clear textbox
                                        $('#speciesAddName').val('');
                                     }
                                });
                            });
</script>

<!-- script Edit/Update species -->
<script>
                            function spiciesUpdate(sender) {
                                sender.defaultValue = sender.value;

                            }
</script>

<!-- script Delete species form List -->
<script>
                            $(document).ready(function() {
                                $("#speciesTable").on('click', '.remCF', function() {
                                    var r = confirm("Do you want to Delete this Record ?");
                                    if (r == true) {
                                        $(this).parent().parent().remove();
                                    }
                                });
                            });
</script>

<!-- script Delete species form DB -->
<script>
                            $("#speciesTable").on('click', '.DeleteSpecie', function() {
                                 var r = confirm("Do you want to Delete this Record ?");
                                if (r == true) {
                                    //get Species Name
                                    var speciename = $(this).parent().prev().prev().children().val();
                                    // --------------
                                    
                                      //  alert(speciename);
                                        var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteSpeciesItem", "ProductID": '{{ session('productKey') }}', "Species": speciename});
                                        fetch(url,{
                                            mode: 'no-cors',
                                            method: 'get',
                                        });
        
                                        $(this).parent().parent().remove();
                                }
                            });
</script>

<script>
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
<script>
    function DeleteProductPic(id) {
        if (id != '') {
            var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteProduct_Pic", "ID": id});
                fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
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
