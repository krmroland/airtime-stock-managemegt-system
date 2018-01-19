<template>
	<div>
		<div class="form-group" :class="{hasDanger :hasError}">
			<label :for="name" class="h6 font-weight-bold text-info">
				{{ label|capitalize }}
			</label >
				<input type="serach" class="form-control" placeholder="Type in a dsr's name to begin the seaching" v-model="query" ref="queryInput">
				<ul class="list-group" v-if="indicatorPresent">
					<li class="list-group-item is-10 text-black" v-html="searchIndicator"></li>
				</ul>
				<transition enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutDown">
					<ul class="list-group" v-if="availableResults">
						<a href="#" class="list-group-item p-1 link-item " @click.once="updateInput(result)"  v-for="result in results">
							<img :src="result.imagePath"alt="" class="rounded-circle img-small">
							<span class="is-10 ml-2 text-black">{{ result.name }} ({{ result.phoneNumber }})</span>
						</a>
					</ul>
				</transition>
				<div v-if="hasError" v-text="error" class="form-text text-danger"></div>
			</div>

			<input type="hidden" v-model="selected" :name="name">
		</div>
	</div>
</template>


<script>
	import Confirmation from "../Confirmation";
	import Search from "../search";
	export default Search.extend({

		props:{
			fielderId:{
				
			},
			name:{
				default:"fielder_id",

				type:String
			},
			label:{
				type:String,
				default:"Select A DSR"
			},
			error:{
				type:String,
				default:''
			}
			
		},
		/**
		 * when the component is mounted
		 */
		 mounted()
		 {
		 	if(this.fielderId){
		 		this.fetchInitialFielder();
		 	}
		 },

		 data()
		 {
		 	return {
		 		"query":'',
		 		"locked":false,

		 		"shouldChange":true,
		 		
		 	}
		 },
		 methods:{


		 	fetchData:  _.debounce((vm)=>{
		 		vm.requestFielders();
		 	},500),


		 	requestFielders()
		 	{
		 		this.setIndaicator(`${this.processingIcon} Fetching the data`);
		 		this.$emit("unselected");
		 		axios.get(`/fielders/search?q=${this.query}`).then((response)=>{

		 			if(response.data.length>0){
		 				this.results=response.data;
		 				this.availableResults=true;
		 				this.unSetIndicator();
		 				return true;
		 			}
		 			this.availableResults=false;
		 			this.results={};
		 			this.setIndaicator("No Matches found");
		 		});
		 	},
			/**
			 * update the field once the user makes a selection
			 *
			 * @param      {Object}  result  The result
			 */
			 updateInput(result)
			 {

			 	this.locked=true;

			 	this.selected=result.fielder_id;

			 	this.availableResults=false;

			 	this.unSetIndicator();

			 	this.result=`${result.name} (${result.phoneNumber})`;
			 	this.query=this.result;
			 	this.$emit("selected", result);

			 },
			/**
			 * Fetches an initial fielder when the modal is created
			 * 
			 */
			 fetchInitialFielder()
			 {
			 	axios.get(`/fielders/${this.fielderId}`).then((response)=>{
			 		if(response.data)
			 			this.updateInput(response.data);
			 	})
			 }
			},

			watch: {
				query:function(current,previous){


					if(!this.shouldChange){


						Confirmation.confirm("Warning", "Changing this value will make you loose all unsaved data!")
						.then(()=>{

							this.$set(this.$data,"shouldChange",true);
						}).catch(()=>{

							this.$refs.queryInput.value=this.result;

							this.$set(this.$data,"shouldChange",false);
						});

						return

					}

					this.availableResults=false;
				//if we are not locked, we will set the indicator and fetch the data
				//other wise the user selected a value so we shouldn t refetch (locked)

				if(!this.locked){
					this.setIndaicator(`
						${this.processingIcon}
						<span class='ml-5'>waiting for you to finish typying</span>
						`);
					this.fetchData(this);

					return ;

				}

				if(this.locked){

					this.shouldChange=false;

					this.locked=false;

				}
				
			}
		},
		computed:{
			hasError()
			{
				if(this.error.trim()){
					return true;
				}
				return false;
			}
		}

	})
</script>

<style lang="scss" scopped>
	@import "resources/assets/sass/colors";
	.link-item{
		&:hover{
			background:#eee;
		}
		

	}

</style>