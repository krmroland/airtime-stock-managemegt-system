<template>
	
	<div class="img-fluid "></div>

</template>
<script>


	export default
	{
		props:["title","brand","data"],

		mounted()
		{

			Highcharts.chart(this.$el, {
				chart: {

		    	 type: 'pie',

		    	},
		    	title: {
		    		text:this.$options.filters.capitalize(this.title)
		    	},
		    	tooltip: {
		    		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    	},
		    	plotOptions: {
		    		pie: {
		    			allowPointSelect: true,
		    			cursor: 'pointer',
		    			dataLabels: {
		    				enabled: true,
		    				format: '<b>{point.name}</b>: {point.percentage:.1f} %',

		    			},
		    			showInLegend: true
		    		}
		    	},
		    	series: [{
		    		name: this.brand,
		    		colorByPoint: true,
		    		data: this.data
		    	}]
		    });
		}
	}
</script>