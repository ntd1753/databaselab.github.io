<?php 
session_start();

if(isset($_SESSION['order_id'])){
    $order_id = $_SESSION['order_id'];
    echo "Cảm ơn quý khách đã sử dụng sản phẩm của chúng tôi mã đơn hàng của quý khách là $order_id ";
}else{
    header('Location: index.php');
}
unset($_SESSION['cart']);
unset($_SESSION['order_id']);
?>

