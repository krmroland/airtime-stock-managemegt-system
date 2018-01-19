@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">

		<div class="text-right mb-2">
			<a href="{{ route('payments.create') }}" class="btn btn-primary">

				<i class="fa fa-plus"></i>	
				New Payment
			</a>
		</div>
		<vue-table end-point="/payments" 
		title="Payments History"
		placeholder="Filter A date"
		>
		<table-cell label="date" data-name="formatedDate"></table-cell>
		<table-cell label="Paid By" data-name="fielder.name">

		</table-cell>

		<table-cell label="Ammount Paid" data-name="ammount" 
		data-type="currency">

		</table-cell>
		<table-cell label="Dsr Phone number" data-name="fielder.phoneNumber">
		</table-cell>
		<table-cell label="Dsr Phone number" data-name="fielder.phoneNumber">
		</table-cell>
		<table-cell label="Details" data-name="detailUrl" data-type="link">

		</table-cell>
	{{-- <div class="row justify-content-center">
	{{ $payments->links() }}
</div> --}}
</div>
</div>
@endsection

