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
		<h3 class="text-center text-muted">Payment made By </h3>
		
		@include('fielders.fielder',["fielder"=>$transaction->transactable->fielder])
		
	</div>
</div>

@endsection

