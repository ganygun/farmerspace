@extends('admins.layouts.master') @section('content')
<!--header start here-->
<script src='http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=877fxu9e6vue5pwbhaieq2m3xs8hweh31ypcybirbnc8clw6'></script>
<script type="text/javascript">
   tinymce.init({
   selector: '#myTextarea',
      theme: 'modern',
      menubar: false,
      height: 400,
      plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
          'save table contextmenu directionality emoticons template paste textcolor imagetools '
      ],
      toolbar1: 'undo redo | image media link | bold italic underline strikethrough superscript subscript | aligncenter bullist numlist | preview fullscreen |',
      imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
      content_css: [
        '//www.tinymce.com/css/codepen.min.css'
      ],
      image_title: true,
      // enable automatic uploads of images represented by blob or data URIs
      automatic_uploads: true,
      // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
      // here we add custom filepicker only to Image dialog
      file_picker_types: 'image',
      // and here's our custom image picker
      file_picker_callback: function(cb, value, meta) {
          var input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');


          // Note: In modern browsers input[type="file"] is functional without
          // even adding it to the DOM, but that might not be the case in some older
          // or quirky browsers like IE, so you might want to add it to the DOM
          // just in case, and visually hide it. And do not forget do remove it
          // once you do not need it anymore.

          input.onchange = function() {
              var file = this.files[0];

              var reader = new FileReader();
              reader.readAsDataURL(file);
              reader.onload = function () {
                  // Note: Now we need to register the blob in TinyMCEs image blob
                  // registry. In the next release this part hopefully won't be
                  // necessary, as we are looking to handle it internally.

                     // Create a root reference
                  var storageRef = firebase.storage().ref();
                  // Create the file metadata
                  var metadata = {
                      contentType: 'image/jpeg'
                  };
                  // Upload file and metadata to the object 'images/mountains.jpg'
                  @if($EditType == 'a')
                  var uploadTask = storageRef.child('/FarmerspacePicture/imgNews/content/article-type/' + file.name).put(file, metadata);
                  @elseif($EditType == 'v')
                  var uploadTask = storageRef.child('/FarmerspacePicture/imgNews/content/video-type/' + file.name).put(file, metadata);
                  @elseif($EditType == 'e')
                  var uploadTask = storageRef.child('/FarmerspacePicture/imgNews/content/event-type/' + file.name).put(file, metadata);
                  @endif
                  //var uploadTask = storageRef.put(selectedFile);
                  // Listen for state changes, errors, and completion of the upload.
                  uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
                      function(snapshot) {
                          // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                          var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                          console.log('Upload is ' + progress + '% done');
                          switch (snapshot.state) {
                              case firebase.storage.TaskState.PAUSED: // or 'paused'
                                  console.log('Upload is paused');
                                  break;
                              case firebase.storage.TaskState.RUNNING: // or 'running'
                                  console.log('Upload is running');
                                  break;
                          }
                      },
                      function(error) {
                          switch (error.code) {
                              case 'storage/unauthorized':
                                  // User doesn't have permission to access the object
                                  break;
                              case 'storage/canceled':
                                  // User canceled the upload
                                  break;
                              case 'storage/unknown':
                                  // Unknown error occurred, inspect error.serverResponse
                                  break;
                          }
                      },
                      function() {
                          // Upload completed successfully, now we can get the download URL
                          var downloadURL = uploadTask.snapshot.downloadURL;
                          console.log("Url to download", downloadURL);
                          // Note: Now we need to register the blob in TinyMCEs image blob
                          // registry. In the next release this part hopefully won't be
                          // necessary, as we are looking to handle it internally.

                          var id = 'blobid' + (new Date()).getTime();
                          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                          var blobInfo = blobCache.create(id, file, reader.result);
                          blobCache.add(blobInfo);

                          // call the callback and populate the Title field with the file name
                          cb(downloadURL, {
                              title: file.name
                          });

                      });


               
              };
          };
           

          input.click();
      }
  });
