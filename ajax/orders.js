'use strict';
var url = 'inc/orders.class.php';
var add = true;
var id = 0;
$(document).ready(function(e) {  
	resetData();
	loadOrders();
	$('.show_submit').hide();
	$("#form_order").submit(function(e) {
        e.preventDefault(); 
        if (true === add) {
        	insertOrder();  
        } 
        else {
        	//alert('asd');
        	updateOrder(); 
        } 
    }); 

    $("#submit_summary").submit(function(e) {
        e.preventDefault();  
        $('.hide_submit').hide(); 
        $('.show_submit').show(); 
		loadOrderSummary();
    });
});

function insertOrder() {   
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url,
        data:{
        	type: 'insert',
            order_type: $('#order_type').find('option:selected').val(),
            order: $("#order").val(), 
        },
    }).done(function(result){
            alert(result.status);
            loadOrders();
   	}); 
}

function updateOrder() {   
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url,
        data:{
        	type: 'update',
        	id: id,
            order_type: $('#order_type').find('option:selected').val(),
            order: $("#order").val(), 
        },
    }).done(function(result){
            alert(result.status);
            loadOrders();
   	}); 
}

function deleteOrder(id){
    if(confirm("Are you sure you want to delete?") == true){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url,
            data:{
            	type: 'delete',
                id: id, 
            }, 
        }).done(function(result){
            alert(result.status);
            loadOrders();
        });
    }
}

function loadOrders() {
	var type = "view";
	$.ajax({
		type: 'GET', 
		data: {type:type},
		url: url,
		success: function(result){ 
			//console.log(result); 
			var tableRow = '';
			$.each(JSON.parse(result), function (key, value) { 
				tableRow += '<tr><td>';
				tableRow += value.type;
				tableRow += '</td><td>';
				tableRow += value.order;
				tableRow += '<td><a href="#" onclick="retrieveData(this); return false" data-id='+ value.id +' data-type='+ value.type +' data-order='+ value.order +' class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
				tableRow += ' <a href="#" onclick="deleteOrder('+value.id+'); return false" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></td>'
				tableRow += '</td> </tr>';  
   			}) 
			$("tbody#data").html(tableRow);
    	}
	})

	$('#form_order')[0].reset();
    add = true;
}

function retrieveData(data) { 
	add = false; 
	id = data.getAttribute("data-id");
	var type = data.getAttribute("data-type"); 
	var order = data.getAttribute("data-order");
	$('#order_type').val(type)
    $("#order").val(order);  
}

function loadOrderSummary() {
	var type = "pre_order_summary";
	var d = new Date();
    var time = d.toLocaleTimeString().replace(/:\d+ /, ' ');
    $('.show_submit h5').html('Pre-Order Your SUB by ' + time + ' <small>(Orders not pick up will not be allowed to pre order again)</small>');
    $('.show_submit h4 i').html('Full name: ' + $('#fullname').val());
    $('.show_submit h4 b').html('Order by: ' + time);
	$.ajax({
		type: 'GET', 
		data: {type:type},
		url: url,
		success: function(result){ 
			console.log(result); 
			var summaryRow = '';
			var counter = 1;
			$.each(JSON.parse(result), function (key, value) { 
				summaryRow += '<div class="col-md-3" style="border: 1px solid #000;margin-bottom:10px">';
				summaryRow += '<h4 style="font-size: 15px;">#' + counter + ' ' + key + '</h4>';
				summaryRow += '<ul style="padding-left: 20px;">';
				$.each(value, function (key2, value2) {  
					summaryRow += '<li>'+value2.order+'</li>';   
   				}) 
   				summaryRow += '</ul>';
				summaryRow += '</div>';
				counter++;   
   			}) 
			$("#summary_order").html(summaryRow);
    	}
	}) 
}

function resetData() { 
	var type = "reset";
	$.ajax({
		type: 'GET', 
		data: {type:type},
		url: url,
		success: function(result){ 
			//console.log(result);  
    	}
	})  
}