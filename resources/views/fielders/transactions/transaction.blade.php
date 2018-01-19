<hoverable>
	<div class="box">
		<div class="d-flex  align-items-center  justify-content-between text-center">

		<div>
			<h2 class="text-info display-4">{{ ++$loop->index }}.</h2>
		</div>
			<!-- date -->
			<div class="ml-0">
				<p class="h6"><strong>Date</strong></p>
				<p class="h5 display-5">
					{{ $transaction->originalTransaction->date->format("d/F/y")}}
				</p>
			</div>
			<!-- balance before -->
			<div>
				<p class="h6"><strong>Previous Balance</strong></p>

				<p class="h5 display-5">
					{{ nf($transaction->before)}}
				</p>
			</div>

			<!-- desctiption -->
			@include("fielders.transactions.".
						$transaction->originalTransaction->description)

			<!-- balance after -->
			<div>
				<p class="h6"><strong>After Balance</strong></p>

				<p class="h5 display-5">
					{{ nf($transaction->after)}}
				</p>
			</div

			
		</div>
	</div>
</hoverable>
