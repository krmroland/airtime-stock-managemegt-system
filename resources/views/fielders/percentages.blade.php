<!-- loading Percentages -->
<div class="form-group">
	<label for="">Loading Percentages</label>
	<div class="box">
		<div class="input-group">

			@foreach (config("app.networks") as $network)
			<label for="" class="col-form-label col-md-1">{{ title_case($network)}}</label>
			<input type="number" min="0" max="12"  step="0.55" class="form-control"  name="loading[{{ $network }}]" required="">
			@endforeach
		</div>
	</div>
	@if ($errors->has("loading"))
		<span class="form-text-text-danger">{{ $errors->first("loading") }}</span>
	@endif
</div>
				
<!-- Savinngs Percentages-->
<div class="form-group">
	<label for="">Savings Percentages</label>
	<div class="box">
		<div class="input-group">
			@foreach (config("app.networks") as $network)
			<label for="" class="col-form-label col-md-1">{{ title_case($network)}}</label>
			<input type="number" min="0" max="12" step="0.55" class="form-control" name="saving[{{ $network }}]" required="">
			@endforeach

		</div>
	</div>
	@if ($errors->has("saving"))
		<span class="form-text-text-danger">{{ $errors->first("saving") }}</span>
	@endif
</div>
