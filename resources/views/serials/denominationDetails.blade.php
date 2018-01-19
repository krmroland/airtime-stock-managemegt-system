<h3 class="text-center">
	Loaded
	{{ $serial->denomination->network->stock->date->format("d-F-Y") }}

	({{ $serial->denomination->network->stock->date->diffForHumans() }})
</h3>
<div class="box">
	<div class="d-flex  align-items-center  text-center">
		<div class="m-auto">
			<p class="h5"><strong>In Rage</strong></p>
			<p class="h5">
				({{$serial->from}} to {{$serial->to }})

			</p>
		</div>
		<div class="m-auto">
			<p class="h5"><strong>Denomination</strong></p>
			<p class="h5">{{ title_case($serial->denomination->networkName()) }}</p>
		</div>
		<div class="m-auto">
			<p class="h5"><strong>Qty (pieces)</strong></p>
			<p class="h5">{{ nf($serial->denomination->new_quantity->pieces()) }}</p>
		</div>
		<div class="m-auto">
			<p class="h5"><strong>Gross</strong></p>
			<p class="h5">{{ nf($serial->denomination->new_quantity->gross()) }}</p>
		</div>
		<div class="m-auto">
			<p class="h5"><strong>Gross</strong></p>
			<p class="h5">{{ nf($serial->denomination->new_quantity->net()) }}</p>
		</div>
		<div class="m-auto">
			<p class="h5"><strong>Percentage</strong></p>
			<p class="h5">{{ nf($serial->denomination->network->percentage) }}%</p>
		</div>
	</div>
</div>