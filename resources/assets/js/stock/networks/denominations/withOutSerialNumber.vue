<template>

	<div class="form-group m-0">
		<div class="input-group m-0">
			<!-- denomination name -->
			<input type="text" class="form-control"  :value="name|title" disabled="">
			<!-- peices -->
			<input type="number" class="form-control" v-model="quantity">
			<!-- gross -->
			<input type="text" class="form-control" v-model="gross" disabled="">
			<!-- net-->
			<input type="text" class="form-control" v-model="net" disabled="">
			
		</div>

		<bounce>
			<div v-show="errors.present" v-text="errors.text" class="form-text stockError">
			</div>
		</bounce>
	</div>

</template>
<script>

	import Store from "./../../Store";

	export default {
		
		props:["name","weight","network","percentage"],

		data()
		{
			return{
				Store,

				errors:{
					present:false,
					text:'',
				},

				gross:null,
				net:null,
				quantity:null

			}
		},

		methods:{
			
			setError(message){
				this.errors.text=message;
				this.errors.present=true;
			},

			setNet(quantity)
			{
				let net =quantity*this.weight*(1-(Number(this.percentage/100)));

				this.Store.setNetTotals(this.network,this.weight,net);

				this.net=this.numberFormat(net);
			},
			setGross(quantity)
			{
				let gross=quantity*this.weight
				this.Store.setGrossTotals(this.network,this.weight,gross);
				this.gross=this.numberFormat(gross);
			},


		},
		watch:{
			quantity(quantity)
			{
				
				quantity=Number(this.quantity);
				this.Store.setProperty("quantities",this.network,this.weight,quantity);
				this.setNet(quantity);
				this.setGross(quantity);

			}
		}
	}
</script>

<style scoped lang="scss">
	@import "resources/assets/sass/colors";

	div.stockError
	{
		//background:lighten(#EFEFF0,4%);
		text-align: center;
		padding:2px;
		margin:2px;
		color:red;
		font-size:18px;
		border: 2px solid $brand-primary;

	}
</style>