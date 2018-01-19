@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
		<h4 class="card-title text-center text-underlined">
			Transaction 	
			<span class="font-italic text-info">
				{{ $transaction->transactionNumber }}
			</span> Details
		</h4>
		@include('transactions.transaction')
		@foreach ($transaction->transactable->networks as $network)
			@include('transactions.stockNetworkTable',["stock"=>$network, "name"=>"Purchased Qunatities"])
		@endforeach
		
		
	</div>
</div>

@endsection

