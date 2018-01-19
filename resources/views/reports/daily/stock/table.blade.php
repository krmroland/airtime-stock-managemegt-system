
<table class="table table-bordered table-hover table-sm">
	<thead>
		<tr>
			<th>Denomination</th>
			<th>Pieces</th>
			<th>Gross</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($denominations as $weight=>$data)
			<tr>
				<td>{{ $weight }}</td>
				<td>{{ $data["quantity"] }}</td>
				<td>{{ $data["gross"] }}</td>
			</tr>
		@endforeach
	</tbody>
</table>