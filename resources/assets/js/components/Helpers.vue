<script>

	import numeral from "numeral";
	import moment from "moment";
	export default Vue.mixin({

		data()
		{
			return {
				token:window.lawma.csrf_token,
			}
		},
		filters:{
			capitalize(value){
				return _.capitalize(value);
			},

			title(value){
				return _.startCase(value);
			},
			currency(value){
			 return numeral(value).format();;
			},

			formatDate(date){
			 date=moment(date);
				return date.format("Do MMMM YYYY") +' ( Since ' +date.fromNow()+')';
			},
			json(value)
			{
				return JSON.stringify(value);
			}
		},

		methods:
		{
			numberFormat(number)
			{
				return numeral(number).format();
			},

			numeral(number)
			{
				return numeral(number).value();
			}
		}
	})
</script>