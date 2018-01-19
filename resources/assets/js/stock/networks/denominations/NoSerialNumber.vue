<template>

	<div class="form-group m-0">
		<div class="input-group m-0">
			<!-- denomination name -->
			<input type="text" class="form-control"  :value="name|title" disabled="">
			<!-- peices -->
			<input type="text" class="form-control "   @input.lazy="formatQuantity($event.target.value)" ref="quantityInput">
			
			<!-- Gross -->
			<input type="text" class="form-control"  disabled=""
			v-model="gross">
			<!-- Net -->
			<input type="text" class="form-control"  disabled="" v-model="net">

		</div>

		<bounce>
			<div v-show="errors.present" v-text="errors.text" class="form-text stockError"></div>
		</bounce>
	</div>

</template>
<script>

import BaseDenomination from "./BaseDenomination";

	export default BaseDenomination.extend({
		
		props:["name","percentage","weight","network"],

	});
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