</script>
<div class="header-main" style="padding: 1.8em 2em;">
    <div class="header-center">
          <h2 style="margin-top: 0.3em;color: #6495ed">
                           2 / 3 <small style="font-size: 24px;font-weight: 300;">Choose article's detail</small>
                        </h2>
        <div class="clearfix"> </div>
    </div>

    <div class="clearfix"> </div>
</div>
<!--heder end here-->

<style>
  div.mce-fullscreen {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
  }
  #myTextarea {
      margin: 10px 0;
      height: 400px;
  }
  h3{
    font-weight: 300;
    margin-bottom: 10px;
  }
  h3 small{
    font-size: 50%;
  }
  .panel-default{
    background-color: #fff;
  }
  .tag{
    color:#fff;
    padding: 5px;
    background-color: #66CC00;
    font-size: 16px;
    font-weight: 300;
  }
  .newtag{
    color:#fff;
    padding: 5px;
    background-color: #F5A623;
    font-size: 16px;
    font-weight: 300;
  }
  #tagsNameTable>div{
    padding: 8px 2px!important;

  }
</style>
<!--inner block start here-->
<div class="inner-block" style="padding-left: 8em;padding-right: 8em;"">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="col-md-12 chit-chat-layer1-left text-center">
        <!-- Edit Video Type -->
          @if($EditType == 'v')
          <div class="row">
            <p class="text-center">@include('flash::message')</p>
            <form action="{{ url('admins/writing/') }}/{{ $ID }}" method="POST">
              @if($page == 'Review')
                <input name="page" type="hidden" value="Review">
              @endif
              <input name="_method" type="hidden" value="PUT">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Headline <br><small>** less than 100 Words</small></h3>
                    <textarea id="labelTopic" name="labelTopic" class="form-control" required="" maxlength="100" rows="6">{{ $Title }}{{ old('labelTopic') }}</textarea>
                  </div>
                  <div class="col-md-12" style="margin:0 20px;">
                    <h3 class="text-left">Upload Video</h3>               
                          <div class="panel panel-default" style="margin-top: 10px;">
                            <div class="row">
                              <div class="col-md-12">
                                  @if (strpos($Picture, 'youtube') !== false) 
                                  <iframe id="blah" width="560" height="315" src="{{ $Picture }}" frameborder="0" allowfullscreen style="border-radius: 4px;"></iframe>
                                  @else
                                    <iframe id="blah" width="560" height="315" src="" frameborder="0" allowfullscreen style="border-radius: 4px;"></iframe>
                                    <script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
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
                                    <script>
                                       var storage = firebase.storage();
                                        // Create a reference from an HTTPS URL
                                        // Note that in the URL, characters are URL escaped!
                                        var httpsReference = storage.refFromURL('{{ $Picture }}');
                                       httpsReference.getDownloadURL().then(function(url) {
                                        // `url` is the download URL for 'images/stars.jpg'

                                        // This can be downloaded directly:
                                        var xhr = new XMLHttpRequest();
                                        xhr.responseType = 'blob';
                                        xhr.onload = function(event) {
                                          var blob = xhr.response;
                                        };
                                        xhr.open('GET', url);
                                        xhr.send();

                                        // Or inserted into an <img> element:
                                        var img = document.getElementById('blah');
                                        img.src = url;
                                      }).catch(function(error) {
                                        // Handle any errors
                                      });
                                    </script>
                                    <br>
                                    <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" onclick="DeleteVideo('{{ $Picture }}')"/>
                                  @endif
                                  @if($Picture != '')
                                     <script>
                                      $( document ).ready(function() {
                                        $('#fileDelete').show();
                                        $('#blah').show();
                                      });
                                     </script>
                                  @else
                                   <script>
                                      $( document ).ready(function() {
                                          $('#fileDelete').hide();
                                          $('#blah').hide();
                                      });
                                   </script>
                                  @endif
                                  <hr>
                              </div>
                              <div class="col-md-6 text-left">
                                <label class="radio-inline">
                                  <input type="radio" id="typevideo1" name="typevideo" value="link">
                                   <label for="typevideo1"><span></span>Link</label>
                                </label>
                                <!-- Case Link -->
                                  <input type="text" class="form-control" id="PathFile" name="PathFile" disabled="true" />
                                  <script>
                                    $( "#PathFile" ).click(function () {
                                       $(this).val("");
                                       //alert($(this).val());
                                    });
                                    $( "#PathFile" ).change(function () {
                                      if($(this).val().indexOf("https://www.youtube.com/watch?v=") != -1){
                                        $(this).val("https://www.youtube.com/embed/"+$(this).val().split("https://www.youtube.com/watch?v=").pop());
                                        document.getElementById("blah").src = $(this).val();
                                        document.getElementById("blah").style.display = '-webkit-inline-box';

                                      }else{
                                        $(this).val("");
                                        document.getElementById("blah").src = "";
                                        document.getElementById("blah").style.display = 'none';
                                      }
                                        // $(this).val("https://www.youtube.com/embed/"+ $(this).val());
                                         //alert($(this).val());
                                    });
                                  </script>
                                  <h3 class="text-left"><small>** Ex. https://www.youtube.com/watch?v=id_video</small></h3>
                                <!-- End Case -->
                              </div>
                              <div class="col-md-6 text-left">
                                <label class="radio-inline">
                                  <input type="radio"  id="typevideo2" name="typevideo" value="upload" checked>
                                   <label for="typevideo2"><span></span>Upload</label>
                                </label>
                                <!-- Case Upload -->
                                    <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;width: 100%;border:none" accept="video/*" />
                                    <div class="progress" style="height: 20px;display: none">
                                      <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                      </div>
                                    </div>
                                    <input type="hidden" id="PathFile" name="PathFile" value="{{ $Picture }}" />
                                    <script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
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
                                    <script src="{{ URL::asset('/admin/js/uploadImages_news_type_video.js') }}"></script>
                                    <script type="text/javascript">
                                          document.getElementById('fileDelete').addEventListener("click", function(event) {
                                              (function(event) {
                                                  document.getElementById("blah").src = "";
                                                  document.getElementById("PathFile").value = '';
                                                  document.getElementById("fileDelete").style.display = 'none';
                                                  document.getElementById("fileUpload").value = '';
                                              }).call(document.getElementById('fileDelete'), event);
                                          });
                                    </script>
                                <!-- End Case -->
                              </div>
                            </div>
                          </div>
                  </div>
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Hightlight <br><small>** less than 300 Words</small></h3>
                    <textarea id="myTextarea" name="labelAbstract" class="form-control" rows="6">{{ $Abstract }}{{ old('labelAbstract') }}</textarea>
                  </div>
              <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Add Tag</h3>
                     <div class="input-group">
                          <span class="input-group-btn">
                            <button type="button" class="btn" id="tagsBtn">
                              <span><i aria-hidden="true" class="fa fa-plus"></i></span>
                            </button>
                          </span>
                          <input type="text" id="tagsName" placeholder="Tag Name" class="form-control">
                    </div>
                    <div class="input-group" style="margin-top:10px;">
                        <div id="tagsNameTable" style="display: inline-flex;flex-wrap: wrap;">
                                @if(!empty($Tag)) @foreach(explode(',', $Tag) as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                        </span>
                                    </h4>
                                    <input name="tagsName[]" type="hidden" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                                @if(!empty(old('tagsName'))) @foreach(old('tagsName') as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                            <a class="remCF " href="javascript:void(0);">
                                                <span aria-hidden="true" class="fa fa-times" style="color:#fff;">
                                                </span>
                                            </a>
                                        </span>
                                    </h4>
                                    <input type="hidden" name="tagsName[]" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                        </div>
                    </div>
              </div>
              @if(Session('role') == 'Admin' && $page == 'Review')
                    <div class="col-md-12" style="margin:20px;">
                      <div class="form-inline">
                        <!-- Latest compiled and minified CSS -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
                        <!-- Latest compiled and minified JavaScript -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
                         <select class="selectpicker" data-live-search="true" name="productID" id="productID" required>
                         <option data-tokens="null" value="null" disabled selected>ระบุ Product</option>
                          @if(!empty($jsonDecodeGetProduct['dataListProduct']))
                                @foreach($jsonDecodeGetProduct['dataListProduct'] as $dataListProduct)
                                  <option data-tokens="{{ $dataListProduct['ProductName'] }}" value="{{ $dataListProduct['ProductID'] }}">{{ $dataListProduct['ProductName'] }}</option>
                                @endforeach
                            @endif
                        </select>
                       <button id="verify" class="btn btn-success" type="submit" name="submit" value="verify" disabled="true" style="border-radius: 0px;background-color: #66CC00;color:#fff;">
                                Verify
                        </button>
                      </div>
                      <script>
                        $('#productID').on("change", function () {
                            if( $('#productID').val().length > 0 ) {
                                $('#verify').prop("disabled", false);
                            } else {
                                $('#verify').prop("disabled", true);
                            }
                          });
                      </script>
                    </div>
              @endif
              <div class="col-md-12" style="margin-top: 3.5em;">
                    <a type="button" class="btn btn-lg" href="/admins/writing" style="border-radius: 0px;background-color: #6495ed;color:#fff">
                        <span>
                            <i aria-hidden="true" class="fa fa-caret-left" style="margin-bottom: 0px;padding-right:10px">
                            </i>
                            Back
                        </span>
                    </a>
                    <button class="btn btn-lg" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit" name="submit" value="update">
                        <span>
                            Save
                            <i aria-hidden="true" class="fa fa-caret-right" style="margin-bottom: 0px;padding-left:10px">
                            </i>
                        </span>
                    </button>
              </div>
            </form>
              <!-- script Add Tag -->
                <script>
                $(document).ready(function() {
                    $("#tagsBtn").click(function() {
                        if ($('#tagsName').val() == '') {
                            alert('Please Enter Tag Name');
                            $('#tagsName').focus();
                            return
                        } else {
                            var tagsName = $('#tagsName').val();
                            //var intId = $("#speciesTable tr").length;
                            var name = $("<div class=\"text-center\"><h4><span class=\"label newtag\">" + tagsName + " <a href=\"javascript:void(0);\"  class=\"remCF \"><span style=\"color:#fff;\" class=\"fa fa-times\" aria-hidden=\"true\"></span></a></span></h4><input type=\"hidden\"  name=\"tagsName[]\" value=\"" + tagsName + "\"></div>");
                            $("#tagsNameTable").append(name);
                            //clear textbox
                            $('#tagsName').val('');
                        }
                    });
                });
                </script>
                <!-- script Delete species form List -->
                <script>
                $(document).ready(function() {
                    $("#tagsNameTable").on('click', '.remCF', function() {
                            $(this).parent().parent().parent().remove();
                    });
                });
                </script>
          </div>
        <!-- End  -->

        <!-- Edit Event Type -->
          @elseif($EditType == 'e')
          <div class="row">
            <p class="text-center">@include('flash::message')</p>
            <form action="{{ url('admins/writing/') }}/{{ $ID }}" method="POST">
              @if($page == 'Review')
                <input name="page" type="hidden" value="Review">
              @endif
              <input name="_method" type="hidden" value="PUT">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Event Headline <br><small>** less than 100 Words</small></h3>
                    <textarea id="labelTopic" name="labelTopic" class="form-control" required="" maxlength="100" rows="6">{{ $Title }} {{ old('labelTopic') }}</textarea>
              </div>
              <div class="col-md-12" style="margin:0 20px;">
                    <h3 class="text-left">Event Picture</h3>
                      <div class="panel panel-default" style="margin-top: 10px;">
                            @if(!empty($Picture))
                              <img id="blah" src="{{ $Picture }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px;margin-top: 40px;" />
                              <br>
                              <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" onclick="DeleteProductPic('{{ $Picture }}')"/>
                              <hr>
                              <div class="progress" style="height: 20px;display: none">
                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                </div>
                              </div>
                              <input type='file' id="fileUpload" name="fileUpload"  style="margin: auto;width: 100%;border:none" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*"/>
                              <input type="hidden" id="PathFile" name="PathFile" value="{{ $Picture }}" />
                            @else
                              <img id="blah" src="{{ URL::asset('/admin/images/icon_picture.png') }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px;margin-top: 40px;" />
                              <br>
                              <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" style="display: none" onclick="deleteProductPic()">
                              <hr>
                              <div class="progress" style="height: 20px;display: none">
                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                </div>
                              </div>
                              <input type='file' id="fileUpload" name="fileUpload"  style="margin: auto;width: 100%;border:none" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*"/>
                              <input type="hidden" id="PathFile" name="PathFile" />
                            @endif
                              <script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
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
                              <script src="{{ URL::asset('/admin/js/uploadImages_news_type_event.js') }}"></script>
                              <script>
                              function readURL(input) {
                                  if (input.files && input.files[0]) {
                                      var reader = new FileReader();

                                      reader.onload = function(e) {
                                          $('#blah').attr('src', e.target.result);
                                          $('#blah').css('width', '250');
                                      }

                                      reader.readAsDataURL(input.files[0]);
                                  }
                              }

                              $("#fileUpload").change(function() {
                                  readURL(this);
                              });
                              </script>
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
                      </div>
              </div>
              <div class="col-md-12" style="margin:20px;">
                <h3 class="text-left">Content</h3>
                <textarea id="myTextarea" name="myTextarea">{{ $Detail }}{{ old('myTextarea') }}</textarea>
              </div>
              <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Add Tag</h3>
                    <div class="input-group" style="margin-top:10px;">
                        <div id="tagsNameTable" style="display: inline-flex;flex-wrap: wrap;">
                                @if(!empty($Tag)) @foreach(explode(',', $Tag) as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                        </span>
                                    </h4>
                                    <input name="tagsName[]" type="hidden" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                                @if(!empty(old('tagsName'))) @foreach(old('tagsName') as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                            <a class="remCF " href="javascript:void(0);">
                                                <span aria-hidden="true" class="fa fa-times" style="color:#fff;">
                                                </span>
                                            </a>
                                        </span>
                                    </h4>
                                    <input type="hidden" name="tagsName[]" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                        </div>
                    </div>
              </div>
           
              <div class="col-md-12" style="margin-top: 3.5em;">
                    <a type="button" class="btn btn-lg" href="/admins/writing" style="border-radius: 0px;background-color: #6495ed;color:#fff">
                        <span>
                            <i aria-hidden="true" class="fa fa-caret-left" style="margin-bottom: 0px;padding-right:10px">
                            </i>
                            Back
                        </span>
                    </a>
                    @if(Session('role') == 'Admin' && $page == 'Review')
                      <button class="btn btn-lg" style="border-radius: 0px;background-color: #66CC00;color:#fff" type="submit" name="submit" value="verify">
                        <span>
                          Verify
                          <i aria-hidden="true" class="fa fa-caret-right" style="margin-bottom: 0px;padding-left:10px">
                          </i>
                        </span>
                      </button>
                    @endif
                    <button class="btn btn-lg" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit" name="submit" value="update">
                        <span>
                            Save
                            <i aria-hidden="true" class="fa fa-caret-right" style="margin-bottom: 0px;padding-left:10px">
                            </i>
                        </span>
                    </button>
              </div>
            </form>
          </div>
        <!-- End  -->

        <!-- Edit News Type -->
          @elseif($EditType == 'a')
          <div class="row">
                <p class="text-center">@include('flash::message')</p>
                <form action="{{ url('admins/writing/') }}/{{ $ID }}" method="POST">
                  @if($page == 'Review')
                    <input name="page" type="hidden" value="Review">
                  @endif
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <div class="col-md-12" style="margin:0 20px;">
                    <h3 class="text-left">Headline Picture</h3>
                      <div class="panel panel-default" style="margin-top: 10px;">
                         @if(!empty($Picture))
                              <img id="blah" src="{{ $Picture }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px;margin-top: 40px;" />
                              <br>
                              <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" onclick="DeleteProductPic('{{ $Picture }}')"/>
                              <hr>
                              <div class="progress" style="height: 20px;display: none">
                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                </div>
                              </div>
                              <input type='file' id="fileUpload" name="fileUpload"  style="margin: auto;width: 100%;border:none" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*"/>
                              <input type="hidden" id="PathFile" name="PathFile" value="{{ $Picture }}" />
                            @else
                              <img id="blah" src="{{ URL::asset('/admin/images/icon_picture.png') }}" alt="your image" class="thumb-image img img-responsive center-block" style="width: 120px;margin-top: 40px;" />
                              <br>
                              <input type="button" id="fileDelete" class="btn btn-danger center-block" value="Delete" style="display: none" onclick="deleteProductPic()">
                              <hr>
                              <div class="progress" style="height: 20px;display: none">
                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                </div>
                              </div>
                              <input type='file' id="fileUpload" name="fileUpload"  style="margin: auto;width: 100%;border:none" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*"/>
                              <input type="hidden" id="PathFile" name="PathFile" />
                            @endif
                              <script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
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
                                <script src="{{ URL::asset('/admin/js/uploadImages_news.js') }}"></script>
                                <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            $('#blah').attr('src', e.target.result);
                                            $('#blah').css('width', '250');
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#fileUpload").change(function() {
                                    readURL(this);
                                });
                              </script>
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
                      </div>
                  </div>
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Headline <br><small>** less than 100 Words</small></h3>
                    <textarea id="labelTopic" name="labelTopic" class="form-control" required="" maxlength="100" rows="6">{{ $Title }} {{ old('labelTopic') }}</textarea>
                  </div>
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Hightlight <br><small>** less than 300 Words</small></h3>
                    <textarea id="labelAbstract" name="labelAbstract" class="form-control" required="" maxlength="300" rows="6">{{ $Abstract }} {{ old('labelAbstract') }}</textarea>
                  </div>
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Content</h3>
                    <textarea id="myTextarea" name="myTextarea">{{ $Detail }} {{ old('myTextarea') }}</textarea>
                  </div>
                  <div class="col-md-12" style="margin:20px;">
                    <h3 class="text-left">Add Tag</h3>
                    <div class="input-group">
                          <span class="input-group-btn">
                            <button type="button" class="btn" id="tagsBtn">
                              <span><i aria-hidden="true" class="fa fa-plus"></i></span>
                            </button>
                          </span>
                          <input type="text" id="tagsName" placeholder="Tag Name" class="form-control">
                    </div>
                    <div class="input-group" style="margin-top:10px;">
                        <div id="tagsNameTable" style="display: inline-flex;flex-wrap: wrap;">
                                @if(!empty($Tag)) @foreach(explode(',', $Tag) as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                        </span>
                                    </h4>
                                    <input name="tagsName[]" type="hidden" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                                @if(!empty(old('tagsName'))) @foreach(old('tagsName') as $value)
                                <div class="text-center">
                                    <h4>
                                        <span class="label tag">
                                            {{ $value }}
                                            <a class="remCF " href="javascript:void(0);">
                                                <span aria-hidden="true" class="fa fa-times" style="color:#fff;">
                                                </span>
                                            </a>
                                        </span>
                                    </h4>
                                    <input type="hidden" name="tagsName[]" value="{{ $value }}">
                                    </input>
                                </div>
                                @endforeach @endif
                        </div>
                    </div>
                  </div>
                  @if(Session('role') == 'Admin' && $page == 'Review')
                    <div class="col-md-12" style="margin:20px;">
                      <div class="form-inline">
                        <!-- Latest compiled and minified CSS -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
                        <!-- Latest compiled and minified JavaScript -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
                         <select class="selectpicker" data-live-search="true" name="productID" id="productID" required>
                         <option data-tokens="null" value="null" disabled selected>ระบุ Product</option>
                          @if(!empty($jsonDecodeGetProduct['dataListProduct']))
                                @foreach($jsonDecodeGetProduct['dataListProduct'] as $dataListProduct)
                                  <option data-tokens="{{ $dataListProduct['ProductName'] }}" value="{{ $dataListProduct['ProductID'] }}">{{ $dataListProduct['ProductName'] }}</option>
                                @endforeach
                            @endif
                        </select>
                       <button id="verify" class="btn btn-success" type="submit" name="submit" value="verify" disabled="true" style="border-radius: 0px;background-color: #66CC00;color:#fff;">
                                Verify
                        </button>
                      </div>
                      <script>
                        $('#productID').on("change", function () {
                            if( $('#productID').val().length > 0 ) {
                                $('#verify').prop("disabled", false);
                            } else {
                                $('#verify').prop("disabled", true);
                            }
                          });
                      </script>
                    </div>
                  @endif
                


                  <div class="col-md-12" style="margin-top: 3.5em;">
                    <button class="btn btn-lg" disabled="true" style="border-radius: 0px;background-color: #6495ed;color:#fff;opacity: 0.2">
                        <span>
                            <i aria-hidden="true" class="fa fa-caret-left" style="margin-bottom: 0px;padding-right:10px">
                            </i>
                            Back
                        </span>
                    </button>
                    <button class="btn btn-lg" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit" name="submit" value="update">
                        <span>
                            Update
                            <i aria-hidden="true" class="fa fa-caret-right" style="margin-bottom: 0px;padding-left:10px">
                            </i>
                        </span>
                    </button>
                  </div>
                </form>

                 <!-- script Add Tag -->
                <script>
                $(document).ready(function() {
                    $("#tagsBtn").click(function() {
                        if ($('#tagsName').val() == '') {
                            alert('Please Enter Tag Name');
                            $('#tagsName').focus();
                            return
                        } else {
                            var tagsName = $('#tagsName').val();
                            //var intId = $("#speciesTable tr").length;
                            var name = $("<div class=\"text-center\"><h4><span class=\"label newtag\">" + tagsName + " <a href=\"javascript:void(0);\"  class=\"remCF \"><span style=\"color:#fff;\" class=\"fa fa-times\" aria-hidden=\"true\"></span></a></span></h4><input type=\"hidden\"  name=\"tagsName[]\" value=\"" + tagsName + "\"></div>");
                            $("#tagsNameTable").append(name);
                            //clear textbox
                            $('#tagsName').val('');
                        }
                    });
                });
                </script>
                <!-- script Delete species form List -->
                <script>
                $(document).ready(function() {
                    $("#tagsNameTable").on('click', '.remCF', function() {
                            $(this).parent().parent().parent().remove();
                    });
                });
                </script>
          </div>
        <!-- End  -->

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
    <script>
    $(document).ready(function() {
        $('#my-article-text a').css('color', '#5093E1');
        $('#my-article-text').css('border-left', '4px solid #5093E1');
    });
    </script>
    <script>
          $("#tagsName").keyup(function(event){
              if(event.keyCode == 32){
                  $("#tagsBtn").click();
              }
          });
    </script>
    <script>
      $(function() {
          $('input[type="radio"][name=typevideo]').click(function() {
              if ($(this).is(':checked') && $(this).val() == 'link') {
                  //alert($(this).val());
                  $('input[type=text][name=PathFile]').prop('disabled', false);
                  $('input[type=hidden][name=PathFile]').prop('disabled', true);
                  $('#fileUpload').prop('disabled', true);
              } else {
                  $('input[type=text][name=PathFile]').prop('disabled', true);
                  $('input[type=hidden][name=PathFile]').prop('disabled', false);
                  $('#fileUpload').prop('disabled', false);
              }
          });
      });
    </script>    
    <script>
    function DeleteProductPic(id) {
       // if (id != '') {
           // var url = "http://farmerspace.azurewebsites.net/HandlerForWeb.ashx/?" + $.param({"Method": "DeleteProduct_Pic", "ID": id});
            //    fetch(url,{
           //         mode: 'no-cors',
            //        method: 'get',
           //     });
      //  }
    }
    </script>
</div>
<!--inner block end here-->
@endsection
