@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">
		<fielder :data="{{ $fielder }}"></fielder>
		<h4 class="card-title text-center">Avatar Upload Form</h4>

		<p class="font-italic">Please select to choose a photo</p>
		<form action="{{ route('avatar.store',$fielder) }}" method="post" 
			enctype="multipart/form-data">
			{{ csrf_field() }}
			

			{{-- Dsrs Photo --}}
			<div class="form-group">
				<label for="exampleInputFile">Dsrs Photo</label>
				<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="avatar">
				@if ($errors->has("avatar"))
				<small id="fileHelp" class="form-text text-danger">
					{{ $errors->first("avatar") }}
				</small>
				@endif
				
			</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-camera"></i>
			Upload Drs's Photo
		</button>
	</div>
		</form>
	</div>
</div>
@endsection

