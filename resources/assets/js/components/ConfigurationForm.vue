<template>
	<div>
		<hoverable>
			<div class="box">
				<div class="d-flex  align-items-center  text-center">
					<div class="mr-auto">
						<p class="h5"><strong>Name</strong></p>
						<p class="h5">{{ configuration.name|title }}</p>
					</div>
					<div class="mr-auto">
						<p class="h5"><strong>Purchasing Percentages</strong></p>
						<p class="h5">{{configuration.purchasing_percentages}}</p>
					</div>
					<div class="mr-auto align-items-center">
						<p class="h5"><i class="fa fa-edit"></i></p>
						<a href="#" @click.prevent="edit">Edit</a>
					</div>


				</div>
			</div>
		</hoverable>
		<bounce>
			<form action="" v-if="shouldEdit" @submit.prevent="submitForm">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" class="form-control" v-model="configuration.name">
				</div>
				<div class="form-group">
					<div class="box">
						<label for="">Percentages</label>
						<div class="input-group">
							<template  v-for="(value, name) in configuration.purchasing_percentages">
								
							<label for="" class="col-form-label h3">{{ name|title}}:</label>
								<input type="text" class="form-control" 
								v-model="configuration.purchasing_percentages[name]">
							</template>

						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Edit Configuration
					</button>
				</div>
				<template v-for="(name,key) in errors">
					<p class="form-text text-danger">{{name}}</p>
				</template>
			</form>
			
		</bounce>
	</div>
</template>

<script>
import Confirmation from "../Confirmation";
	export default{

		props:["data"],

		data()
		{
			return{
				shouldEdit:false,
				configuration:this.data,
				errors:{}
			}
			

		},
		methods:{
			edit()
			{
				this.shouldEdit=!this.shouldEdit;
			},
			submitForm()
			{
				this.validateForm();
				if (_.isEmpty(this.errors)) {
					Confirmation.confirm("These Settings will be persisted")
					.then(()=>{
						axios.post("/configurations",{data:this.configuration})
						.then(()=>{
							this.shouldEdit=false;
							this.errors={};
							flash("The edition was success full")
						})
					}).catch(()=>{

					});
					
				}
			},
			validateForm()
			{
				console.log(this.configuration.purchasing_percentages);
				_.values(this.configuration.purchasing_percentages).forEach((value,network)=>{
					console.log(value,network)
					if(value ==0){
						this.$set(this.errors,percentages,` percentage cant be empty`);
					}
					if (value>15) {
						this.$set(this.errors,percentages,` A percentages cant be more than 15`);
					}
				});

				if(this.configuration.name==""){
					this.$set(this.errors,"name","The company name cant be empty");
				}
			}
			
		}



	}
</script>