<template>
	<div class="card">
		<div class="card-block">
			<div class="row">
				<div class="col-md-6">
					<fielders @selected="onActivated" @unselected="onDeactivated" 
					>
				</fielders>
			</div>

			<div class="col-md-6">
				<date name="date"></date>
			</div>
			</div>
		<bounce>
			<div  v-show="isSelected">
				<fielder :data="fielder"></fielder>
			</div>
		</bounce>
		<bounce>
			<div class="alert alert-info text-center" v-show="!isSelected">
				You have to select a DSR first to proceed
			</div>
		</bounce>
	</div>
	
	
</div>
</template>
<script>

	import fielders from "./FielderSelector";

	import date from "./date";

	export default
	{
		components:{date, fielders},

		data()
		{
			return {
				isSelected:false,
				fielder:{},
			}
		},

		methods:{

			onActivated(fielder)
			{
				this.fielder=fielder;
				this.isSelected=true;
				this.$emit("fielderSelected",fielder);

			},

			onDeactivated()
			{
				this.fielder={};
				this.isSelected=false;
				this.$emit("fielderDeselected");
			}
		}
	}
</script>