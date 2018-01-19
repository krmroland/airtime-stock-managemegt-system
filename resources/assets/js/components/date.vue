<template>
	<div class="form-group" :class="{ hasDanger: hasError }">
		<label  :for="name" class="h6 font-weight-bold text-info">{{ label| title }}</label>
		<input type="text" :name="name"  class="form-control flatpickr" :placeholder="placeholder" v-model="date" ref="input">

		<p class="form-text text-danger" v-if="hasError" v-text="errorText">

		</p>
	</div>
	
</template>

<script>
	const Flatpickr = require("flatpickr");
	
	import moment from "moment";



	export default {

		props:{
			label:{
				default:"Select a date"
			},
			name:{
				type:String,
				default:'date'
			},
			
			mode:{
				type:String,
				default:"single"
			},
			placeholder:{
				type:String,
				default:this.name
			},
			error:{
				type:String,
				default:''
			}
		}
		,

		mounted()
		{

			this.activateCalendar();

		},
		data()
		{
			return {
				errorText:false,
			}
		}
		,methods:{
			activateCalendar()
			{
				new Flatpickr(this.$refs.input,{
					mode:this.mode,
					dateFormat:"Y-m-d",
					maxDate:moment().format("YYYY-MM-DD"),
					defaultDate:this.date,
					onChange:(selectedDates, dateStr, instance)=> {
						let date =this.$refs.input.value;

						if(this.mode=="single"){

							this.$emit('dateChanged',date);
							return 
						}
						if (this.mode=="range") {
							if(date.includes("to")){

								this.$emit('dateChanged',date);
							}
						}
					  },

				})
			}
		}
		,
		computed:
		{
			date()
			{
				return this.defaultDate;
			},
			hasError()
			{
				if(this.error)
				{
					this.errorText=this.error;

					return true;
				}

				return false;
			},
			defaultDate()
			{
			

					if (this.mode=="single") {
						return  moment().format("YYYY-MM-DD");
					}
					
				return  moment().subtract(7,"days").format("YYYY-MM-DD")+" to "+ moment().format("YYYY-MM-DD")
				
			}
		},

		watch:{
			mode()
			{
				this.activateCalendar();

				this.$emit('dateChanged',this.defaultDate);
			}
		}

		

	}
</script>

