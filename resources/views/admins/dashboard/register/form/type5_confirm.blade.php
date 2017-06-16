@extends('admins.layouts-login.master') @section('content')

<div class="container-fluid">
	<div class="row hidden-xs">
		<div class="col-sm-6 col-md-6 col-lg-6 bg-side">
			<div class="contain-page">
				    	<div class="contain-head">
					    	<p class="highlight">ร่วมผนึกกำลังโดยการสร้าง</p>
					    	<p class="highlight">เครื่อยข่ายสังคมภาคการเกษตร</p>
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
					 		<h1 class="" style="color: #000;">ผู้ดูแลระบบ</h1>
				    	 	<p style="margin:20px 0;">** กรุณายืนยันบุคคลด้วยหัวหน้าของคุณ</p>
							<form  role="form" method="POST" action="{{ url('/admins/register/confirm_register') }}">
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
								<input type="submit" class="btn btn-block btn-warning" value="ยืนยัน">
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
				    	<p class="highlight">เครื่อยข่ายสังคมภาคการเกษตร</p>
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
								<input type="submit" class="btn btn-warning" value="ยืนยัน">

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



