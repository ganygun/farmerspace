@extends('admins.layouts-login.master') @section('content')

<div class="container-fluid">
	<div class="row hidden-xs">
		<div class="col-sm-6 col-md-6 col-lg-6 bg-side">
			<div class="contain-page">
				    	<div class="contain-head">
					    	<p class="highlight">ร่วมผนึกกำลังโดยการสร้าง</p>
					    	<p class="highlight">เครือข่ายสังคมภาคการเกษตร</p>
					    	<p class="highlight">เพื่อพัฒนาศักยภาพ สร้างคุณค่า</p>
					    	<p class="highlight">และ คุณภาพชีวิตที่ยั่งยืน</p>
						</div>
							<div class="contain-block">
								<img src="{{ URL::asset('admin/images/LogoFooterWhite.png') }}" alt="" class="img img-responsive" style="height: 60px;">
							</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6">
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
								<input type="submit" class="btn btn-block" style="background-color: #1C7203;font-size: 16px;" value="เข้าสู่ระบบ">
			               		<div style="margin:40px 0;">
								<p class="text-center" style="color: #7A7B78">คุณยังไม่มีบัญชี?<span> <a href="/admins/register"  style="color: #1C7203">ลงทะเบียนได้เลย!</a></span></p>
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
				    	<p class="highlight">ร่วมผนึกกำลังโดยการสร้าง</p>
				    	<p class="highlight">เครือข่ายสังคมภาคการเกษตร</p>
				    	<p class="highlight">เพื่อพัฒนาศักยภาพ สร้างคุณค่า</p>
				    	<p class="highlight">และ คุณภาพชีวิตที่ยั่งยืน</p>
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
								<p class="text-center" style="color: #7A7B78">คุณยังไม่มีบัญชี?<span > <a href="/admins/register" style="color: #1C7203">ลงทะเบียนได้เลย!</a></span></p>
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
<!--inner block end here-->

@endsection



