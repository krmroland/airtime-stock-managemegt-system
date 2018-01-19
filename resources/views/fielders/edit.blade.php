@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-block">

		
		<fielder :data="{{ $fielder }}"></fielder>
		<h4 class="card-title text-center">Update Profile Form</h4>

				
				<form action="{{ route('fielders.update',$fielder) }}" method="post">
					{{ csrf_field() }}
					{{ method_field("PUT") }}
				
					{{-- Fielders Name --}}
					<div class="form-group {{$errors->has("name")?'has-danger':''}}">
						<label class="h5 text-info"  for="name">Fielders Name</label>
						<input type="text" name="name" class="form-control" placeholder="Fielders Name" value="{{old("name",$fielder->name)}}">
						@if($errors->has("name"))
						<p class="form-text text-danger">
							{{$errors->first("name")}}
						</p>
						@endif
					</div>
					{{-- Fieledrs phone Number --}}
					<div class="form-group {{$errors->has("phoneNumber")?'has-danger':''}}">
						<label class="h5 text-info"  for="phoneNumber">Fieledrs phone Number</label>
						<input type="text" name="phoneNumber" class="form-control" placeholder="Fieledrs phone Number" value="{{old("phoneNumber",$fielder->phoneNumber)}}">
						@if($errors->has("phoneNumber"))
						<p class="form-text text-danger">
							{{$errors->first("phoneNumber")}}
						</p>
						@endif
					</div>
					{{-- Loading Percentages --}}
					<div class="form-group {{$errors->has("loading")?'has-danger':''}}">
						<label  for="field" class="text-info h5 ">Loading Percentages</label>
						<div class="input-group box">
							@foreach ($fielder->loading as $network=>$value)
								<label class="h5 mr-2 ml-1" >
									{{ title_case($network) }}:
								</label>
								<input type="number" class="form-control" min="0" 
								max="10" 
								name="loading[{{ $network }}]"
								step="0.05"
								required
								value="{{ 
									old("loading[$network]",$fielder->loading[$network]) }}"
								>
							@endforeach
						</div>
						@if($errors->has("loading"))
						<p class="form-text text-danger">
							{{$errors->first("loading")}}
						</p>
						@endif
					</div>
					
					
					{{-- Saving Percentages --}}
					<div class="form-group {{$errors->has("saving")?'has-danger':''}}">
						<label  for="field" class="text-info h5 ">Saving Percentages</label>
						<div class="input-group box">
							@foreach ($fielder->saving as $network=>$value)
								<label class="h5 mr-2 ml-1" >
									{{ title_case($network) }}:
								</label>
								<input type="number" class="form-control" min="0" 
								max="10" required
								step="0.05"
								value="{{ 
									old("saving[$network]",$fielder->saving[$network]) }}"
								name="saving[{{ $network }}]"
								>
							@endforeach
						</div>
						@if($errors->has("saving"))
						<p class="form-text text-danger">
							{{$errors->first("saving")}}
						</p>
						@endif
					</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa edit"></i>
						Update DSR's Profile
					</button>
				</div>


				</form>
			</div>
		</div>
		@endsection

