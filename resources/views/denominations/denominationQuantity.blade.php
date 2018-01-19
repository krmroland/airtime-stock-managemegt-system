<h5 class="text-center">{{ $heading or '' }}</h5>
<table class="table table-bordered table-hover table-sm">
	<thead>
		<tr class="text-info">
			<th>Denomination</th>
			<th>Weight</th>
			<th>Pieces</th>
			<th>Gross</th>
			<th>Net</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($network->denominations as $denomination)
		<tr>
			<td> {{ title_case($denomination->name) }}</td>
			<td> {{ nf($denomination->weight) }}</td>
			<td> {{ $denomination->before_quantity }}</td>
			<td class="table-info"> {{ $denomination->new_quantity }}</td>
			<td> {{ $denomination->after_quantity }}</td>
		</tr>
	@endforeach
		
	</tbody>
</table>

