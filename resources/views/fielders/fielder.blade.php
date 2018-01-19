<hoverable>
	<div class="box">
		<div class="d-flex  align-items-center  text-center">
			<img src="{{ $fielder->imagePath }}" alt="" class="img-fluid img-thumbnail rounded-circle">
			<div class="m-auto">
				<p class="h5"><strong>Name</strong></p>
				<p class="h5">{{ $fielder->name }}</p>
			</div>
			<div class="m-auto">
				<p class="h5"><strong>Phone Number</strong></p>
				<p class="h5">{{ $fielder->phoneNumber }}</p>
			</div>
			<div class="m-auto">
				<p class="h5"><strong>Account Balance</strong></p>
				<p class="h5">{{nf($fielder->balance) }}</p>
			</div>
			<div class="mr-1">
				<p class="h5"><span class="fa fa-info fa-2x text-grey"></span></p>
				<a href="{{ route('fielders.show',$fielder) }}">Details</a>
			</div>
		</div>
	</div>
</hoverable>