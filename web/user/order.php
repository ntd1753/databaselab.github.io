<?php
session_start();
include "../config/config.php";


if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
    $cart_item = $_SESSION['cart'];
    $sum=0;
} else {
    $cart_item = array();
}

// Kiểm tra xem giỏ hàng có tồn tại không
if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
    $cartItems = $_SESSION['cart'];
} else {
    $cartItems = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/order.css">
  <!-- awesome icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<style>

</style>
<body>
<div id="main">
    <?php 
    include "head.php";
    ?>
    <div class="content">
        <div class="suggest">

        </div> 
        <div class="container">
        <h1 id="title-1">Thanh toán</h1>
        <h4 id="title-2">Thông tin thanh toán</h4>
        <form action="addorder.php" method="post">
            <div>
            <label for="fname"> Họ và Tên</label> <br>
            <input type="text" name="fname" class="input-text" placeholder="Nhập họ và tên"> <br>
            <label for="address">Địa chỉ</label> <br>
            <input type="text" name="address" class="input-text" placeholder="Nhập địa chỉ"> <br>
            <label for="phone-num">Số điện thoại</label> <br>
            <input type="tel" name="phone-num" class="input-text" placeholder="Nhập số điênh thoại"> <br>
            <label for="email" >email</label> <br>
            <input type="email" name="email" placeholder="Nhập email">
        </div>
    
    
    <div>
        <h2>Đơn hàng của bạn</h2>
        <table class="items">
            <thead>
                <th>Sản phẩm</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Tạm Tính</th>
            </thead>
            <tbody>
                <?php foreach($cartItems as $cartItem){ ?>
                    <tr>
                        <td><?php echo $cartItem['name']; ?></td>
                        <td><?php echo $cartItem['size']; ?></td>
                        <td class="quatity"> 
                            <div><?php echo $cartItem['soluong'];?></div>
                        </td>
                        <td><?php echo $cartItem['soluong'] * $cartItem['price']; ?>đ</td>
                    </tr>
                <?php $sum+=$cartItem['soluong'] * $cartItem['price'];} ?>
                    
            </tbody>
            <tr>
                    <th>Tổng</th>
                    <td colspan="3"><?php echo $sum  ?>đ</td>  
                </tr>
        </table>
    </div>
     <div class="pay-ment">
        <div class="method-pay">Trả tiền mặt khi nhận hàng</div>
        <div class="method-sub">
            Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn đặt hàng của bạn,
            hỗ trợ trải nghiệm của bạn trên trang web này và cho các mục đích khác
             được mô tả trong <a href="#">chính sách riêng tư</a>.
        </div>           
        <button type="submit" name="submit" class="submittt">Thanh Toán</button>
    </div>     
    </form>
    </div></div>
    <?php
    $_SESSION['sum']=$sum;
    ?>
    <?php 
        include "footer.php";
    ?>
    
</div>
</body>
</html>
