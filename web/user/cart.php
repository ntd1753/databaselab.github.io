<?php
session_start();
include "../config/config.php";


// Kiểm tra xem giỏ hàng có tồn tại không
if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
    $cart_item = $_SESSION['cart'];
} else {
    $cart_item = array();
}
?>
<?php
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>

    <style>
       <?php 
       include "./css/cart.css";
       ?>
    </style>
</head>
<body>
 <div id="main">
  <?php 
  include "head.php";
  ?>
  <?php 
    $sum=0;
  ?>
  <div class="content">
        <div class="suggest">

        </div> 
  
    <div class="cart-container">
        <h1 class="page-title">Giỏ hàng</h1>
        <?php if(empty($cartItems)): ?>
            <p>Giỏ hàng trống.</p>
        <?php else: ?>
            <table class="cart-items">
                <thead>
                    <tr>
                        <th></th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartItems as $cartItem): ?>
                        <tr>
                        <td><a href="addtocart.php?xoa=<?php echo $cartItem['id']?>" class="xoa">Xóa</a></td>
                            <td><img src="<?php echo $cartItem['image_url']; ?>" alt=""></td>
                            <td><?php echo $cartItem['name']; ?></td>
                            <td><?php echo $cartItem['size']; ?></td>
                            <td class="quatity"> 
                           
                                <a href="addtocart.php?minus=<?php echo $cartItem['id']?>" class="add"><div>-</div></a>
                                <div><?php echo $cartItem['soluong'];?></div>
                                <a href="addtocart.php?plus=<?php echo $cartItem['id']?>" class="add"><div>+</div></a>

                            </td>
                            <td><?php echo $cartItem['price']; ?></td>
                            <td><?php echo $cartItem['soluong'] * $cartItem['price']; ?></td>
                        </tr>
                    <?php 
                    $sum += $cartItem['soluong'] * $cartItem['price'];
                endforeach; ?>
                </tbody>
             
            </table>
        <h1 class="page-title2"> CỘNG GIỎ HÀNG</h1>
        <table class="tinhtong">
            
                <tr>
                    <th>Tạm Tính</th>
                    <td><?php echo $sum  ?>đ</td>
                </tr>
                <tr>
                    <th>Giao Hàng</th>
                    <td>GIao Hàng Miễn phí</td>
                </tr>
                <tr>
                    <th>Tổng</th>
                    <td><?php echo $sum  ?>đ</td>
                    
                </tr>
        </table>
          

            <a href="order.php"><button class="order">Đặt Hàng</button>  </a>
            
        <?php endif; ?>
        <?php 
        // session_destroy();
        ?>
        </div>
    </div>
    <?php 
    include "footer.php";
    ?>
    </div>   
</body>
</html>
