
import pie from "../charts/Pie";

import moment from "moment";

import processing from "../components/processing";


export default Vue.extend({

	components:{pie,processing,
		CommonReport:{
			props:["isProcessing","description","formatedDate"],

			template:`
				<div>
					<h3 class="text-center display-5 text-underlined text-info">
						{{formatedDate|capitalize}}
					</h3>
					<processing :isProcessing="isProcessing" :description="description">
					</processing>
				</div>
			`,
			components:{processing},

	}},

	mounted()
	{

		this.fetchData();
	},

	data()
	{
		return {
			isFetching:false,

			data:false,
			errors:false,
			url:"/reports",
			description:'Fetching Data'
			
		}

	},

	methods:{
		fetchData()
		{
			this.errors=false;
			this.isFetching=true;

			this.data=false;

			let date=this.date;

			let type=this.type?this.type:'general';

			axios.post(this.url,{type,date}).then(response=>this.showResults(response))

			.catch(errors=>this.showErrors(errors));

		}
		,
		showResults(response)
		{
			this.errors=false;
			this.isFetching=false;
			this.data=response.data;
		}
		,
		showErrors()
		{
			this.isFetching=false;
			this.errors=true;

		}
	},
	computed:{
		notEmptyData()
		{
			
		},

		formatedDate()
		{
			if (this.date.includes("to")) {
				return `Showing results from ${this.date}`;
			}
			let date=moment(this.date);

			return date.format("Do MMMM YYYY") +' ( Since ' +date.fromNow()+')';
		}

	},
	watch:{
		date(){
			this.fetchData();
		}
	}


})