<template>
	<div v-if="percentages" >
		<h5 class="text-center">Loading Mechanism</h5>
		<div class="text-center">
			<switchery :options="['WithSerialNumbers','WithOutSerialNumbers']" 
			@onSwitched="swapMechanism"
			confirmation="Be informed all you stock changes will be lost"
			>

		</switchery>
	</div>
	<template v-for="network in networks">
		<Network :network="network" :percentage="percentages[network]" :type="loadingType"
		:denominations="denominations">
	</Network>
</template>
</div>
</template>
<script>
	import Network from "./networks/Network";
	
	import switchery from "../components/switchery";

	import store from "./Store";

	export default{

		components:{Network,switchery},

		props:["percentages"],

		beforeCreate()
		{
			axios.post("/loadingDetails").then(({data})=>{
				this.networks=data.networks;
				this.denominations=data.denominations;
			})
		},
		data()
		{
			return {
				denominations:{},
				networks:{},
				loadingType:'WithSerialNumbers',
				store
			}
		},
		methods:{
			swapMechanism(type)
			{
				this.loadingType=type;
				store.refresh();
			}
		}
	}
</script>