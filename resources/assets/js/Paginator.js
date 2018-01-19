import paginator from "./components/Paginator";

export default Vue.extend({

	components:{paginator},

	data()
	{
		return {
			items:'',
			dataSet:{},
			error:''
		}
	},
	created()
	{
		this.fetchData();
	},

	methods:{

		fetchData(page) {
			axios.get(this.url(page)).then(this.refresh).catch(()=>{
				this.error="Something went wrong while fetching data"
			});
		},

		url(page) {
			if (! page) {
				let query = location.search.match(/page=(\d+)/);

				page = query ? query[1] : 1;
			}


			return `${location.pathname}?page=${page}`;
		},

		refresh({data}) {
			this.dataSet = data;
			this.items = data.data;

		}
	}


})
