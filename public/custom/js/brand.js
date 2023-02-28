var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'brand/fetch_brand',
		'order': []		
	});

});

function editBrands(brandId = null) {
	if(brandId) {

		//remove hidden brand id text
		$('#editBrandId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		//$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		 $('.edit-brand-result').addClass('div-hide');
		// // modal footer
		 $('.editBrandFooter').addClass('div-hide');

		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			
			url: 'brand/fetchSelectedBrand',
			type: 'post',
			data: {
				brandId : brandId
			},
			dataType: 'json',
			success:function(response) {

				//hide  modal loading
				$('.modal-loading').addClass('div-hide');
				// add modal result
				$('.edit-brand-result').removeClass('div-hide');
				// add  modal footer
				$('.editBrandFooter').removeClass('div-hide');

				$('#editBrandId').val(brandId);

				$("#editBrandName").val(response.brand_name);
				var option = response.brand_active;
				//console.log($("#editBrandStatus option:eq(2)"))
				$('#editBrandActiveStatus option:eq('+option+')').attr('selected', true);

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} 

function removeBrands(brandId = null){
	if(brandId) {
		$('#removeBrandId').val(brandId);
	} else {
		alert('error!! Refresh the page again');
	}
}