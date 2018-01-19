import swal from "sweetalert2";

class Confirmation
{
	static confirm(title='Are you sure', text)
	{
		return new Promise((resolve, reject)=>{
			swal({
				title: title,
				html: text,
				type: 'question',
				showCancelButton: true,
				confirmButtonText: ' Yes !',
				cancelButtonText: 'No, cancel!',
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false
			}).then(()=>resolve(), ()=>reject());
		});
	}
}

export default Confirmation;