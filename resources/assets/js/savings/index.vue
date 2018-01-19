<template>
	<div class="card">
		<div class="card-block">
			<h1 class="card-title text-center text-primary display-5">
				Dsr Monthly Statement  Generator
			</h1>
			<hr>
			<form action="" method="POST" @submit.prevent="generate">

			<div class="row align-items-center">
					<div class="col">
						<h4 class="text-center text-muted">
							Please select A month 
						</h4>
						<div class="box">
							<YearMonth @monthChanged="updateDate"></YearMonth>
						</div>
					</div>
					<div class="col">
					<h4 class="text-center text-muted">
						Select A category
					</h4>
					<div class="text-center box">
						<switchery :options="options" @onSwitched="swapMode"></switchery>
					</div>
						
					</div>

				</div>
				<bounce>
					<div v-if="showFielder" class="card mt-2">
						<div class="card-block">
							<h3 class="text-center text-muted">Select A Paticular Dsr</h3>
							<FielderSelector label="Type in the name of the Dsr" 
							@selected="activateFielder" @unselected="deactivateFielder">
						</FielderSelector>

						<fielder v-if="fielder" :data="fielder"></fielder>
						<div  class="alert alert-info text-center " v-else >
							You have to select a Dsr first to proceed
						</div>
					</div>
				</div>
			</bounce>
			<div v-if="shouldProceed">
				<div class="row">
					<div class="col-md-6 mt-3">
						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-block">
								<i class="fa fa-file-pdf-o"></i>
								Processs statements
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</template>
<script>
	import switchery from "../components/switchery";
	import FielderSelector from "../components/FielderSelector";
	import YearMonth from "../components/YearMonth";
	import Confirmation from "../Confirmation";
	export default
	{
		components:{switchery,FielderSelector,YearMonth},
		data()
		{
			return {
				options:["allDsrs","singleDsr"],
				mode:"allDsrs",
				fielder:null,
				date:false,

			}
		},
		methods:{
			activateFielder(fielder)
			{
				this.fielder=fielder
			},
			deactivateFielder()
			{
				this.fielder=null;
			},
			swapMode(option)
			{
				this.mode=option;
				this.deactivateFielder();
			},
			updateDate(date)
			{
				this.date=date;
			},
			generate()
			{
				Confirmation.confirm("Proceed",this.confirmationMessage)
				.then(()=>{this.makeRequest()}).catch(()=>{});
			},
			makeRequest()
			{
				let config={

				}
				axios.post("/statements",this.formData,config)
			}
		},
		computed:{
			showFielder()
			{
				return (this.mode=="singleDsr");
			},
			shouldProceed()
			{

				if (this.mode=="allDsrs" && this.date) {
					return true;
				}

				if(!_.isEmpty(this.fielder) && this.date){
					return true;
				}

				return false;
			},
			formData()
			{
				let data={date:this.date};
				
				if (this.fielder) {
					data["fielder_id"]=this.fielder.fielder_id;
				  
				}
				return data;
			},
			confirmationMessage()
			{
				let common=`<div class="text-center">Generate a statement for`;

				if (this.mode=="singleDsr") {
				 common= common+ `<p class="h3 text-info">${this.fielder.name}</p>` ;
				}else{
					 common=common+ " every Dsr ";
				}
				return common+ ` 
						for the month 
						<p class="text-info h4">(${this.date.trim()})</p>
						</div>
						`;

			}
		}

	}
</script>