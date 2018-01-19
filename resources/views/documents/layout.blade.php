<!DOCTYPE html>
<html lang="">
<head>

	<link rel="stylesheet" href="/css/app.css">
	<style>
		.is-1{
			font-size: 3em;
			font-weight: : 300;
		}

		.doc-pageheader h1{
			font-size: 4rem;
			font-weight: 400;
		}
		.doc-pageheader p{
			font-size: 1.5rem;
		}

		.body-title{
			font-size: 1.25rem;
			font-weight: 300;
		}

		.is-2{
			font-size: 2em;
			font-weight: : 300;
		}
		.is-3{
			font-size: 1.25em;
			font-weight: : 200;
		}
		
	</style>
</head>
<body>
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="#">Lawam</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="/home">Home </a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="bg-purple text-white text-center" style="min-height: 240px;">

		<div class="doc-pageheader">
			<h1 class="pt-4">
				{{ $mainHeader }}
			</h1>


			<p class="lead pt-2">
				{{ $subHeader }}
			</p>
		</div>
	</div>
	<div class="container">
		{{ $slot }}
	</div>
	
</body>
</html>