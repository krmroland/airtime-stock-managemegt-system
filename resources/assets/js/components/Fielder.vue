<template>
	<hoverable>
		<div class="box m-2">
			<div class="d-flex  align-items-center  text-center">
				<img :src="data.imagePath" alt="" class="img-fluid img-thumbnail rounded-circle">
				<div class="m-auto">
					<p class="h5"><strong>Name</strong></p>
					<p class="h5">{{ data.name|title }}</p>
				</div>
				<div class="m-auto">
					<p class="h5"><strong>Phone Number</strong></p>
					<p class="h5">{{ data.phoneNumber }}</p>
				</div>
				<div class="m-auto">
					<p class="h5"><strong>Account Balance</strong></p>
					<p class="h5">{{ data.balance|currency }}</p>
				</div>
				<div class="mr-1" v-if="showDetails">
					<p class="h5"><span class="fa fa-info fa-2x text-grey"></span></p>
					<a :href="'/fielders/'+data.fielder_id">Details</a>
				</div>
			</div>
		</div>
	</hoverable>
</template>
<script>
	export default{

		props: {
			data:{

			},
			showDetails:{
				default:true
			}
		},
	}
</script>