<template>
	<div>
		<div v-if="changesDates">
			<date @dateChanged="updateDate" label="Please Select a date"></date>
			<h3 class="text-center display-5 text-underlined text-info">
				{{formatedDate|capitalize}}
			</h3>
		</div>
		<h3 v-else class="text-center text-info display-4">Todays Summary</h3>
		
		<processing :isProcessing="isFetching" :description="description"></processing>
		
		<bounce>
			<div v-if="pieData">
			<div v-for="(denominations,network) in pieData">
							<div class="box">
								<h3 class="text-center">
									Destribution by denomination of how
									<span class="text-info">({{ network|title}}) </span>
									stock is loaded
									
								</h3>
								<pie :title="network" brand="denominations" :data="denominations" v-cloak>
								
								</pie>
							</div>
						</div>
			</div>
		</bounce>

		<div v-if="data">
			<stock :data="data.stock"></stock>
		</div>

		<div class="alert alert-danger text-center" v-if="error">
			<strong>Something went wrong</strong>.
		</div>
	</div>
</template>
<script>


import date from "../../components/date";


 import processing from "../../components/processing";

import stock from "./stock";


import moment from "moment";




	export default{
		props:{changesDates:{default:true}},
		components:{date,processing,stock},
		mounted()
		{
			this.fetchData();
		},

		data()
		{
			return{
				date:moment().format("YYYY-MM-DD"),
				isFetching:false,
				data:false,
				test:`<pie></pie>`,
				error:false,
				pieData:false

			}
		},

		methods:{

			fetchData()
			{
				this.isFetching=true;
				this.htmlTable=false;
				this.error=false;
				axios.post("/reports/daily",{date:this.date}).then(({data})=>{
					this.data=data;
					this.isFetching=false;
				}).catch(()=>{
					this.error=true;
					this.isFetching=false;
				});
				
			},
			updateDate(date)
			{
				this.$set(this.$data,'date',date);
				
			}
		},
		computed:{
	
			description()
			{
				return `Fetching ${this.date} related data`;
			},
			formatedDate()
			{
				let date=moment(this.date);
				return date.format("Do MMMM YYYY") +' ( Since ' +date.fromNow()+')';
			},
			empty()
			{
				return _.isEmpty(this.pieData);
			}
		},
		watch:{
			date()
			{
				this.fetchData();
			}


		}


	}
</script>