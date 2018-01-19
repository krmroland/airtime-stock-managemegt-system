
@foreach ($stock->grossTotalSeries() as $network=>$denominations)
	<div class="box">
	<pie title="{{ $network }}" brand="denominations" 
			:data="{{ $denominations }}" v-cloack></pie>
	</div>
@endforeach
