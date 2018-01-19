@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
	<vue-table 
			end-point="/transactions"
			title="{{ title_case("$type Transaction History") }}"
			placeholder="filter by date"

			>
		<table-cell label="Transaction Date" data-name="formatedDate">
		</table-cell>

		<table-cell data-name="transactionNumber" label="Transaction Number">
		</table-cell>
		<table-cell data-name="type" label="Transaction Type">
			
		</table-cell>
		<table-cell data-name="ammount" label="Transaction Ammount" 
						data-type="currency">
			
		</table-cell>
		<table-cell data-name="detailUrl" label="Details" data-type="link">
			
		</table-cell>
	</vue-table>
	
	
</div>
</div>
@endsection

