<template>

	<div class="form-group m-0">
		<div class="input-group m-0">
			<!-- denomination name -->
			<input type="text" class="form-control"  :value="name|title" disabled="">
			<!--from-->
			<input type="number" class="form-control" v-model.number="from"  min="1" >
			<!-- to -->
			<input type="number" class="form-control" v-model.number="to" min="1">
			<!-- peices -->
			<input type="text" class="form-control" v-model="formatedQuantity" disabled="">
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

				from:null,

				to:null,

				quantity:null
			}
		},

		methods:{
			

			makeName(type)
			{
				return `serials[${this.network}][${this.weight}][${type}]`;
			},

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

			setSerialNumbers(from,to)
			{
				this.Store.setProperty("serials",this.network,this.weight,{from,to});
			}

		},
		computed:{
			formatedQuantity()
			{
				if (!this.to || this.to<=0) {
					return null;
				}
				
				if (this.to>0) {
					this.quantity=null;
					if (this.from<=0) {
						this.setError("The from must be greater than atleast 0");
						return null;
					}
					if(this.to<this.from){
						this.setError("The to must be greater than the from");
						return null;
					}
				}
				this.quantity=(this.to-this.from+1);

				if (this.quantity>2000000) {
					this.quantity=null;
					this.setError(
						"Surely you are not loading 2,000,0000 pieces of "+ this.name);
					return null;
				}
				this.errors.present=false;


				return this.numberFormat(this.quantity);

				
			}
		},
		watch:{
			quantity(quantity)
			{
				quantity=Number(quantity);
				this.Store.setProperty("quantities",this.network,this.weight,quantity);
				this.setNet(quantity);
				this.setGross(quantity);
				this.setSerialNumbers(this.from,this.to);
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