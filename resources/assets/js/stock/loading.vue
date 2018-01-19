<template>

	<div>
		<transactionDetails @fielderSelected="percentages=$event.loading" 
		@fielderDeselected="percentages=null">
	</transactionDetails>

	<bounce>
		<div v-if="percentages">
			<processor :percentages="percentages"></processor>	
		</div>
	</bounce>
</div>
</template>

<script>
	import processor from "./processor";
	import transactionDetails from "../components/transactionDetails";

	export default
	{
		data()
		{	
			return {
				percentages:null
			}

		},

		components:{processor,transactionDetails}
	}
</script>