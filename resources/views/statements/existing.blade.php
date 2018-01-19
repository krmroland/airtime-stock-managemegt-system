<div class="box mt-3 bg-primary text-white">
	<div class="d-flex  align-items-center justify-content-between text-center">
		<div class="">
			<p class="h5"><strong>Name</strong></p>
			<p class="h5">
				<i class="fa fa-file-pdf-o fa-2x"></i>
				{{ $statement->name }}
			</p>
		</div>
		<div class="">
			<i class="fa fa-info fa-4x"></i>
		</div>
		<div>
			<p class="h5"><strong>Status</strong></p>
			<p class="h5">Report already exists</p>
		</div>
		<div class="mr-3">

			<a href="{{ route('statements.show',$statement) }}" target="_blank">
			<i class="fa fa-cloud-download fa-3x fa-fw  text-white"></i>
			<span class="font-italic text-white h4">
				Download
			</span>
		</a>
	</div>
</div>
</div>