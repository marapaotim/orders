<!DOCTYPE html>
<html>
<head>
	<title>Sub Pre Orders</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<br>
	<div class="container hide_submit"> 
		<div class="row">
			<div class="col-md-4">
				<h4>Add/Update Order</h4>
				<hr>
				<form id="form_order">
					<div class="form-group">
					    <label for="email">Order Type:</label>
					    <select class="form-control" id="order_type">
					    	<option value="Bread">Bread</option>
					    	<option value="Sauce">Sauce</option>
					    	<option value="Sandwich">Sandwich</option>
					    	<option value="Cheese">Cheese</option>
					    	<option value="Veggies">Veggies</option>
					    </select>
					</div>
					<div class="form-group">
					    <label for="pwd">Order:</label>
					    <input type="text" class="form-control" id="order" required>
					</div>
					  <button type="submit" class="btn btn-success form-control"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Save Order</button>
				</form>
			</div>
			<div class="col-md-8">  
				<h4>Orders List</h4>
				<hr>
			<div class="panel-group"> 
			<div class="panel panel-default">
			 <div class="panel-heading">
			 	<form class="form-inline" id="submit_summary"> 
				  <div class="form-group mx-sm-3 mb-2"> 
				    <input type="text" class="form-control" id="fullname" placeholder="Full Name . . ." required>
				  </div>
				  <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Submit Order/Show Summary</button>
				</form>

			 </div>  
			<div class="panel-body">       
			  	<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>TYPE</th>
				        <th>ORDER TYPE</th>
				        <th>Action</th> 
				      </tr>
				    </thead>
				    <tbody id="data"> 
				    </tbody>
			  	</table>
			  </div>
			   </div>
			  </div>
			</div>  
		</div>
	</div>

	<div class="container show_submit" style="border: 1px solid #000;padding: 20px;"> 
		<h1 class="text-center">Sub Pre Order</h1><hr>
		<div class="row">
		<div class="col-md-6"> 
			<h5></h5>
		</div>
		<div class="col-md-6" style="text-align:right"> 
			<h4><i style="font-size: 15px;"></i> | <b style="font-size: 15px;"></b></h4>
		</div> 
		</div>
		<div class="row" id="summary_order"> 
		</div>
		<i>Reload the Page for the new Order</i>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="ajax/orders.js"></script> 
</body>
</html>