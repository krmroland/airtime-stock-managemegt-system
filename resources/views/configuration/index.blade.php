@extends('layouts.app')
	@section('content')
			<div class="card">
				<div class="card-block">
					<h4 class="card-title text-center">Existing Configuration</h4>
					<div class="card-text">
						<configuration-form :data="{{$data}}"></configuration-form>
					</div>
				</div>
			</div>
	@endsection

