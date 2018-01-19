<template>
	<button type="button"  class="btn" :class="activeClass" 
			  @click="changeClass($event)"
			  :disabled="isActive">
				{{ text|title }}
	</button>
</template>
<script>
	import Confirmation from "../Confirmation";

	export default
	{
		props:["text","isActive","index","confirmation"],

		methods:{

			changeClass(event)
			{

				if (this.isActive) {
					return ;
				}

				if (this.confirmation) {

					Confirmation.confirm("Confirm",this.confirmation)
					.then(()=>{
						this.$emit("changedIndex", this.index);
					}).catch(()=>{

					});
				}
			}
		},
		computed:{
			activeClass()
			{
				if(this.isActive){
					return "btn-outline-info btn-thick";
				}
				return "btn-outline-secondary bg-white";
			}
		}

	}
</script>
<style lang="scss">
	@import "resources/assets/sass/colors";
	.btn.btn-thick
	{
		

		border-width: 5px;

		font-size:23px;
		font-weight:600;
		
		&:disabled {
			cursor:  not-allowed;
			opacity:1;
			
		}
	}

</style>