@extends('admins.layouts-login.master') @section('content')
	<style>
	    #leftmenu {
		    position: fixed;
		}
		#rightmenu {
		    position: absolute;
		    right: 0;
		    background-color: #ffffff;
		}
		label{
			vertical-align: -webkit-baseline-middle;
		}
	</style>
	<div class="container-fluid">
		<div class="row hidden-xs">
			<div id="leftmenu" class=" col-sm-6 col-md-6 col-lg-6 bg-side">
				<div class="contain-page">
					    	<div class="contain-head">
						    	<h1 class="head-login text-center" style="color:#fff">ลงทะเบียน</h1>
							</div>
								<div class="contain-block">
									<img src="{{ URL::asset('admin/images/LogoFooterWhite.png') }}" alt="" class="img img-responsive" style="height: 60px;">
								</div>
				</div>
			</div>
			<div id="rightmenu" class=" col-sm-6 col-md-6 col-lg-6" style="height: auto;">
				<div class="contain-page">
					<div class="contain-head">
					 	<h1 class="" style="color: #000;">เกษตรกร</h1>
						<form  role="form" method="POST" action="{{ url('/admins/register') }}">
							<input type="hidden" id="RegistType" name="RegistType" value="{{ Request::get('RegistType') }}">
							{{ csrf_field() }}
				        	<p class="text-center">@include('flash::message')</p>
				        	<!-- Gap -->
				            <div style="margin-top: 40px;"></div>

				            <!-- Institution ________________ -->
					               		<div class="row">
				                            <div class="col-md-4 form-group">
				                            	<label for="Institution">ชื่อฟาร์มของคุณ</label>
				                            </div>
				                            <div class="col-md-6 form-group">
				                                <input type="text" name="Institution" id="Institution" class="form-control" required>
				                            </div>
				                        </div>

				            <!--  Group #1 ________________ -->
	   				                    <h4 class="text-left" style="margin: 20px 0">ข้อมูลส่วนบุคคล</h4>
					               		<!-- Profile Picture -->
		   				                    <div class="row">
					                            <div class="col-md-4 form-group">
					                                <label for="PathFile">รูปโปรไฟล์</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <img id="blah" src="{{ URL::asset('/admin/images/icon_profile.png') }}" alt="your image" class="thumb-image img img-responsive" style="width: 150px" />
					                                <br>
					                                <div class="progress" style="height: 20px;display: none">
						                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
						                                </div>
						                             </div>
					                                <input type='file' id="fileUpload" name="fileUpload" style="margin: auto;width: 232px;border-radius: 0px;" class="btn btn-default" />
					                                <input type="hidden" id="PathFile" name="PathFile" />
					                            </div>
					                        </div>
					               		<!-- First Name -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="FirstName">ชื่อ</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="FirstName" id="FirstName" class="form-control" required>
					                            </div>
					                        </div>
				                        <!-- Last Name -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="LastName">นามสกุล</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="LastName" id="LastName" class="form-control" required>
					                            </div>
					                        </div>
				                        <!-- Phone -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="Phone">เบอร์โทรศัพท์</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="tel" name="Phone" id="Phone" class="form-control" required>
					                            </div>
					                        </div>

				            <!--  Group #2 ________________ -->
   				                   		<h4 class="text-left" style="margin: 20px 0">ข้อมูลที่อยู่</h4>
	   				                    <!-- Address -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="Address">เลขที่อยู่</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="Address" id="Address" class="form-control">
					                            </div>
					                        </div>
					                    <!-- Sub District -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="SubDistrict">ตำบล</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="SubDistrict" id="SubDistrict" class="form-control">
					                            </div>
					                        </div>
					                    <!-- District -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="District">อำเภอ</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="District" id="District" class="form-control">
					                            </div>
					                        </div>
					                    <!-- Province -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="Province">จังหวัด</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="text" name="Province" id="Province" class="form-control">
					                            </div>
					                        </div>
					                    <!-- Zipcode -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="Zipcode">รหัสไปรษณีย์</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="number" name="Zipcode" id="Zipcode" class="form-control">
					                            </div>
					                        </div>

				            <!--  Group #3 ________________ -->
				               			<h4 class="text-left" style="margin: 20px 0">ตั้งค่าความปอดภัย</h4>
	   				                    <!-- password -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="password">รหัสผ่าน</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                                <input type="password" id="password" name="password" class="form-control" required minlength="4">
					                            </div>
					                        </div>
					                    <!-- confirm password -->
		                        			<div class="row">
					                            <div class="col-md-4 form-group">
					                            	<label for="confirmpassword">รหัสผ่านอีกครั้ง</label>
					                            </div>
					                            <div class="col-md-6 form-group">
					                            	<input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="4">
					                            </div>
					                        </div>

				            <!--  Condition ________________ -->
					               		<div class="row">
						               		<div class="col-md-12" style="text-align:center; vertical-align:middle" >
						               			<input type="checkbox" name="condition" required > ข้าพเจ้ายอมรับเงื่อนไขของเว็บไซต์
						               		</div>
					               		</div>

							<!-- Gap -->
				            <div style="margin-top: 40px;"></div>

							<input type="submit" class="btn btn-lg center-block" style="background-color: #6495ed;font-size: 16px;" value="สมัครสมาชิก">
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Mobile -->
			<div class="row hidden-sm hidden-md hidden-lg bg-side">
				<div class="col-xs-12">
					<div class="contain-page">
						    	 <div class="contain-head">
							    	<h1 class="head-login text-center" style="color:#fff">ลงทะเบียน</h1>
									</div>
					</div>

				</div>
				<div class="col-xs-12" style="background-color: #fff;">
					<div class="contain-page">
						    	 <div class="contain-head">
						    	 	<p class="head-login">เข้าสู่ระบบ</p>
									<form  role="form" method="POST" action="{{ url('/admins/login') }}">
										{{ csrf_field() }}
					             		<p class=" text-center">@include('flash::message')</p>
					               		<p style="color:red;">{{ $errors->first('email') }}</p>
					               		<div class="form-group">
					               			<label for="email">อีเมล์ หรือ เบอร์โทรศัพท์</label>
										@if (!old('email'))
											<input class="form-control" type="text" name="email"  required="">
					                    @else
											<input class="form-control" type="text" name="email" value="{{ old('email') }}" required="">
					                    @endif
					               		</div>
					               		<div class="form-group">
					               		<label for="password">รหัสผ่าน</label>
										<p style="color:red;">{{ $errors->first('password') }}</p>
										<input class="form-control" type="password" name="password" class="lock">
										</div>
										<input type="submit" class="btn btn-block" style="background-color: #1C7203" value="เข้าสู่ระบบ">
					               		<div style="margin:40px 0;">
										<p class="text-center" style="color: #7A7B78">คุณยังไม่มีบัญชี?<span > <a href="" style="color: #1C7203">ลงทะเบียนได้เลย!</a></span></p>
										</div>
									</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="contain-head">
					<img src="{{ URL::asset('admin/images/LogoFooterWhite.png') }}" alt="" class="img img-responsive" style="height: 60px;background-color: transparent;">
					</div>
				</div>
			</div>

	</div>
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
		var password = document.getElementById("password")
		  , confirm_password = document.getElementById("confirm_password");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
		    confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
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
                <script src="{{ URL::asset('/admin/js/uploadImages_profile.js') }}"></script>
	<!--inner block end here-->
@endsection




