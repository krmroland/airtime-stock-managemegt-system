<template>

	<div>
		<date ></date>

		<bounce>
			<div v-if="percentages">
				<processor :percentages="percentages"></processor>	
			</div>
		</bounce>
	</div>
</template>

<script>
	import date from "../components/date";
	import processor from "./processor";

	export default
	{
		mounted()
		{
			axios.get("/purchases/percentages").then(({data})=>{
				this.percentages=data;
			});
		},

		data()
		{	
			return {
				percentages:null
			}

		},

		components:{processor,date}
	}
</script>