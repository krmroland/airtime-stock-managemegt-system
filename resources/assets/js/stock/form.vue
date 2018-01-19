<template >
		
	<form action="/stock" method="post" @submit.prevent="onSubmit" >
		<input type="hidden" name="_token" v-model="token">
		<input type="hidden" v-model="rawJson" name="raw">

		<transactionDetails @fielderSelected="activateLoading" 
		@fielderDeselected="deactivateLoading">

		</transactionDetails>

	<bounce>
		<div v-if="hasPercentages" >
			
			<div class="box text-center">
				<h5 class="text-center">Loading Mechanism</h5>
				<switchery :options="loadingTypes" @onSwitched="swapLoadingType"></switchery>
			</div>
			<template v-for="network in networks">
				<component :is="activeType" :percentage="fielder.loading[network]" 
						:network="network"
						   :grossTotal="grossTotals(network)"
						   :netTotal="netTotals(network)"
						   :denominations="denominations" >
					
				</component>
			</template>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-save"></i>
					Process And Submit Stock
				</button>
			</div>
			<div class="alert grand-total">
				The Net Value is :{{ overollNet|currency }}
			</div>

		</div>
	</bounce>

	
</form>
</template>
<script>

	
	import Confirmation from "../Confirmation";
	import switchery from "../components/switchery";
	import transactionDetails from "../components/transactionDetails";
	import WithSerialNumbers from "./WithSerialNumbers"
	import NoSerialNumbers from "./NoSerialNumbers";
	import BaseStock from "./BaseStock";

	export default BaseStock.extend({
		
		components:{transactionDetails,WithSerialNumbers,switchery,NoSerialNumbers},
		
		

		data(){

			return {
				hasPercentages:false,
				fielder:{},
				isSubmiting:'',
				loadingTypes:['WithSerialNumbers','NoSerialNumbers'],
				activeType:'WithSerialNumbers',
				

			}
		},

		methods:{


			activateLoading(fielder)
			{

				this.hasPercentages=true;
				this.percentages=fielder.loading,
				this.fielder=fielder;
			},
			deactivateLoading()
			{
				this.hasPercentages=false;
				this.fielder=false;

			},
			
			

			swapLoadingType(type)
			{

				Confirmation.confirm("Be Informed","All your stock changes will be discarded")
				.then(()=>this.activeType=type).catch(()=>{});
			},
			

		}
		
	})
</script>
