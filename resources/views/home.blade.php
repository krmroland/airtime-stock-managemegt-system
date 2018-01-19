@extends('layouts.app')

@section('content')

<hoverable>
	<div class="box">
		<h4 class="text-center text-muted">Quick Links</h4>
		<div class="d-flex justify-content-center">
			<div class="btn-group flex-wrap justify-content-center">
				<a href="{{ route('stock.create') }}" class="btn btn-outline-info">
					<i class="fa fa-long-arrow-left"></i>
					Issue New Stock
				</a>
				<a href="{{ route('payments.create') }}" 
					class="btn btn-outline-info">
					<i class="fa fa-money"></i>
					Make A payment
				</a>

				<a href="{{ route('fielders.index') }}" class="btn btn-outline-info">
					<i class="fa fa-group"></i>
					DSRS
				</a>
				
				<a href="{{ route('purchases.create') }}" class="btn btn-outline-info">
					<i class="fa fa-long-arrow-right"></i>
					Purchase  Stock
				</a>
				<a href="{{ route('serials.index') }}" class="btn btn-outline-info">
					<i class="fa fa-search"></i>
					Find A Serial Number
				</a>
			</div>
		</div>
	</div>
</hoverable>
<daily-report :changes-dates="false"></daily-report>

@endsection
