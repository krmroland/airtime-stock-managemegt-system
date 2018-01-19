import "./bootstrap";


import helpers from "./components/Helpers";

window.Highcharts =require("highcharts");

Highcharts.setOptions({
	chart: {
		spacingLeft: 0,

	},
	colors: ["#CCFF66", '#6600FF', '#3B9E4D', '#FF0066', '#FF6666'],
	
	credits:{
		enabled:false
	}

});


Vue.component('flash', require('./components/Flash.vue'));

Vue.component('hoverable', require('./components/hoverable.vue'));

Vue.component("fielder", require('./components/Fielder.vue'));
Vue.component("bounce", require("./components/bounce.vue"));

Vue.component("clock",require('./components/clock'));

Vue.component("StatementGenerator",require("./statements/Generator.vue"));

Vue.component("FielderSelector",require("./components/FielderSelector.vue"));
//Vue.component("fielders",require("./fielders/index.vue"));





Vue.component("DailyReport",require("./reports/daily/report"));

Vue.component("stock",require("./components/stock"));

//Vue.component("StockForm", require('./stock/form.vue'));

Vue.component("PaymentForm", require('./components/PaymentForm.vue'));

//Vue.component("StockPurchaseForm",require('./stock/StockPurchaseForm.vue'))

Vue.component("ConfigurationForm", require('./components/ConfigurationForm.vue'));

Vue.component("SerialNumber",require("./serialNumbers/index"));

Vue.component("HomePage",require("./pages/Home"));




Vue.component("vue-table",require("./tables/VueTable"));

Vue.component("table-cell",require("./tables/TableCell"));

Vue.component('zoom', require('./components/Zoom.vue'));

const app = new Vue({
	el: '#app',

	mixins:[helpers]
});
