@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
		<div class="box justify-content-center d-flex">
		<div class="">
				<div class="btn-group">
				<a href="{{ route('stock.create') }}" class="btn btn-outline-info">
					<i class="fa fa-long-arrow-left"></i>
					Issue New Stock
				</a>
				<a href="{{ route('purchases.create') }}" class="btn btn-outline-info">
					<i class="fa fa-long-arrow-right"></i>
					Purchase  Stock
				</a>
				<a href="{{ route('transactions.index',["type"=>"stock"]) }}" 
				class="btn btn-outline-info">
					<i class="fa fa-history"></i>
					Transaction History
				</a>
			</div>
		</div>
		</div>
		<h4 class="card-title text-center">Store Status</h4>
		@include('store.summary',["stock"=>$store->denominations])

	</div>
</div>
@endsection

