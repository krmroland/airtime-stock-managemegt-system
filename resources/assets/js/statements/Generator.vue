<template>
	<div class="card">
		<div class="card-block">
			<h1 class="card-title text-center text-primary display-5">
				Monthly Finacial Statement(s)
			</h1>
			<hr>
			<form action="" method="POST" @submit.prevent="generate">
				<p class="font-italic h4 text-info">Please select a year &amp; a month</p>
				<div class="box">
					<div class="row">
						<div class="col-8">
							<YearMonth @monthChanged="updateDate">

							</YearMonth>
						</div>
						<div class="col-4">
							<button class="btn btn-info btn-block" :disabled="isCompiling">
								Generate Statement
							</button>
						</div>
					</div>

					<processing description="Compiling statement"
					:isProcessing="isCompiling">

				</processing>
				<bounce>
					<div class="alert alert-danger text-center mt-4" 
					v-if="error" v-text="error">
				</div>
			</bounce>
			<bounce>
				<div v-if="message" v-html="message"></div>
			</bounce>
		</div>
	</form>
	<div class="box mt-4 pt-5">
		<h3 class="text-center text-info">Recently Compiled Statements</h3>
		<bounce>
			<table class="table  table-bordered" v-if="dataAvailable">
				<tr class="bg-primary text-white">
					<th>#</th>
					<th>Name</th>
					<th colspan="3" class="text-center">Details</th>
				</tr>
				<tbody>
					<template  v-for="(statement ,index) in items">
						<bounce>
							<tr :key="items.id">
								<td>{{++index}} .</td>
								<td>
									<i class="fa fa-file-pdf-o fa-2x text-info"></i>
									<span class="font-weight-bold text-muted">
										{{ statement.name}}
									</span>
								</td>
								<td>
									<a :href="'/statements/'+statement.id" 
									target="_blank">
									<i class="fa fa-cloud-download fa-2x text-info"></i>
									<span class="font-italic text-primary">
										Download
									</span>
								</a>
							</td>
							<td>
								<a href="":key="items.id" 
								@click.prevent="reGenerate(statement.id)">
								<i class="fa fa-refresh fa-2x text-primary"></i>
								<span class="font-italic text-primary">
									Recompile 
								</span>
							</a>
						</td>
						<td>
							<a href="":key="items.id" 
							@click.prevent="erase(statement.id)">
							<i class="fa fa-trash fa-2x text-danger"></i>
							<span class="font-italic text-primary">
								Delete
							</span>
						</a>
					</td>
				</tr>
			</bounce>
		</template>
		<template v-if="noItems">
			<tr class="bg-faded text-muted text-center h4">
				<td colspan="4" >
					<i class="fa fa-info text-info"></i>
					No  previously Compiled Reports
				</td>
			</tr>
		</template>
	</tbody>
</table>
</bounce>
<paginator :dataSet="dataSet"  @changed="fetchData"></paginator>
</div>



</div>
</div>
</template>
<script>
	import YearMonth from "../components/YearMonth";

	import Confirmation from "../Confirmation";

	import Paginator from "../Paginator";

	import processing from "../components/processing";

	export default Paginator.extend({
		components:{YearMonth,processing},

		data()
		{
			return {
				date:'',
				dataAvailable:true,
				isCompiling:false,
				message:null


			}
		},
		methods:{
			updateDate(date)
			{
				this.date=date;
			},

			generate()
			{
				Confirmation.confirm("Proceed",this.confirmationMessage)
				.then(()=>{this.makeRequest("post","/statements")}).catch(()=>{});
			},
			/**
			 * recompile a statement
			 *
			 * @param      {integer}  id      The identifier
			 */
			 reGenerate(id)
			 {
			 	Confirmation.confirm("Proceed","Recompile Report")
			 	.then(()=>{this.makeRequest("put","/statements/"+id)})
			 	.catch(()=>{});
			 },

			 erase(id)
			 {
			 	Confirmation.confirm("Are you Sure","Report will be deleted")
			 	.then(()=>{this.makeRequest("delete","/statements/"+id)})
			 	.catch(()=>{});
			 },
			 makeRequest(type,url)
			 {
			 	this.isFetching();
			 	axios[type](url,{date:this.date})
			 	.then(({data})=>{
			 		this.fetchData()
			 		this.doneFetching(data)

			 	})
			 	.catch(()=>this.onFailure());
			 },
			 onStart()
			 {

			 },

			 isFetching()
			 {
			 	this.dataAvailable=false;
			 	this.isCompiling=true;
			 	this.message=false;
			 },
			 doneFetching(data)
			 {
			 	this.dataAvailable=true;
			 	this.isCompiling=false;
			 	this.error=null;
			 	this.message=data;
			 },
			 onFailure()
			 {
			 	this.isCompiling=false;
			 	this.error="Something went wrong while processing the request";
			 	this.message=null;
			 }
			},
			computed:{

				noItems()
				{
					return _.isEmpty(this.items);
				},
				confirmationMessage()
				{
					return `<div class="text-center">
					Generate a statement for the month 
					<p class="text-info h4">(${this.date.trim()})</p>
				</div>`;

			}
		}

	})
</script>