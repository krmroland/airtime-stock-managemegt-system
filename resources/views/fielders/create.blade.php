@extends('layouts.app')
	@section('content')
			<div class="card">
				<div class="card-block">
					<h4 class="card-title text-center">DSR Registration Form</h4>
					
					<form action="{{ route('fielders.store') }}" method="post">
						@include('fielders.form')
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save"></i>
								Save DSR
							</button>
						</div>
					</form>
				</div>
			</div>
	@endsection

