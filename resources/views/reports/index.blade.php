@inject('fielders', "App\Fielder")
@extends('layouts.app')
@section('content')

{{-- <div class="box text-center">
			<h3 class="text-center">General Reports</h3>
		<div class="btn-group">
			<a href="reports/daily" role="button" class="btn btn-outline-info">Daily Report</a>
			<a href="#" role="button" class="btn btn-outline-info" onclick="flash('feature still in development mode','info')">Monthly Reports</a>
			<a href="#" role="button" class="btn btn-outline-info" onclick="flash('feature still in development mode','info')">Range Reports</a>
			<a href="#" role="button" class="btn btn-outline-info" onclick="flash('feature still in development mode','info')">Dsr Statements</a>
		</div>
</div>

<div class="card">
	<div class="card-block" v-once>
		<h4 class="card-title text-center">Sales Graph for this month</h4>
	</div>
</div> --}}
<daily-report></daily-report>
@endsection

