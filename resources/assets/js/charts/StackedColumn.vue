<template>
	<div class="img-fluid"></div>
</template>

<script>
	export default{
		props:["title","data"],

		data()
		{
			return {
				
			}
		},

		mounted()
		{
			Highcharts.chart(this.$el, {
			    title: {
			        text: 'Stock Summary'
			    },
			    xAxis: {
			        categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
			    },
			    labels: {
			        items: [{
			            html: 'Total network sales',
			            style: {
			                left: '50px',
			                top: '18px',
			                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
			            }
			        }]
			    },
			    series: [{
			        type: 'column',
			        name: 'Jane',
			        data: [3, 2, 1, 3, 4],
			    }, {
			        type: 'column',
			        name: 'John',
			        data: [2, 3, 5, 7, 6]
			    }, {
			        type: 'column',
			        name: 'Joe',
			        data: [4, 3, 3, 9, 0]
			    }, {
			        type: 'spline',
			        name: 'Average',
			        data: [3, 2.67, 3, 6.33, 3.33],
			        marker: {
			            lineWidth: 2,
			            lineColor: Highcharts.getOptions().colors[3],
			            fillColor: 'white'
			        }
			    }, {
			        type: 'pie',
			        name: 'Denomination Composition',
			        data: [{
			            name: 'Jane',
			            y: 13,
			           
			        }, {
			            name: 'John',
			            y: 23,
			            
			        }, {
			            name: 'Joe',
			            y: 19,
			        }],
			        center: [100, 80],
			        size: 100,
			        showInLegend: true,
			        dataLabels: {
			            enabled: true
			        }
			    }]
			});
		}
	}
</script>