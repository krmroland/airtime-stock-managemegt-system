@extends('layouts.app')
@section('content')
<h2 class="text-info display-4 text-center">{{ $fielder->name }}</h2>
<div class="text-right m-2">

<div class="btn-group">
<a href="{{ route('fielders.edit',$fielder) }}" class="btn btn-outline-info">
	<i class="fa fa-edit"></i>
	Edit Profile
</a>
<a href="{{ route('avatar.create',$fielder) }}" class="btn btn-outline-info">
	<i class="fa fa-camera"></i>
	Upload Photo
</a>
</div>
	
</div>
<fielder :data="{{ $fielder }}" :show-details="false"></fielder>
<div class="card">
	<u><h3 class="text-center text-muted">Transaction History</h3></u>
	@foreach ($transactions as $transaction)
		<div class="table-responsive">
		@include('fielders.transactions.transaction')
			
		</div>
	@endforeach
	
</div>


@endsection

