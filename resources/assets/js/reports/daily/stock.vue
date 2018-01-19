<template>
	<div >
		<h1 class=" text-center text-danger">Stock Summary</h1>
		<div class="box">
			<item heading="Opening Balance" :item="data.opening"></item>
			<item heading="Purchased Stock" :item="data.purchased"></item>
			<item heading="Issued Stock" :item="data.loaded"></item>
			<item heading="Closing Balance" :item="data.closing"></item>
		</div>
	</div>
</template>

<script>

	
	import item from "./stock/item";

	export default {

		props:["data"],
		components:{item}
		

	}
</script>