export default Vue.extend({

	data()
	{
		return{
			
			"results":{},
			"availableResults":false,
			"searchIndicator":`<i class="fa fa-search"></i>`,
			"indicatorPresent":false,
			"selected":null,
			"processingIcon":`<i class='fa fa-spinner fa-spin fa-2x fa-fw '></i> `,
			"result":''
		}
	}
	,methods:
	{

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
	}


});