<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Airtime Management System</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body class="bg-grey">
	<div class="conatiner is-fullheight d-flex align-items-center justify-content-center">
		<div class="col-md-6">
			<div class=" mb-1">
				<div class="alert alert-info bg-primary ">
					<p class="text-center text-white">
						A customized Online/Offline system for tracking  fielders(DSRS),Stock Sales, Payments,organizing  airtime business easier than ever
					</p>
				</div>
			</div>
			<div class="card">
				<h2 class="text-info text-center p-2">Airtime Management System</h2>
				<div class="card-block">
					<h4 class="card-title text-center">Admin Login Form</h4>
					<form action="{{ route('login') }}" method="post">
						{{ csrf_field() }}
						{{-- Emaill Address --}}
						<div class="form-group {{$errors->has("email")?'has-danger':''}}">
							<label  for="email">
							  Email Address:<span class="text-info font-italic">airtime@lawma.ug</span>
							 </label>
							<input type="email" name="email" class="form-control" placeholder="Emaill Address"
							value="{{old("email","airtime@lawma.ug")}}">
							@if($errors->has("email"))
							<p class="form-text text-danger">
								{{$errors->first("email")}}
							</p>
							@endif
						</div>

						{{-- Password --}}
						<div class="form-group {{$errors->has("password")?'has-danger':''}}">
							<label  for="password">Password: <span class="text-info font-italic">secret</span></label>
							<input type="password" name="password" class="form-control" placeholder="Password"
							value="secret">
							@if($errors->has("password"))
							<p class="form-text text-danger">
								{{$errors->first("password")}}
							</p>
							@endif
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-sign-in"></i>
								Login
							</button>
						</div>

					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>

