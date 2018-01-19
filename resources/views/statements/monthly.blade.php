<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $statement->name }}</title>
</head>
<style>
	.is-fullheight
	{
		height:1500px !important;
	}
</style>
<body>
	
	<div class="m-0 p-0">
		<div class="double-line text-center p-0 m-0">
		
			<h1 class="display-2">{{$defaults->name }}</h1>
			
			<h3 class="display-4">DSR Finacial Statement For the Period</h3>
		
			<h2 class="display-4 text-muted" >{{ $statement->name }}</h2>
		
		</div>
	</div>

	<div class="page-break"></div>

	@foreach ($fielders as $fielder)
	@include('statements.singleFielder')
	@if (!$loop->last)
		<div class="page-break"></div>
	@endif
		
	@endforeach
</body>
</html>

