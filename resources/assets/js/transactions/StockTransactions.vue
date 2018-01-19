<template>
	<div class="card">
		<div class="card-block">
			<h4 class="card-title text-center">Stock Transactions</h4>
			<div v-for="stock in results.data">
				<component :is="stock.description" :data="stock"></component>
			</div>
		</div>
		
	</div>
</template>
<script>
import BaseTransaction from "./BaseTransaction";

import date from "../components/date";

import issued from "./stock/issued";

import purchase from "./stock/purchases";


	export default BaseTransaction.extend({

		components:{date,issued,purchase},

		data()
		{
			return {

			}
		}
	});
</script>