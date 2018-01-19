<template>
	<div class="box">
	<div class="d-flex align-iteims-center justify-content-center text-center">
		<div class="mr-auto">
			<h5 class="text-muted">Number of Loads (stock)</h5>
			<h5>{{ stock.total_count|currency }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Stock Value</h5>
			<h5>{{ stock.net|currency }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Number of Payments</h5>
			<h5>{{payments.total_count|currency }}</h5>
		</div>
		<div class="mr-auto">
			<h5 class="text-muted">Cash</h5>
			<h5>{{ payments.total_ammount|currency}}</h5>
		</div>
	</div>
</div>
</template>
<script>
	export default
	{
		props:["stock","payments"],

	}
</script>