<div class="box">
	<div class="d-flex align-iteims-center justify-content-center text-center">
		<div class="mr-auto">
			<h5 class="text-muted">Number of Loads (stock)</h5>
			<h5>{{ nf($stock->count()) }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Stock Value</h5>
			<h5>{{ nf($stock->net()) }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Number of Payments</h5>
			<h5>{{ nf($payments->count()) }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Cash</h5>
			<h5>{{ nf($payments->total()) }}</h5>
		</div>
	</div>
</div>