<template >

	<form action="/stock" method="post" @submit.prevent="onSubmit" >
		<input type="hidden" name="_token" v-model="token">
		<input type="hidden" v-model="rawJson" name="raw">

		<transactionDetails @fielderSelected="activateLoading" 
							@fielderDeselected="deactivateLoading">
			
		</transactionDetails>


		<bounce>
			<div v-if="selectedFielder" >
			
				<div class="box text-center">
					<h5 class="text-center">Loading Mechanism</h5>
					<switchery :options="loadingTypes" @changedIndex="swapLoadingType(index)">
						
					</switchery>
				</div>
			
				<div class="card mt-2"  v-for="network in networks">
					<div class="card-block">
						<h4 class="text-center">{{ network|title }}</h4>
			
						<stock
						:network="network" 
						:denominations="denominations" 
						:percentage='percentages[network]'
						@netTotal="recordTotals(network,$event)"
						@denominationsChanged="updateDenominations"
						>
						</stock>
			
				</div>
			
			</div>
			<div class="d-flex justify-content-center" >
			
				<div class="box">
					<button type="submit" class="btn btn-primary" @click="onSubmit">
						<i class="fa fa-save"></i>
						Save Transaction
					</button>
				</div>
			
				<div class="alert alert-info text-center grand-total">
					Net Total: {{ netTotal }}
				</div>
			</div>
			
			
				</div>
		</bounce>

</form>
</template>
<script>

	import stock from "./stock";
	import Confirmation from "../Confirmation";

	import switchery from "./switchery";

	import transactionDetails from "./transactionDetails";

	export default {
		mounted()
		{
			window.onbeforeunload=()=>'Are you sure you want to leave';
		},
		props:{
			networks:{

			},
			denominations:{

			}
		},

		components:{transactionDetails,stock,switchery},
		data(){


			return {
				selectedFielder:false,
				fielder:{},
				percentages:{},
				netTotals:{},
				raw:{},
				isSubmiting:'',
				loadingTypes:['WithSerialNumbers','NoSerialNumbers'],
				activeType:'WithSerialNumbers'
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
				this.fielder=false;

			},
			percentages(network)
			{
				return this.fielder.percentages.network
			},

			swapLoadingType(index)
			{
				this.activeType=this.loadingTypes[index];
			},
			recordTotals(network, total)
			{
				this.$set(this.netTotals,network,total);
			},
			updateDenominations(data)
			{

				if(!this.raw.hasOwnProperty(data.network)){

					this.$set(this.raw,data.network,{})
				}
				this.$set(this.raw[data.network],data.weight, data.quantity);
			},
			onSubmit()
			{
				if (_.isEmpty(this.raw)) {
					flash("Dont you think you have to add some values before submiting","question");

					return;
				}
				Confirmation.confirm("Proceed","Stock changes will be persisted to the database").then(()=>{

					this.$el.submit();

				}).catch((error)=>{

				})

			}

		},
		computed:{
			netTotal()
			{
				return this.numberFormat(Object.values(this.netTotals).reduce((next, previous)=>{return next+previous},0));
			},
			formData()
			{
				return {};
			},
			rawJson()
			{
				return JSON.stringify(this.raw);
			}
			
		},
	}
</script>
<style lang="scss" scopped>
	@import "resources/assets/sass/colors";

	.grand-total{
		position:fixed;
		display:flex;
		justify-content: center;
		bottom:0;
		width:450px;
		right:30px;
		z-index:4;
		color:black;
		background:white;
		border:2px solid $blue;
	}
</style>
