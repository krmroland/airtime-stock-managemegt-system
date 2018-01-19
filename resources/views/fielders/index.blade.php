
@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
		<div class="d-flex justify-content-center ">
			<a  href="{{ route('fielders.create') }}" class="btn btn-outline-info ">
				<i class="fa fa-plus"></i>
				Register New Dsr
			</a>
		</div>
		<div class="box mt-2">
			@foreach ($fielders as $fielder)
				<fielder :data="{{ $fielder }}"/></fielder>
			@endforeach
		</div>
		<div class="row justify-content-center mt-3">
			{{ $fielders->links() }}
		</div>
	</div>
</div>
@endsection

