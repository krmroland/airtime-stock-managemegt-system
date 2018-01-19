
<div class="card mt-1">
	<div class="card-block">
		<u>
			<h2 class="card-title text-center text-info text-primary ">Serial Number Details</h2>
		</u>
		<div class="box">
			<h5 class="text-center">Loaded By</h5>
			@include("fielders.fielder",
			["fielder"=>$serial->denomination->network->stock->loaded->fielder])

		</div>
		
	</div>
</div>
@include('serials.denominationDetails')

<div class="card">
	<div class="card-block">
		<h4 class="card-title text-center font-italic">Stock it was loaded with</h4>
		<table class="table table-bordered table-hover">
			@include('serials.denominationsTable',[
				"denominations"=>$fellowDenominations,
				"currentDenomination"=>$serial->denomination
				])
		</table>
		
	</div>
</div>