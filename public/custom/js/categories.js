var manageCategoriesTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageCategoriesTable = $('#manageCategoriesTable').DataTable({
		'ajax' : 'category/fetchCategories',
		'order': []
	}); // manage categories Data Table
}); // /document

// edit categories function
function editCategories(categoriesId = null) {
	if(categoriesId) {
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});


		$.ajax({
			url: 'category/fetchSelectedCategories',
			type: 'post',
			data: {
				categoriesId: categoriesId
			},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooter").removeClass('div-hide');	

				console.log(response);

				// set the categories name
				$("#editCategoriesName").val(response.categories_name);
				// set the categories status
				$("#editCategoriesStatus").val(response.categories_active);


			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// remove categories function
// function removeCategories(categoriesId = null) {
		
// 	$.ajax({
// 		url: 'php_action/fetchSelectedCategories.php',
// 		type: 'post',
// 		data: {categoriesId: categoriesId},
// 		dataType: 'json',
// 		success:function(response) {			

// 			// remove categories btn clicked to remove the categories function
// 			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
// 				// remove categories btn
// 				$("#removeCategoriesBtn").button('loading');

// 				$.ajax({
// 					url: 'php_action/removeCategories.php',
// 					type: 'post',
// 					data: {categoriesId: categoriesId},
// 					dataType: 'json',
// 					success:function(response) {
// 						if(response.success == true) {
//  							// remove categories btn
// 							$("#removeCategoriesBtn").button('reset');
// 							// close the modal 
// 							$("#removeCategoriesModal").modal('hide');
// 							// update the manage categories table
// 							manageCategoriesTable.ajax.reload(null, false);
// 							// udpate the messages
// 							$('.remove-messages').html('<div class="alert alert-success">'+
// 	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
// 	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
// 		          '</div>');

// 	  	  			$(".alert-success").delay(500).show(10, function() {
// 								$(this).delay(3000).hide(10, function() {
// 									$(this).remove();
// 								});
// 							}); // /.alert
//  						} else {
//  							// close the modal 
// 							$("#removeCategoriesModal").modal('hide');

//  							// udpate the messages
// 							$('.remove-messages').html('<div class="alert alert-success">'+
// 	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
// 	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
// 		          '</div>');

// 	  	  			$(".alert-success").delay(500).show(10, function() {
// 								$(this).delay(3000).hide(10, function() {
// 									$(this).remove();
// 								});
// 							}); // /.alert
//  						} // /else
						
						
// 					} // /success function
// 				}); // /ajax function request server to remove the categories data
// 			}); // /remove categories btn clicked to remove the categories function

// 		} // /response
// 	}); // /ajax function to fetch the categories data
// } // remove categories function