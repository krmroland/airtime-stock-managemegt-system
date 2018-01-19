export default Vue.extend({

	props:["isProcessing","name"],

	data()
	{
		return{
			results:{},
			errors:false,
		}

	},
	created()
	{
		this.fetchData();
	},

	methods:{

		fetchData()
		{
			this.$emit('update:isProcessing', true)
			axios.get(`/transactions/data?type=${this.name}`)
				.then((response)=>{
				this.results=response.data;
				this.$emit("update:isProcessing",false);
			}).catch((error)=>{
				this.errors=true;
				
				this.$emit("update:isProcessing",false);
			});

		}
	}
});