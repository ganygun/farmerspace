@extends('admins.layouts-login.master') @section('content')
	<style>
		.input_hidden {
	    position: absolute;
	    left: -9999px;
	    }

	    #job input[type="radio"]:checked + label>img {
	      opacity: 1.0;
	        filter: alpha(opacity=100); /* For IE8 and earlier */
	    }
	    #job input[type="radio"]:hover + label>img {
	      opacity: 1.0;
	        filter: alpha(opacity=100); /* For IE8 and earlier */
	    }

	     #job input[type="radio"]:checked + label {
	     	background-color: #b6d6b6;
	    }
	    #job input[type="radio"]:hover + label {
	    	background-color: #b6d6b6;
	    }

	    /* Stuff after this is only to make things more pretty */
	    #job input[type="radio"] + label>img {
	      opacity: 1.0;
	        filter: alpha(opacity=30); /* For IE8 and earlier */
	        cursor: pointer;
	    }
	    #job label {
	        display: inline-block;
	        cursor: pointer;
	        border:1px solid #f0f0f2;
	        padding: 20px;
	        text-align: center;
	        height: 120px;
	        width: 130px;
	        margin: 5px;
	    }
	    #job label img{
	    	width:  auto;
        	height: 50px;
	    }
	    #job label p{
	    	padding-top: 10px;
	    	font-size: 14px;

	    }
	    #leftmenu {
		    position: fixed;
		}
		#rightmenu {
		    position: absolute;
		    right: 0;
		    background-color: #ffffff;
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
			<div id="rightmenu" class=" col-sm-6 col-md-6 col-lg-6" style="height: 100vh;">
				<div class="contain-page">
					    	 <div class="contain-head">
					    	 	<p class="highlight" style="color: #000">กรุณาเลือกตำแหน่ง</p>
								<form  role="form" method="GET" action="{{ url('/admins/register/create') }}">
									{{ csrf_field() }}
				             		<p class=" text-center">@include('flash::message')</p>
				               		<p style="color:red;">{{ $errors->first('jobtype') }}</p>
				               		   <div id="job">
					                        <div style="margin-top:3em">

					                            <input required="" class="input_hidden" name="RegistType" type="radio"
					                            id="01" value="01"  {{ old('RegistType') === '01' ? 'checked' : '' }} />
					                            <label for="01">
					                                <img alt="เกษตรกร" src="{{ URL::asset('admin/images/register_icon/Register_01.png') }}" style="margin-left:0px;" />
					                            	<p class="text-center">เกษตรกร</p>
					                            </label>

					                            <input class="input_hidden" name="RegistType" type="radio"
					                            id="02" value="02"  {{ old('RegistType') === '02' ? 'checked' : '' }}/>
					                            <label for="02">
					                                <img alt="ผู้ซื้อผลิต" src="{{ URL::asset('admin/images/register_icon/Register_02.png') }}" style="margin-left:0px;" />
					                            	<p class="text-center">ผู้ซื้อผลผลิต</p>
					                            </label>
					                        </div>
					                        <div style="margin-bottom:3em;">

					                         	<input class="input_hidden" name="RegistType" type="radio"
					                            id="03" value="03"  {{ old('RegistType') === '03' ? 'checked' : '' }}/>
					                            <label for="03">
					                                <img  alt="นักเขียน" src="{{ URL::asset('admin/images/register_icon/Register_03.png') }}" style="margin-left:0px;" />
					                            	<p class="text-center">นักเขียน</p>
					                            </label>

					                            <input class="input_hidden" name="RegistType" type="radio"
					                            id="04" value="04"  {{ old('RegistType') === '04' ? 'checked' : '' }}/>
					                            <label for="04">
					                                <img alt="องค์กร/บริษัท" src="{{ URL::asset('admin/images/register_icon/Register_04.png') }}" style="margin-left:0px;" />
					                            	<p class="text-center">องค์กร/บริษัท</p>
					                            </label>

					                            <input class="input_hidden" name="RegistType" type="radio"
					                            id="05" value="05"  {{ old('RegistType') === '05' ? 'checked' : '' }}/>
					                            <label for="05">
					                                <img alt="ผู้ดูแลระบบ" src="{{ URL::asset('admin/images/register_icon/Register_05.png') }}" style="margin-left:0px;" />
					                            	<p class="text-center">ผู้ดูแลระบบ</p>
					                            </label>
					                        </div>
					                    </div>

									<div>

									</div>

									<input type="submit" class="btn btn-block" style="background-color: #1C7203;font-size: 16px;" value="ถัดไป">
				               		<div id="jobpanel" style="padding:40px;margin:3em 0;background-color: #f0f0f4;display: none;">
				               		<h3 id="jobtype"></h3>
				               		<br>
									<p id="jobdetail"></p>
									</div>
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
		$('input:radio[name=RegistType]').click(function() {
				$('#jobpanel').css('display','block');
				$('#rightmenu').css('height','auto');

			if ($(this).val() == '01') {
			  	$('#jobtype').text('เกษตรกร');
			  	$('#jobdetail').html('คุณมีผลผลิตที่อยากจะขาย แต่คุณไม่รู้จะขายที่ไหน<br>ทั้งๆที่มีคนสนใจอยากซื้อผลผลิตของคุณอยู่<br>แต่เขาไม่รู้จะติดต่อคุณยังไงเราจะทำให้คุณได้เจอพวกเขา');
			}
			else if ($(this).val() == '02') {
			  	$('#jobtype').text('ผู้ซื้อผลผลิต');
			  	$('#jobdetail').html('หากคุณกำลังมองหาผลผลิตจากเกษตรกร แต่คุณไม่รู้แหล่งผลิต<br>เราจะเป็นช่องทางที่ช่วยอำนวยความสะดวกให้แก่คุณ<br>โดยจะทำให้คุณได้ซื้อผลผลิตคุณภาพ ส่งตรงจากเกษตรกร');
			}
			else if ($(this).val() == '03') {
			  	$('#jobtype').text('นักเขียน');
			  	$('#jobdetail').html('ร่วมแบ่งปันองค์ความรู้สู่เกษตรกรในวงกว้าง<br>เราเปิดกว้างตามความถนัดของคุณ<br>ผ่านรูปแบบ บทความ วีดีโอ หรือ กิจกรรม');
			}
			else if ($(this).val() == '04') {
			  	$('#jobtype').text('องค์กร/บริษัท');
			  	$('#jobdetail').html('หากคุณกำลังมองหาผลผลิตจากเกษตรกร หรือ <br>อยากเป็นส่วนหนึ่งที่จะช่วยผลักดันเกษตรกร<br>พวกเราขอเชิญคุณมาร่วมกับพวกเรา');
			}
			else if ($(this).val() == '05') {
			  	$('#jobtype').text('ผู้ดูแลระบบ');
			  	$('#jobdetail').html('');
			}
		});
	</script>
	<!--inner block end here-->
@endsection




