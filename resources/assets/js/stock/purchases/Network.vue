
<template>
	<div class="card pt-4">
		<h4 class="text-center text-info">{{ network|title }}</h4>
		<div class="card-block">
			<div >
				<div class="input-group m-0">
					<input type="text" class="form-control " value="Denominations" disabled="">
					<input type="text" class="form-control bg-warning" value="Available" disabled="">
					<input type="text" class="form-control" value="New Quantity" disabled="">
					<input type="text" class="form-control"  value="Gross" disabled="">
					<input type="text" class="form-control"  value="Net" disabled="">
					<input type="text" class="form-control bg-info" value="Total Quantity" disabled="">
			</div>

				<template   v-for="(weight,name) in denominations">
					<denomination  :name="name" :weight="weight" :percentage="percentage"
					:key="denominations[weight]" :network="network"
					:availableQuantity="availableQuantity(weight)"
					 ></denomination>
				</template>
				

				<div class="input-group m-0">
					<input type="text" class="form-control " value="Totals" disabled="">
					<input type="text" class="form-control" value="NA" disabled="">
					<input type="text" class="form-control" value="NA" disabled="">
					<input type="text" class="form-control bg-success"  :value="grossTotal|currency" disabled="">
					<input type="text" class="form-control bg-success"  :value="netTotal|currency" disabled="">
					<input type="text" class="form-control" value="NA" disabled="">
				</div>



			</div>
		</div>
	</div>

</template>
<script>


	//import denomination from "./denominations/NoSerialNumber";
	import denomination from "./Denomination";

	export default{	

		components:{denomination},

		props:[
			"network","percentage","netTotal","grossTotal","denominations","availableDenominations"
			],

		data()
		{
			return {

			}
		},
		methods:{
			availableQuantity(weight)
			{
				return this.availableDenominations[weight];

			}
		}

	}
</script>