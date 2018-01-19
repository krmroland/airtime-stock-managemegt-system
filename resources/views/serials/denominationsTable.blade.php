<table class="table table-bordered table-hover">
	<thead>
		<tr class="table-info">
			<th>Denomination</th>
			<th>Qunatity Before</th>
			<th>Quantity Loaded</th>
			<th>Quantity After</th>
			<th>Gross Total</th>
			<th>Net Total</th>
			<th>Serial Number</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach ($denominations as $denomination)
		<tr class="
			{{ 
				($currentDenomination->weight==$denomination->weight)?
					'bg-success text-white':'' }}">
			<td>{{ $denomination->weight}}</td>
			<td>{{ $denomination->before_quantity }}</td>
			<td>{{ $denomination->new_quantity}}</td>
			<td>{{ $denomination->after_quantity}}</td>
			<td>{{ nf($denomination->new_quantity->gross())}}</td>
			<td>{{ nf($denomination->new_quantity->net())}}</td>
			<td>
				({{ $denomination->serial->from }}
									to
				{{ $denomination->serial->to }})

			</td>
		</tr>
		@endforeach
		
	</tbody>
</table>