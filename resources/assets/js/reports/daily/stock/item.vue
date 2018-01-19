<template>
	<div>
		<h3 class="text-center mt-2 text-primary text-underlined">
			{{heading|title}}
		</h3>
		<div class="box mt-3">
			<div v-if="emptyCollection">
				<div class="alert alert-danger text-center h6">
					<strong>No data captured</strong> 
				</div>
			</div>
			<div v-for="(stats,network) in item">
				<pie :title="network" brand="denominations" :data="stats['pie']"></pie>
				<stockTable :denominations="stats['table']"></stockTable>
			</div>
		</div>
	</div>
</template>

<script>
import stockTable from "./table";
import pie from "../../../charts/Pie";

	export default
	{
		props:["item", "heading"],
		components:{stockTable,pie},
		computed:{
			emptyCollection()
			{
				return _.isEmpty(this.item);
			}
		}
	}
</script>