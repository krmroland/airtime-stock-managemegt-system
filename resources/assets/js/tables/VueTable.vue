<template>
	<div class="table__compontent box">

		<div class="table__filter mb-2 d-flex justify-content-between">
			<div class="col-md-9">
				<h3 class="text-center text-info">{{title|title}}</h3>
			</div>
			
			<input type="search" 
			class="form-control input col-md-3 table__filter-field"
			v-model="filter"
			:placeholder="placeholder">

		</div>
		<div class="table__main">

			<div class="table__search" v-if="searchText">
				<div class="table__search-overlay pt-2">
					<p>
						<i class="fa fa-spinner fa-spin fa-2x"></i>
						<span class="h4 ml-2">{{ searchText}}......</span>
					</p>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<template v-for="column in columns">
							<th>{{column.label|title}}</th>
						</template>
					</tr>
				</thead>
				<transition enter-active-class="animated bounceInDown" leave-active-class="animated bounceOutUp" appear>
					<tbody v-if="results.length">
						<tr v-for="result in results" class="animated wobble" 
						@click="$emit('rowClicked',result)">
							<template v-for="column in columns">
								<td v-if="column.dataType=='link'" 
									v-html="getTableCell(result,column)"
								>
									
								</td>
								<td v-else>{{getTableCell(result,column)}}</td>
							</template>
						</tr>
					</tbody>
				</transition>

			</table>

			
			<slot></slot>
		</div>
		<zoom>
			<div class="alert alert-info text-center" v-if="!results.length">
				No results were found
			</div>
		</zoom>
	</div>
</template>

<script>

	export default
	{
		created()
		{
			this.columns=this.$children;
			this.fetchData();
		},

		props:{
			perPage:{
				default:100
			},
			endPoint:{
				required:true
			},
			placeholder:{
				default:"Search"
			},
			title:{

			}
		},

		data(){
			return {
				filter:'',
				columns:[],
				searchText:false,
				results:[],
			}
		},
		methods:{
			search:_.debounce(function(){
				this.fetchData();
			},500),
			fetchData()
			{
				this.searchText="Fetching Data";
				axios.get(this.searchUrl).then(({data})=>{
					this.searchText=false;
					this.results=data;
				}).catch(error=>this.searchText=false);

			},
			getTableCell(result,column)
			{
				result=this.processResult(result,column);

				if (column.dataType=="link") {
					return `<a href="${result}">Click for details</a>`;
				}

				if (column.dataType=="currency") {
					result=this.numberFormat(result)
				}



				if (column.prepends) {
					result=column.prepends +result;
				}
				if (column.appends) {
					result=result+ column.appends;
				}



				return result;
			},

			processResult(result,column)
			{
				let dataName=column.dataName;

				if (!dataName) {
					return;
				}
				

				if (!dataName.includes(".")) {

					return result[dataName];
				}

				dataName.split(".").forEach((key)=>{
					result=result[key];
				});
				return result;


				
			}
		},
		computed:{
			searchUrl()
			{
				if (this.endPoint.includes("?")) {
					return `${this.endPoint}&filter=${this.filter}`;
				}
				return `${this.endPoint}?filter=${this.filter}`;
			}

		},
		watch:{
			filter(){
				this.searchText="Waiting for you to finish typing";

				this.search();
			}
		}
	}
</script>
<style lang="scss">
	@import "resources/assets/sass/colors";

	.table__compontent{
		border:3 px solid $gray;
		padding:10px;
		.table__main{
			position: relative;
			display:flex;
			justify-content:center;
			align-items:center;

			
			.table-striped tbody tr:nth-of-type(even) {
			  background-color: rgba(0, 0, 0, 0.05);
			}
			.table-striped tbody tr:nth-of-type(odd) {
			  background-color: inherit;
			}
			.table-hover tbody tr:hover {
			  background-color: lighten($brand-primary,20);
			  color:$white;
			  cursor:pointer;
			}
			
			table th{
				background-color: #e0e0e0;
				color: #999;
				white-space: nowrap;
				font-size: .85em;
			}
			

		}
		.table__search{
			position:absolute;
			z-index:1050;
			background-color:rgba(0,0,0,0.7);
			width:100%;
			height:100%;
			color:$white;
			display:flex;
			align-items:center;
			justify-content:center;
		}
		.table__filter{
			.table__filter-field{
				padding: 0 1.25em 0 .75em;
				height: 2.5em;
				border: solid 2px #e0e0e0;
				border-radius: 2em;
			}
		}
	}

</style>
