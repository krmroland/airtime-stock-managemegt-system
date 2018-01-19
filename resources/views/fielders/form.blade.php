{{ csrf_field() }}
<div class="row">
	<div class="col-md-6">
		{{-- Dsrs Name --}}
		<div class="form-group {{$errors->has("name")?'has-danger':''}}">
			<label  for="name">Dsr's Name</label>
			<input type="text" name="name" class="form-control" value="{{old("name",$fielder->name)}}" placeholder="Dsrs Name">
			@if($errors->has("name"))
			<p class="form-text text-danger">
				{{$errors->first("name")}}
			</p>
			@endif
		</div>
	</div>
	<div class="col-md-6">
		{{-- Phone Number --}}
		<div class="form-group {{$errors->has("phoneNumber")?'has-danger':''}}">
			<label  for="phoneNumber">Phone Number</label>
			<input type="text" name="phoneNumber" class="form-control" value="{{old("phoneNumber",$fielder->phoneNumber)}}" placeholder="Phone Number">
			@if($errors->has("phoneNumber"))
			<p class="form-text text-danger">
				{{$errors->first("phoneNumber")}}
			</p>
			@endif
	 </div>
	</div>
</div>
<h5 class="form-text text-center">Percentages</h5>
@include('fielders.percentages',["type"=>"stock"])

