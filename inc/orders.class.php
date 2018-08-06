<?php 

require_once( dirname( __FILE__ ) . '/config.class.php' );

if( isset($_REQUEST['type']) && !empty($_REQUEST['type']) )
{
	$type = $_REQUEST['type']; 
	switch ($type) 
	{ 
		case "view": 
			$view_orders = new Order(); 
			echo json_encode($view_orders->view_orders(), true); 
		break; 
		case 'insert':  
			$array_order = [
				'order_type'	=>	$_REQUEST["order_type"],
				'order'			=>	$_REQUEST["order"], 
			];  
			$insert = new Order(); 
			echo json_encode($insert->insert($array_order), true); 
		break;  
		case 'update':  
			$array_order = [
				'id'			=>	$_REQUEST["id"],
				'order_type'	=>	$_REQUEST["order_type"],
				'order'			=>	$_REQUEST["order"], 
			];  
			$update = new Order(); 
			echo json_encode($update->update($array_order), true); 
		break;  
		case "delete":
			$delete = new Order(); 
			echo json_encode($delete->delete($_REQUEST["id"]), true); 
		break; 
		case "pre_order_summary":
			$pre_order_summary = new Order(); 
			echo json_encode($pre_order_summary->pre_order_summary(), true); 
		break;
		case "reset":
			$reset = new Order(); 
			$reset->reset_data(); 
		break;
	}
}

class Order
{ 
	private $conn;

	function __construct()
 	{  
		$this->conn = new Config();    
 	}  

	public function view_orders()
	{     
		$conn = $this->conn->config_db();  
		$sql = 'SELECT 
			`orders`.`id`,
		    `orders`.`type`,
		    `orders`.`order`
		FROM `pre_order`.`orders` 
		order by id desc;';
		$query = $conn->prepare($sql);    
		$query->execute(); 
		$array_orders = $query->fetchAll(PDO::FETCH_ASSOC);  
	    return $array_orders;   
	}

	public function insert($data)
	{  
		$conn = $this->conn->config_db();  
		$sql = 'INSERT INTO `pre_order`.`orders`
		(
			`type`,
			`order`
		)
		VALUES
		(
			:type,
			:order 
		);
		';  
       $query = $conn->prepare($sql); 
       $query->bindParam(':type', $data["order_type"]);
       $query->bindParam(':order', $data["order"]);  
       $query->execute(); 
       return ['status' => 'Successfully Added']; 
	}

	public function update($data)
	{  
		$conn = $this->conn->config_db();  
		$sql = 'UPDATE `pre_order`.`orders`
		SET
			`type` =  :type,
			`order` = :order
		WHERE `id` = :id';  
       $query = $conn->prepare($sql); 
       $query->bindParam(':id', $data["id"]);
       $query->bindParam(':type', $data["order_type"]);
       $query->bindParam(':order', $data["order"]);  
       $query->execute(); 
       return ['status' => 'Successfully Updated']; 
	}

	public function delete($id)
	{  
		$conn = $this->conn->config_db();  
		$sql = 'DELETE FROM `pre_order`.`orders`
			WHERE `id` = :id;'
		;  
       $query = $conn->prepare($sql); 
       $query->bindParam(':id', $id);   
       $query->execute(); 
       return ['status' => 'Successfully Deleted']; 
	}

	public function pre_order_summary()
	{
		$conn = $this->conn->config_db();  
		$sql = 'SELECT 
			`orders`.`id`,
		    `orders`.`type`,
		    `orders`.`order`
		FROM `pre_order`.`orders` 
		order by id desc;';
		$query = $conn->prepare($sql);    
		$query->execute(); 
		$array_orders = $query->fetchAll(PDO::FETCH_ASSOC);   
		$group = [];
		foreach ($array_orders as $key => $value)
		{
			$group[$value['type']][] = $value;
		}
		return $group;
	}

	public function reset_data()
	{
		$conn = $this->conn->config_db();  
		$sql = 'DELETE FROM `pre_order`.`orders`
			WHERE `id` >= 1;'
		;  
       $query = $conn->prepare($sql); 
       $query->bindParam(':id', $id);   
       $query->execute(); 
	}
}