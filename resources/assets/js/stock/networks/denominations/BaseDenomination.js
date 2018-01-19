export default Vue.extend({

	data()
	{
		return{
			errors:{
				present:false,
				text:'',
			},
			quantity:'',
			maximumPieces:100000,
		}
	},

	methods:{
		formatQuantity(number)
		{
			

			let quantity=this.numeral(number);

			if(quantity <=this.maximumPieces){
				return this.addCommas(number);
				
			}

			this.activateErrors(
			`You cant load more than 
				(${this.numberFormat(this.maximumPieces)} pieces) in quantity`);

			this.addCommas( _.toString(quantity).substring(0, 5));

		
			

		},
		addCommas(number)
		{
			this.quantity= this.numeral(number);
			this.$refs.quantityInput.value=this.numberFormat(number);
		},
		activateErrors(error)
		{
			this.errors['present']=true,
			this.errors['text']=error;
			setTimeout(()=>{
				this.errors['present']=false
				this.errors['text']='';
			},3500)
		},
		dispatch(eventName,value)
		{
			window.events.$emit(
				eventName,
				{
					network:this.network,
					denomination:this.weight,
					value
				});
		}

	},
	computed:
	{

		gross()
		{
			let gross=this.quantity*this.weight;
			this.dispatch("grossUpdated",gross);
			return this.numberFormat(gross);
		},
		net(){
			let net =this.quantity*this.weight*( (100-this.percentage)/100);

			this.dispatch("netUpdated",net);

			return this.numberFormat(net);
		}
	}
});