var manageProductTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'product/fetchProduct',
		'order': []
	});
}); 

function editProduct(productId = null) {

	if(productId) {
		$("#productId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: 'product/fetchSelectedProduct',
			type: 'post',
			data: {
				productId: productId,
				editProductinfo : "yes"
			},
			dataType: 'json',
			success:function(response) {	
				
				console.log(response);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getProductImage").attr('src', 'stock/'+response.product_image);

				$("#editProductImage").fileinput({		      
				});  

				$("#editProductImage").fileinput({
					overwriteInitial: true,
					maxFileSize: 2500,
					showClose: false,
					showCaption: false,
					browseLabel: '',
					removeLabel: '',
					browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
					removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
					removeTitle: 'Cancel or reset changes',
					elErrorContainer: '#kv-avatar-errors-1',
					msgErrorClass: 'alert alert-block alert-danger',
					defaultPreviewContent: '<img src="stock/'+response.product_image+'" alt="Profile Image" style="width:100%;">',
					layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
					allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				});  

				// product id 
				$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				$(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				
				// product name
				$("#editProductName").val(response.product_name);
				// quantity
				$("#editQuantity").val(response.quantity);
				// price
				$("#editRate").val(response.selling_price);
				// brand name
				$("#editBrandName").val(response.brand_id);
				// category name
				$("#editCategoryName").val(response.categories_id);
				// status
				$("#editProductStatus").val(response.active);

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function

// remove product 
function removeProduct(productId = null) {
	if(productId) {
		$("#removeProductForm").append('<input type="hidden" name="removeProductId" id="removeProductId" value="'+productId+'" />');				

	} else {
		alert('error!! Refresh the page again');
	}
} 
