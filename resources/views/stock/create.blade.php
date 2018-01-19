@inject('default', 'App\Defaults')
@extends('layouts.app')
	@section('content')
			<div class="card">
				<div class="card-block">
					<h4 class="card-title text-center">Stock Loading Form</h4>
					{{-- <stock-form v-cloak></stock-form>
 --}}
					<stock type="loading"></stock>
				</div>
			</div>
	@endsection

