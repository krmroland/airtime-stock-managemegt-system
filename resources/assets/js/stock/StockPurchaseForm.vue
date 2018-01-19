<template >
		
	<form action="/purchases" method="post" @submit.prevent="onSubmit" >
		<date name="date"></date>
		<input type="hidden" name="_token" v-model="token">
		<input type="hidden" v-model="rawJson" name="raw">
		<input type="hidden" v-model="overollNet" name="net">

	

		
			<template v-for="network in networks">
				<network  :percentage="loading[network]" 
						  :network="network"
						  :grossTotal="grossTotals(network)"
						  :netTotal="netTotals(network)"
						  :availableDenominations="availableStock[network]"
						  :denominations="denominations" >
					
				</network>
			</template>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-save"></i>
					Porcess And Save to the store
				</button>
			</div>
			<div class="alert grand-total">
				The Net Value of the purchased stock is :{{ overollNet|currency }}
			</div>

	
</form>
</template>
<script>


	import network from "./purchases/Network";

	import BaseStock from "./BaseStock";

	import date from"../components/date";

	export default BaseStock.extend({

		components:{network,date},
		
		props:["data"],

		data(){
			return{
				loading:this.data.loading,
				
				availableStock:this.data.stock
			}
		}

		
		
	})
</script>
