<!--  <template>

			
			<input type="text" class="form-control "   @input="formatQuantity($event.target.value)" ref="quantityInput" >
		
			<input type="text" class="form-control"  disabled="" v-model="gross">
		
			<input type="text" class="form-control"  disabled="" v-model="net">

		</div>

		<transition enter-active-class="animated fadeInRight" leave-active-class="animated fadeOutLeft">
			<div v-show="errors.present" v-text="errors.text" class="form-text stockError"></div>
		</transition>
	</div>

</template> -->

<script>

	// import numeral from "numeral";

	// export default {

	// 	props:{
	// 		name:{
	// 			type:String,
	// 			required:true
	// 		},
	// 		weight:{
	// 			required:true,
	// 			type:Number
	// 		},
	// 		percentage:{

	// 		}
	// 	},
	// 	data()
	// 	{
	// 		return {
	// 			quantity:0,

	// 			errors:{text:'',present:false}
	// 		}
	// 	},
	// 	computed:{

	// 		gross(){

			
	// 				let gross=this.quantity*this.weight;
	// 				this.dispathNewValue("gross",gross);
	// 				return this.numberFormat(gross);

	// 		},

	// 		net(){
			
	// 				let net =this.quantity*this.weight*this.transformedPercentage;

	// 				this.dispathNewValue("net",net);

	// 				return this.numberFormat(net);

	// 		},
	// 		transformedPercentage()
	// 		{
	// 			return (100-this.percentage)/100;
	// 		},
	// 	},
	// 	methods:
	// 	{

			

	// 		formatQuantity(number)
	// 		{
				


	// 			let quantity=this.numeral(number);

	// 			if(quantity >100000){

	// 				this.activateErrors("You cant load more than (100,0000 pieces) in quantity");

	// 				this.addCommas( _.toString(quantity).substring(0, 5));

	// 				return;

	// 				this.$emit("quantityChanged",{quantity:quantity,weight:this.weight});
	// 			}

				


	// 			this.addCommas(number);

	// 			this.$emit("quantityChanged",{quantity:quantity,weight:this.weight});

	// 		}
	// 		,
	// 		dispathNewValue(type,value)
	// 		{
	// 			let payload={};

	// 			payload['type']=type;
	// 			payload['value']=value;
	// 			payload['denomination']=this.weight;
	// 			this.$emit("newValues",payload);
	// 		},

	// 		addCommas(number)
	// 		{
	// 			this.quantity= this.numeral(number);
	// 			this.$refs.quantityInput.value=this.numberFormat(number);
	// 		},

	// 		activateErrors(error)
	// 		{
	// 			this.errors['present']=true,
	// 			this.errors['text']=error;
	// 			setTimeout(()=>{
	// 				this.errors['present']=false
	// 				this.errors['text']='';
	// 			},3500)
	// 		},
	// 	},

	// }
</script>

<style scoped lang="scss">
	// @import "resources/assets/sass/colors";

	// div.stockError
	// {
	// 	//background:lighten(#EFEFF0,4%);
	// 	text-align: center;
	// 	padding:2px;
	// 	margin:2px;
	// 	color:red;
	// 	font-size:18px;
	// 	border: 2px solid $brand-primary;

	// }
</style>
