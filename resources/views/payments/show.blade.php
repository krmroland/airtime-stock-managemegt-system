@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
		
		<h3 class="text-center text-muted">Payment made By </h3>
		
		@include('fielders.fielder',["fielder"=>$payment->fielder])
		<div class="box d-flex justify-content-around align-items-center mt-2">
			<div>
				<h5>Date</h5>
				{{ $payment->formatedDate }}
			</div>
			<div>
				<h5>Ammount</h5>
				{{ $payment->formatedAmmount }}
			</div>
		</div>

		
	</div>
</div>

@endsection

