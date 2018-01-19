@include('statements.headedPaper')

<p class="h5 font-italic text-right text-muted">Generted On:{{ date("d-F-Y H:m:s") }}</p>

<div class="d-flex">
	<img   src="{{ public_path().$fielder->imagePath }}" class="img-thumbnail">
	<p class="h3 text-center font-weight-bold text-muted mb-2">
		<span class="text-info">Name</span>:{{ $fielder->name }}
	</p>
</div>
<h3 class="text-primary text-center">Finacial Statement</h3>
<table class="table-component__table">
	<thead>
		<tr>
			<th>Date</th>
			<th>#Number</th>
			<th>Opening</th>
			<th>Ammount</th>
			<th>Type</th>
			<th>Closing</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($fielder->transactions as $transaction)
			<tr>
				<td>
					{{ $transaction->originalTransaction->date->format("d/m/Y") }}
				</td>
				<td>
					{{ $transaction->originalTransaction->transactionNumber }}
				</td>
				<td>
					{{ nf($transaction->before) }}
				</td>
				<td>
					{{ nf($transaction->originalTransaction->ammount) }}
				</td>
				<td>
					{{$transaction->originalTransaction->type}}
					({{ $transaction->originalTransaction->statusType}})

				</td>
				<td>
					{{ nf($transaction->after) }}
				</td>
			</tr>
		@endforeach
	</tbody>

	<div class="mt-5">
		<p>Signed</p>

		<p>{{ str_repeat(".",40) }}</p>
		<p>{{ $fielder->name }}</p>
	</div>

</table>
