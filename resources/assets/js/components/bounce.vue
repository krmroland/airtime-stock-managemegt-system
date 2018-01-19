<template>
	<transition :enter-active-class="enterClass" :leave-active-class="leaveClass">
		<slot></slot>
	</transition>
</template>
<script>
	export default{

		props:{
			direction:{
				default:"right",
			}
		},
		data()
		{
			return {
				formatedDirection:_.capitalize(this.direction).trim()
			}
		},
		
		computed:
		{

			enterClass()
			{
				return 'animated bounceIn'+this.formatedDirection;
			},
			leaveClass()
			{

				return 'animated bounceOut'+this.formatedDirection;

			}

		}
	}
</script>