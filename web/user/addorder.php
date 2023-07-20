<?php
    session_start();
    include "../config/config.php";

    $sum=$_SESSION['sum'];

    $order_date=date("Y-m-d");
   
    $OrderItems = $_SESSION['cart'];
    if(isset($_POST['submit'])){
        $customer_name=$_POST["fname"];
        $customer_address=$_POST["address"];
        $customer_phone=$_POST["phone-num"];
        $customer_email=$_POST["email"];
    }
    $insert_customer="INSERT INTO Customers (customer_name, email, address, phone)
    OUTPUT INSERTED.customer_id
    VALUES (N'$customer_name', N'$customer_email', N'$customer_address', '$customer_phone');";
    $query_customer=sqlsrv_query($conn,$insert_customer);
    $row = sqlsrv_fetch_array($query_customer, SQLSRV_FETCH_ASSOC);
    $customer_id=$row['customer_id'] ;
    $insert_order_detail="INSERT INTO  Orders(customer_id,order_date,total_amount)
                            OUTPUT INSERTED.order_id
                            VALUES(' $customer_id','$order_date','$sum');";
	$query_order=sqlsrv_query($conn,$insert_order_detail);
    
    $row_order=sqlsrv_fetch_array($query_order, SQLSRV_FETCH_ASSOC);
    $order_id=$row_order['order_id'];
     $_SESSION['order_id']=$order_id;
        foreach($_SESSION['cart'] as $key=> $value){
			$id_size=$value['id'];
			$soluong=$value['soluong'];
            $insert_order_items="INSERT INTO OrderItems (order_id, size_id, quantity)
                                    VALUES ($order_id, $id_size, $soluong);
            ";
			$query_order_items=sqlsrv_query($conn,$insert_order_items);
    }

    header('Location: thankyou.php');
  
?>
