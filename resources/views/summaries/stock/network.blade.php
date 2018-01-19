<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th>Pieces</th>
			<th>Denomination</th>
			<th>Gross</th>
			<th>Net</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach ($network as $n)
		<tr>
			<td>{{ nf($n->net/$n->weight) }}</td>
			<td>{{ nf($n->weight) }}</td>
			<td>{{ nf($n->gross) }}</td>
			<td>{{ nf($n->net) }}</td>

		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2"  class="text-right">Totals</th>
			<th>{{ nf($network->sum("gross")) }}</th>
			<th>{{ nf($network->sum("net")) }}</th>
		</tr>
	</tfoot>
</table>