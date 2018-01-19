<template>
	<div>
		<date name="Select A Date To Generate The Report" 
			v-if="selectDate" @dateChanged="updateDate">
			
		</date>

			<processing :isProcessing="isFetching" description="Fetching Daily Data">
				
			</processing>
		<div class="alert alert-danger text-center" v-if="errors">
			<p class="h5">Something went wrong</p>
		</div>
		<bounce>
			<div v-if="data" >
				<h2 class="text-center text-info">
					<u>Showing Results for {{ formatedDate }} </u>
				</h2>
				<overview :stock="data.stock" :payments="data.payments"></overview>
				<div class="card mt-3" v-if="notEmptyData">
					<div class="card-block">
						<h4 class="card-title text-center">Charts Showing the stock Denomination Distribution</h4>
						<div v-for="(denominations,network) in data.stock.grossTotalSeries">
							<div class="box">
								<pie :title="network" brand="denominations" :data="denominations" v-cloak></pie>
							</div>
						</div>
						<div class="card mt-2">
							<div class="card-block">
								<h4 class="card-title text-center">Denominations Table</h4>
								<div v-for="(network ,name) in data.stock.networks">
									<h4 class="text-center text-info">{{ name|capitalize}}</h4>
									<networkDenominationTable 
									:network="network"
									:totals="data.stock.networkTotals[name]">
			
								</networkDenominationTable>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-else class="alert alert-success text-center">
				<p class="h6">No Data is available for the date {{ date }}</p>
			</div>
					</div>
		</bounce>
</div>
</div>
</template>
<script>
	import date from "../components/date";

	import overview from "./daily/overview";
	
	import networkDenominationTable from "../components/networkDenominationTable";

	import processing from "../components/processing";

	import Report from "./BaseReport";

	import moment from "moment";

	export default Report.extend({
		components:{date,overview,networkDenominationTable,processing},

		props:{
			selectDate:{
				default:true
			}
		},

		data(){

			return {
				report:{
					date:moment().format("YYYY-MM-DD"),
				}
				
			}
		},

		
		methods:
		{
			
		},
		computed:{
			url()
			{
				return `/reports/all/?date=${this.date}`;
			}

		}

	})
</script>