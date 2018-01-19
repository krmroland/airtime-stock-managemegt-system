
<div class="d-flex  align-items-center  text-center">
	@foreach ($stock->networks as $network)
	<div class="m-auto">
		<h4>{{ title_case("$network (Monetary Value)")}} </h4>
		<h5 class="text-info">{{ nf($stock->netTotal($network)) }}<h5>
	</div>
	@endforeach
	<div class="m-auto">
		<h4>Total net Value </h4>
		<h5 class="text-info">{{ nf($stock->netTotal()) }}<h5>
	</div>
</div>
@foreach ($stock as $network=>$denominations)
<h3 class="text-center text-info">{{ title_case($network) }}</h3>
<div class="box">
	<table class="table table-bordered table-hover ">
		<thead>
			<tr class="table-info">
				<th>Denomination</th>
				<th>Available Pieces</th>
				<th>Gross</th>
				<th>Current purchasing (%)</th>
				<th>Net (Monetary Cash)</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach ($denominations as $denomination)
			<tr class="{{ $denomination->quantity<100?'table-danger':'' }}">
				<td>{{ nf($denomination->weight)}}</td>
				<td>{{ nf($denomination->quantity) }}</td>
				<td>{{ nf($denomination->gross)}}</td>
				<td>{{ nf($denomination->percentage)}}%</td>
				<td>{{ nf($denomination->net,1)}}</td>
			</tr>
			@endforeach
			
		</tbody>
		<tfoot>
			<tr class="table-success text-info">
				<th colspan="4" class="text-right">Total Net Value</th>
				<th>{{ $stock->netTotal($network) }}</th>
			</tr>
		</tfoot>
	</table>
</div>
@endforeach