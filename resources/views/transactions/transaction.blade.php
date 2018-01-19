<div class="box d-flex justify-content-around align-items-center">
	<div>
		<h5>Date</h5>
		{{ $transaction->formatedDate }}
	</div>
	<div>
		<h5>Transaction Number</h5>
		{{ $transaction->transactionNumber }}
	</div>

	<div>
		<h5>Name</h5>
		{{ $transaction->type }}
	</div>
	<div>
		<h5>Description</h5>
		{{title_case($transaction->description) }}
	</div>
	<div>
		<h5>Ammount</h5>
		{{nf($transaction->ammount) }}
	</div>
</div>