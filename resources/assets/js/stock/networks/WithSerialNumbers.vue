<template>
	<div class="card pt-4">
		<h4 class="text-center text-info">{{ network|title }}</h4>
		<div class="card-block">
			<div >
				<div class="input-group m-0">
					<input type="text" class="form-control " value="Denominations" disabled="">
					<input type="text" class="form-control"  value="From" disabled="">
					<input type="text" class="form-control"  value="To" disabled="">
					<input type="text" class="form-control" value="Quantity" disabled="" >
					<input type="text" class="form-control " value="Gross" disabled="">
					<input type="text" class="form-control " value="Net" disabled="">
					
					
				</div>

				<template   v-for="(weight,name) in denominations">
					<denomination  :name="name" :weight="weight" :percentage="percentage"
					:key="denominations[weight]" :network="network"
					>
				</denomination>
			</template>


			<div class="input-group m-0">
				<input type="text" class="form-control " value="Totals" disabled="">
				<input type="text" class="form-control " value="NA" disabled="">
				<input type="text" class="form-control" value="NA" disabled="">
				<input type="text" class="form-control" value="NA" disabled="">
				<input type="text" class="form-control"
				:value="store['grossTotal'][network]|currency" disabled="">
				<input type="text" class="form-control" 
				:value="store['netTotal'][network]|currency" disabled="">
				
			</div>



		</div>
	</div>
</div>

</template>
<script>


	import denomination from "./denominations/WithSerialNumber";
	import store from "../Store";
	export default{	

		components:{denomination},


		props:["network","percentage","denominations"],

		data()
		{
			return {
					store
				}
		},


	}
</script>