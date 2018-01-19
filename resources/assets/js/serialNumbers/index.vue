<template>
	<div class="form-group" :class="{hasDanger :errors.present}">
		<label for="serial">Type in the serial number to begin the search</label >
			<input type="number" class="form-control" placeholder="Type in the serial number" v-model.number="serial" ref="serialInput">
			<ul class="list-group d-flex" v-if="indicatorPresent">
			<li class="list-group-item is-10 text-white 
					justify-content-center bg-primary 

				" 
					v-html="searchIndicator">
				
			</li>
			</ul>
			<bounce>
				<ul class="list-group" v-if="availableResults">
					<a href="#" class="list-group-item p-2 link-item bg-faded" @click.once="updateInput(result.denomination_id)"  v-for="result in results">
						<i class="fa fa-check text-success fa-2x"></i>
						<p class="h6 display-5">
							<span class="is-10 ml-2 text-">
							
								{{ result.denomination_name|capitalize|title }} 
							</span>
							<span class="text-info ml-2 font-weight-bold font-italic">
								( {{result.serial}})
							</span>
						</p>
							
						
					</a>
				</ul>
			</bounce>
			<div v-if="errors.present" v-text="errors.text" class="form-text text-danger">
			</div>
			<bounce>
				<div  v-if="responseSerial" v-html="responseSerial">
				</div>
			</bounce>
		</div>
	</template>
	<script>
		import Search from "../search";


		export default Search.extend({

			data()
			{
				return{
					serial:'',

					errors:{
						present:false,
						text:''
					},
					searchHtml:`<span class="ml-3">
							<i class="fa fa-yelp fa-2x"></i>
							Looking Up from the serial numbers table
						</span>`,
					responseSerial:''
				}
			},

			methods:{

				fetchSerials:  _.debounce((vm)=>{
					vm.searchSerials();
				},500),

				searchSerials()
				{
					this.
					setIndaicator(`${this.processingIcon} ${this.searchHtml}`);
					this.responseSerial=false;
					this.errors.present=false;

					axios.get("/serials?serial="+this.serial).then(({data})=>{
						
						if(!_.isEmpty(data)){
		 				this.results=data;
		 				this.availableResults=true;
		 				this.unSetIndicator();
		 				return true;
		 			}
		 			this.availableResults=false;
		 			this.results={};
		 			this.setIndaicator("No Matches found");
					}).catch(()=>{
						this.availableResults=false;
						this.results={};
						this.setIndaicator(`<p class="text-white">
								 <i class="fa fa-info "></i>
			
								 Please type in a serial Number
								</p>
								`);
					});
				},

				setIndaicator(message)
				{
					this.searchIndicator=message;

					this.indicatorPresent=true;
				},
				unSetIndicator()
				{
					this.searchIndicator=null;

					this.indicatorPresent=false;
				},

				updateInput(denomination_id)
				{
					this.availableResults=false;
					this.setIndaicator(`<span class="ml-3">
												<i class="fa fa-refresh fa-2x fa-spin"></i>
												Now fetching the selected serial number details
											</span>`);
					axios.get(`/serials/${denomination_id}`).then(({data})=>{
						this.responseSerial=data;


					}).catch(()=>{
						this.errors.text="Something went wrong in the process! try again";
						this.errors.present=true;
					})

					this.unSetIndicator();
				}


			},
			watch:{
				serial(newSerial,previousSerial){
					this.setIndaicator(`
						${this.processingIcon}
						<span class='ml-5'>waiting for you to finish typying</span>
						`);
					this.fetchSerials(this);
				}
			}
		})
	</script>