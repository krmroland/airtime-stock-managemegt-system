<table class="table table-bordered table-sm  dataTable">
	<thead>
		<tr>
			<th>Date</th>
			<th>Name</th>
			<th>Net Total</th>
			<th>Totals</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($stock as $s)
		<tr>
			<td>{{ $s->date->format("d-m-Y") }}</td>
			<td>{{ $s->fielder->name }}</td>
			<td>{{ $s->fielder->balance }}</td>
			<td>{{ $s->net() }}</td>
		</tr>
		@endforeach

	</tbody>
</table>