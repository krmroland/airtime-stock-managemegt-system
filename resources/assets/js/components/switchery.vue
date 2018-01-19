<template>
	<div>
		<div class="btn-group" v-for="(option,index) in options">
			<btn :text="option" :isActive="isActive(index)":index="index" 
				@changedIndex="changeIndex"
				:confirmation="confirmation"

				>
			</btn>
		</div>
	</div>
</template>
<script>

	import btn from "./TogglableButton";

	export default
	{
		components:{btn},

		props:{

			options:{
				default:function(){

					return [];
				},
			},
			confirmation:{
				defualt:false
			}
		},
		data()
		{

			return{
				currentIndex:0,
			}
		},
		methods:
		{
			isActive(index)
			{
				if(index==this.currentIndex){
					return true;
				}
				return false;
			},

			changeIndex(index)
			{
				if(this.currentIndex==index){

					return;
				}

				this.$emit("onSwitched",this.options[index]);

				this.currentIndex=index;

				
			}
		}
	}
</script>
<style>

</style>