<template>
	<component :is="type" 
				:denominations="denominations" 
				:percentage="percentage"
				:network="network"

				>
		
	</component>
</template>


<script>
	import WithSerialNumbers from "./WithSerialNumbers";
	import WithOutSerialNumbers from "./WithOutSerialNumbers";
	export default{
		components:{WithSerialNumbers,WithOutSerialNumbers},

		props:["network","denominations","percentage","type"],

	}

</script>