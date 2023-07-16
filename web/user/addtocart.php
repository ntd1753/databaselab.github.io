<?php
session_start();
include "../config/config.php";


if(isset($_POST['themgiohang'])){
	$soluong= $_POST['quantity'];
	$id=$_GET['size_id'];
	 

	$sql="SELECT Products.product_id,Products.name, Products.price,
	  Products.image_url, Size_Product.size,
	   Size_Product.SoLuongTrongKho,Size_Product.size_id
        FROM Products 
        JOIN Size_Product  ON Products.product_id = Size_Product.product_id
        WHERE Size_Product.size_id = $id ";
	
	$query=sqlsrv_query($conn,$sql);

	$row=sqlsrv_fetch_array($query);
	
	if($row){
		$SoLuongTrongKho=$row['SoLuongTrongKho'];
		$new_product = array(
			array(
				'name' => $row['name'],
				'id' => $id,
				'size' => $row['size'],
				'soluong' => $soluong,
				'price' => $row['price'],
				'image_url' => $row['image_url'],
				'product_id' => $row['product_id'],
				
			)
		);
		
		
		if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
			$found = false;
			$product = array();
		
			foreach ($_SESSION['cart'] as $cart_item) {
				if ($cart_item['id'] == $id && $cart_item['size'] == $cart_item['size']) {
					$cart_item['soluong'] += $soluong;
					$soluong = $cart_item['soluong'];
				
				
					$found = true;
				}
				
				$product[] = array(
					'name' => $cart_item['name'],
					'id' => $cart_item['id'],
					'size' => $cart_item['size'],
					'soluong' => $cart_item['soluong'],
					'price' => $cart_item['price'],
					'image_url' => $cart_item['image_url'],
					'product_id' => $cart_item['product_id'],
					
				);
			}
		
			if ($found == false) {
				$product[] = array(
					'name' => $row['name'],
					'id' => $id,
					'size' => $row['size'],
					'soluong' => $soluong,
					'price' => $row['price'],
					'image_url' => $row['image_url'],
					'product_id' => $row['product_id'],
					
				);
			}
		
			$_SESSION['cart'] = $product;
		} else {
			$_SESSION['cart'] = $new_product;
		}

		

	 header('Location: cart.php');
	}
}

?>
<?php

if(isset($_GET['minus'])){
		$id=$_GET['minus'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]=array(
                    'name'=>$cart_item['name'],
                    'size' => $cart_item['size'],
                    'id'=>$cart_item['id'],
                    'soluong'=>$cart_item['soluong'],
                    'price'=>$cart_item['price'],
                    'image_url'=>$cart_item['image_url'],
                    'product_id'=>$cart_item['product_id'],
					);
				$_SESSION['cart']=$product;
			}else{
				$giam=$cart_item['soluong']-1;
			
				if($cart_item['soluong']>1){
					$product[]=array(
                    'name'=>$cart_item['name'],
                    'id'=>$cart_item['id'],
                    'size' => $cart_item['size'],
                    'soluong'=>$giam,
                    'price'=>$cart_item['price'],
                    'image_url'=>$cart_item['image_url'],
                    'product_id'=>$cart_item['product_id'],
					
                );
				}else{
					$product[]=array(
                        'name'=>$cart_item['name'],
                        'id'=>$cart_item['id'],
                        'size' => $cart_item['size'],
                        'soluong'=>$cart_item['soluong'],
                        'price'=>$cart_item['price'],
                        'image_url'=>$cart_item['image_url'],
                        'product_id'=>$cart_item['product_id'],
						
                    );
				}
				$_SESSION['cart']=$product;
			}
		}
		header('Location: cart.php');
	}

	if(isset($_GET['plus'])){
		$id=$_GET['plus'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]=array(
					'name'=>$cart_item['name'],
					'id'=>$cart_item['id'],
					'size' => $cart_item['size'],
					'soluong'=>$cart_item['soluong'],
					'price'=>$cart_item['price'],
					'image_url'=>$cart_item['image_url'],
					'product_id'=>$cart_item['product_id']
				);
				$_SESSION['cart']=$product;
			}else{
				
				
				if($cart_item['soluong']<10){
					$tang=$cart_item['soluong']+1;
					
					$product[]=array('name'=>$cart_item['name'],
					'id'=>$cart_item['id'],
					'size' => $cart_item['size'],
					'soluong'=>$tang,
					'price'=>$cart_item['price'],
					'image_url'=>$cart_item['image_url'],
					'product_id'=>$cart_item['product_id'],
					);
				}else{
					$product[]=array(
					'name'=>$cart_item['name'],
					'id'=>$cart_item['id'],
					'size' => $cart_item['size'],
					'soluong'=>$cart_item['soluong'],
					'price'=>$cart_item['price'],
					'image_url'=>$cart_item['image_url'],
					'product_id'=>$cart_item['product_id'],
					);
				}
				$_SESSION['cart']=$product;
			}
		}
		header('Location: cart.php');
	}

	if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]=array(
					'name'=>$cart_item['name'],
					'id'=>$cart_item['id'],
					'size' => $cart_item['size'],
					'soluong'=>$cart_item['soluong'],
					'price'=>$cart_item['price'],
					'image_url'=>$cart_item['image_url'],
					'product_id'=>$cart_item['product_id'],
				);
			}
		$_SESSION['cart']=$product;
		header('Location:  cart.php');
		}
	}
	






    ?>

	