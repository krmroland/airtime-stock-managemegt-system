<template >

	<form action="/payments" method="post" @submit.prevent="onSubmit" >

		<transactionDetails @fielderSelected="activateLoading"  
			@fielderDeselected="deactivateLoading"></transactionDetails>

		<input type="hidden" name="_token" v-model="token">

		<bounce>
		<div v-if="selectedFielder" >
			<!-- Ammount Being Paid  -->
			<div class="form-group">
				<label  for="ammount">Ammount Being Paid</label>
				<input type="text" name="ammount" class="form-control" :value="ammount" placeholder="Ammount Being Paid" ref="ammount" @input="updateAmmount($event.target.value)">	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-save"></i>
					Process The Payment
				</button>
			</div>
			<div class="alert alert-info alert-payment bg-white">
				<span class="h6 ">The dsr balance will be:<u class="text-danger">{{ newBalanace }}</u></span>
			</div>
		</div>
	</bounce>
	<input type="hidden" name="ammount" v-model="rawAmmount">
</form>
</template>
<script>

	import transactionDetails from "./transactionDetails";

	import Confirmation from "../Confirmation";

	export default {


		components:{transactionDetails},
		data(){


			return {
				selectedFielder:false,
				fielder:{},
				ammount:''

			}
		},

		methods:{

			activateLoading(fielder)
			{

				this.selectedFielder=true;
				this.percentages=fielder.loading,
				this.fielder=fielder;
			},
			deactivateLoading()
			{
				this.selectedFielder=false;
			},
			
			onSubmit()
			{
				if (!Number(this.rawAmmount)) {
					flash("Dont you think you have to add some ammount before processing","question");

					return;
				}
				Confirmation.confirm("Proceed","This ammount will be persisted to the database").then(()=>{

					this.$el.submit();

				}).catch((error)=>{

				})

			},
			updateAmmount(ammount)
			{
				ammount= this.numeral(ammount);

				this.$refs.ammount.value=this.numberFormat(ammount);
				this.ammount=this.numberFormat(ammount);
				this.$emit("input", ammount);

			}

		},
		computed:{
			rawAmmount()
			{
				return this.numeral(this.ammount);
			},
			newBalanace()
			{

				return this.numberFormat(Number(this.rawAmmount)+Number(this.fielder.balance));
			}
		}
		
	}
</script>
<style lang="scss" scopped>
	@import "resources/assets/sass/colors";

	.alert-payment{
		position:fixed;
		bottom:0;
		right:30px;
		z-index:4;
	}
</style>