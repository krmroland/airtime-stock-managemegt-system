<template>

</template>

<script>
    import swal from "sweetalert2";

    export default {

        data()
        {
            return {
                swalType:this.type,
            }
        },
        props: {
            message:{

            },
            type:{
                default:'success'
            }
        },



        created() {

            if (this.message) {
                this.flash(this.message);
            }


            window.events.$on('flash', (data) =>{
                this.swalType=data.type;
                this.flash(data.message);
            });
        },

        methods: {
        flash(message){
            swal({
                //title:"Great",
                text:message,
                type:this.swalType,
                showConfirmButton: true,
                animation: false,
                customClass: 'animated pulse',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false
            });
        }
    }
};
</script>
