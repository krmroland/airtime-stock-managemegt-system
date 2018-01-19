<template>
		<input type="text" class="form-control" ref="input">
</template>

<script>
const Flatpickr = require("flatpickr");
	export default
	{
		props:{
			label:{
				default:"Select A Month and A year"
			}
		},
		mounted()
		{
			new Flatpickr(this.$el,{
				mode:"single",
				dateFormat:"F,Y",
				maxDate:"today",
				defaultDate:"today",
				//disable:["July ,2017"],
				onChange:(selectedDates, dateStr, instance)=> {
					this.dispatchEvent();
				  },

			})

			this.dispatchEvent();
		},
		methods:{
			dispatchEvent()
			{
				let date =this.$refs.input.value;
				this.$emit('monthChanged',date);
			}
		}
	}
</script>