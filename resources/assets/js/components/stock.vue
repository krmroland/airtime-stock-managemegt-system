<template>
	
	<form action="/stock" method="post" @submit.prevent="onSubmit" >
		<input type="hidden" name="_token" v-model="token">
		<input type="hidden" :value="formData" name="data">
		<component :is="type"></component>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-save"></i>
				Process And Submit Stock
			</button>
		</div>
		<div class="alert grand-total">
			The Net Value is :{{store.overollNet|currency}}
		</div>
	</form>

</template>

<script>

	import loading from "../stock/loading";

	import purchasing from "../stock/purchasing";

	import store from "../stock/Store";

	import Confirmation from "../Confirmation";


	export default{
		props:["type"],

		components:{loading,purchasing},

		data()
		{
			return  {
				store,
			}
			
		},

		mounted()
		{
			window.onbeforeunload=()=>'Are you sure you want to leave';

		},
		methods:{
			onSubmit()
			{
				if(this.store.overollNet<1){

					flash("Dont you think You have to add some values to proceed","question");
					return;
				}

				Confirmation.confirm("Proceed","Stock changes will be persisted to the database").then(()=>this.$el.submit()).catch((error)=>{})

			},
		},
		computed:{
			formData()
			{
				let data=this.store.$data;

				data['stockValue']=this.store.overollNet;

				return JSON.stringify(data);
			}
		}
		
	}
</script>