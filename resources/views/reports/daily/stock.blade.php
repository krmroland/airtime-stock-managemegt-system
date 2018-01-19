<h3 class="text-center mt-2 text-primary text-underlined">Opening Balance</h3>
<div class="box mt-3">
		@foreach ($data["opening"] as $network=>$stats)
			@include('reports.daily.stock.item')
	@endforeach
</div>

<h3 class="text-center mt-2 text-primary text-underlined">Stock Purchased</h3>
<div class="box mt-3">
		@foreach ($data["purchased"] as $network=>$stats)
		@include('reports.daily.stock.item')
	@endforeach
</div>


<h4 class="text-center mt-2 text-primary text-underlined">Stock Loaded</h4>
<div class="box mt-3">
		@foreach ($data["loaded"] as $network=>$stats)
		@include('reports.daily.stock.item')
	@endforeach
</div>

<h3 class="text-center mt-2 text-primary text-underlined">Closing Balance</h3>

<div class="box mt-3">
		@foreach ($data["closing"] as $network=>$stats)
		@include('reports.daily.stock.item')
	@endforeach
</div>