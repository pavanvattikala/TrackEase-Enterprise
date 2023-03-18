$(document).ready(function() {
	// top bar active
    $('select').selectpicker();

	$('#navDaySheet').addClass('active');
    getactivites();
	
});

function getactivites() { 
    //location.reload();

    var fromDate =  $('#fromOrderDate').val();

    var toDate =   $('#toOrderDate').val();

    if(fromDate > toDate){
        alert('Dates are wrong');
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/daysheet/fetchdata',
        type: 'post',
        data: {
            fromDate : fromDate,
            toDate : toDate
        },
        dataType: 'json',
        success:function(response) {
            //console.log(response);
            manageOrderTable = $("#manageDaySheetTable").DataTable({
            data: response,
            
            });
            destroyActivites(manageOrderTable);
        } 
    }); 
 }

 function destroyActivites(manageOrderTable) {

    var totalSum =0;
            var d =manageOrderTable.column(1).data();
            for( i=0;i<d.length;i++){
                totalSum+=Number(d[i]);
            }
            console.log(totalSum);
            $('#manageDaySheetTable tfoot tr:last').remove();
            $("#manageDaySheetTable").append($('<tfoot/>').append('<tr><td><b>Total</b></td><td><b>'+totalSum+'</b></td><td></td></tr>'));
            

            manageOrderTable.destroy();
   }