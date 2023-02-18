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
		$('#brandId').remove();

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
				
				//console.log(response);
				//console.log(response.brand_name);
				$("#editBrandName").val(response.brand_name);
				var option = response.brand_active;
				//console.log($("#editBrandStatus option:eq(2)"))
				$('#editBrandStatus option:eq('+option+')').attr('selected', true);

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

// function removeBrands(brandId = null) {
// 	if(brandId) {
// 		$('#removeBrandId').remove();
// 		$.ajax({
// 			url: 'php_action/fetchSelectedBrand.php',
// 			type: 'post',
// 			data: {brandId : brandId},
// 			dataType: 'json',
// 			success:function(response) {
// 				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.brand_id+'" /> ');

// 				// click on remove button to remove the brand
// 				$("#removeBrandBtn").unbind('click').bind('click', function() {
// 					// button loading
// 					$("#removeBrandBtn").button('loading');

// 					$.ajax({
// 						url: 'php_action/removeBrand.php',
// 						type: 'post',
// 						data: {brandId : brandId},
// 						dataType: 'json',
// 						success:function(response) {
// 							console.log(response);
// 							// button loading
// 							$("#removeBrandBtn").button('reset');
// 							if(response.success == true) {

// 								// hide the remove modal 
// 								$('#removeMemberModal').modal('hide');

// 								// reload the brand table 
// 								manageBrandTable.ajax.reload(null, false);
								
// 								$('.remove-messages').html('<div class="alert alert-success">'+
// 			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
// 			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
// 			          '</div>');

// 			  	  			$(".alert-success").delay(500).show(10, function() {
// 										$(this).delay(3000).hide(10, function() {
// 											$(this).remove();
// 										});
// 									}); // /.alert
// 							} else {

// 							} // /else
// 						} // /response messages
// 					}); // /ajax function to remove the brand

// 				}); // /click on remove button to remove the brand

// 			} // /success
// 		}); // /ajax

// 		$('.removeBrandFooter').after();
// 	} else {
// 		alert('error!! Refresh the page again');
// 	}
// } // /remove brands function