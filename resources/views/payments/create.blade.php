@extends('layouts.app')
	@section('content')
			<div class="card">
				<div class="card-block">
					<h4 class="card-title text-center">Payments Form</h4>
					<p class="card-text">
						<payment-form></payment-form>
					</p>
					@if ($errors->has("fielder_id"))
						<flash message="{{ $errors->first("fielder_id") }}" type="error" >
							
						</flash>
					@endif
					@if ($errors->has("ammount"))
						<flash message="{{ $errors->first("ammount") }}"  type="error">
							
						</flash>
					@endif
				</div>
			</div>
	@endsection

