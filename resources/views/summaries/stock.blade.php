
@foreach ($stock->networks() as $name=>$network)
	<h4 class="text-center text-info">{{ title_case($name) }}</h4>
	@include('summaries.stock.network')
@endforeach