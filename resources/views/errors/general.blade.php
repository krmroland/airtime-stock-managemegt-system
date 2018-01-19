<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Error Page</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div 
	class="row is-fullheight d-flex align-items-center justify-content-center" id="app">

	<div class="card bg-danger col-md-12">
			<h1 class="text-center card-title display-4 text-capitalize text-white font-weight-bold pt-3 ">
				{{$defaults->name}}
			</h1>
			<div class="d-flex align-items-center justify-content-around">
				<div class="text-white h2 font-weight-bold display-5 font-italic">
					Airtime Management System
				</div>
				<div class=" m-2">
					<clock/></clock>
				</div>
			</div>

	</div>
	<div class="text-center">
		<a class="btn btn-lg btn-outline-danger" href="/home">
			<i class="fa fa-arrow-right"></i>
			Get me out of here very fast
			{{ session()->flash("flash","Please make sure you email this error to 
			support@lawma.ug so it doesnot happen again") }}
		</a>
	</div>
	<div class="card card-danger text-white col-md-12">
		<div class="card-block">
			<h1 class="card-title text-center display-1">Hoops! </h1>
			<div class="text-center h4">
				Somethin went wrong! 

				Please report this problem to Lawma at support@lawma.ug
			</div>
		
		</div>
	</div>
</div>

	
	
	<script src="/js/app.js"></script>
</body>
</html>
