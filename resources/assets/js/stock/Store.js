export default new Vue({
	data()
	{
		return {
			grossTotals:{},

			grossTotal:{},

			netTotals:{},

			netTotal:{},

			quantities:{},

			serials:{},

		}
	},
	methods:{
		setProperty(property,network,weight,value){

			if(!this[property].hasOwnProperty(network)){
				this[property][network]={};
			}
			this.$set(this[property][network],weight,value);
		},

		setNetTotals:function(network,weight,value)
		{
			this.setProperty("netTotals",network,weight,value);

			let total= _.sum(_.values(this.netTotals[network]));

			this.$set(this.netTotal,network,total);

		},

		setGrossTotals:function(network,weight,value)
		{
			this.setProperty("grossTotals",network,weight,value);
			let total=_.sum(_.values(this.grossTotals[network]));
			this.$set(this.grossTotal,network,total);
		},
		refresh()
		{
			this.$set(this.$data,'grossTotals',{});
;
			this.$set(this.$data,'grossTotal',{});

			this.$set(this.$data,'netTotals',{});

			this.$set(this.$data,'netTotal',{});

			this.$set(this.$data,'quantities',{});

			this.$set(this.$data,'serials',{});
		}

	},
	computed:{

		overollNet()
		{
			return _.sum(_.values(this.netTotal));
		}
	}
});