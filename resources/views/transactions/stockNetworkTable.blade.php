<div class="card">
	<h3 class="text-danger text-center display-4">{{ title_case($network->name) }}</h3>
	<div class="card-block">

		<h4 class="text-center"> Balance Before Transancation</h4>
		<table class="table table-bordered table-hover table-sm">
			<thead>
				<tr class="bg-info text-white">
					<th>Denomination</th>
					<th>Weight</th>
					<th>Pieces</th>
					<th>Gross</th>
					<th>Net</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($network->denominations as $denomination)
				<tr class="table-warning">
					<td> {{ title_case($denomination->name) }}</td>
					<td> {{ nf($denomination->weight) }}</td>
					<td class="table-info"> {{ $denomination->before_quantity }}</td>
					<td> {{ nf($denomination->before_quantity->gross) }}</td>
					<td class="table-success"> 
						{{ nf($denomination->before_quantity->net) }}
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		<div class="box bg-faded">

			{{-- added transactions --}}
			<h4 class="text-center"> 
				{{ $name or 'New Quanties'}}</h4>
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr class="bg-primary text-white">
							<th>Denomination</th>
							<th>Weight</th>
							<th>Pieces</th>
							<th>Gross</th>
							<th>Net</th>
							@if (isset($hasSerials))
							<th colspan="2">
								Serial Numbers
							</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach ($network->denominations as $denomination)
						<tr class="table-info">
							<td> {{ title_case($denomination->name) }}</td>
							<td> {{ nf($denomination->weight) }}</td>
							<td> {{ $denomination->new_quantity }}</td>
							<td> {{ nf($denomination->new_quantity->gross) }}</td>
							<td> {{ nf($denomination->new_quantity->net) }}</td>
							@if (isset($hasSerials))
							<td>{{ $denomination->serial? $denomination->serial->range :'Not recorded' }}</td>
							@endif
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>


			<h4 class="text-center"> Balance After Transancation</h4>
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr class="bg-success text-white">
						<th>Denomination</th>
						<th>Weight</th>
						<th>Pieces</th>
						<th>Gross</th>
						<th>Net</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($network->denominations as $denomination)
					<tr class="table-success">
						<td> {{ title_case($denomination->name) }}</td>
						<td> {{ nf($denomination->weight) }}</td>
						<td class="table-info"> {{ $denomination->after_quantity }}</td>
						<td> {{ nf($denomination->after_quantity->gross) }}</td>
						<td class="table-success"> {{ nf($denomination->after_quantity->net) }}</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
	</div>