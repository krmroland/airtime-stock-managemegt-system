<template>
		<div class="d-flex align-items-center justify-content-center p-2" v-if="isProcessing">
			<h5><i class="fa fa-spinner fa-spin fa-2x text-info"></i></h5>
			<h2 class="ml-2 text-muted">{{description|title}} .........</h2>
		</div>
</template>
<script>
	export default{
		props:{
			isProcessing:{
				default:false,
			},

			description:{
				default:"Processing"
			}
		}
	}
</script>