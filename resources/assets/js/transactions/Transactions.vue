<template>
	<div>
	<div class="card">
		<div class="card-block">
			<h2 class="card-title text-center">Transactional Histories</h2>
			<processing :isProcessing="isProcessing" description="Fetching Data">
				
			</processing>
			<div class="box text-center">
				<switchery :options="transactionTypes" @onSwitched="swapTransaction">
					
				</switchery>
			</div>
			<component :is="currentTransaction" 
					   :isProcessing.sync="isProcessing" 
					   :name="currentTransaction">
				
			</component>
			
		</div>
	</div>
		
	</div>
</template>
<script>
	import switchery from "../components/switchery";
	import stock from "./StockTransactions";
	import payments from "./PaymentTransactions";
	import processing from "../components/processing";

	export default {
		components:{switchery,stock,payments,processing},
		props:{
			selected:{
				default:'stock'
			}
		},

		data(){
			return{
				transactionTypes:["stock","payments"],
				currentTransaction:this.selected,
				isProcessing:false
			}
		},

		
		methods:{
			swapTransaction(selection)
			{
				this.currentTransaction=selection;
			}
		}
	}
</script>