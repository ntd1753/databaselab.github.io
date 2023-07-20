<?php
$product_id = null;
include "../config/config.php";
if(isset($_GET['product_id'])){
$product_id = $_GET['product_id']; // ID của sản phẩm
}
// Lấy dữ liệu từ bảng Products
$query = "SELECT name, price, image_url,category_id FROM Products WHERE product_id = ?";
$params = array($product_id);
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$product = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$category=$product['category_id'];
// Lấy dữ liệu từ bảng Size_Product và số lượng sản phẩm có size trong kho
$query ="SELECT size, SoLuongTrongKho,size_id FROM Size_Product WHERE product_id = ?";
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$sizes = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $sizes[] = $row;
}

// Xử lý khi chọn size
if (isset($_POST['selected_size'])) {
    $selected_size = $_POST['selected_size'];
    foreach ($sizes as $size) {
        if ($size['size'] == $selected_size) {
            $size_id= $size['size_id'];
            $max_quantity = $size['SoLuongTrongKho'];
            break;
        }
    }
} else {
    $max_quantity = 1; // Mặc định là 1 nếu chưa chọn size
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<style>
    <?php include "./css/product.css"; ?>
    .selection{
        color: white;
        background-color: black;
    }
</style>
    <body>
        <div id="main">
        <?php
            include"./head.php";
        ?>    </div>
<div class="product">
        <div class="product-img"><img src="<?php echo $product['image_url']; ?>"></div>
        <div class="product-des">
            <h1><?php echo $product['name']; ?></h1>
            <div class="price"><?php echo $product['price']; ?>đ</div>
            <div class="line-product"></div>
            <div class="size">Size:</div>
            <form action="" method="post">
    <?php foreach ($sizes as $size): ?>
        <?php if (isset($_POST['selected_size']) && $_POST['selected_size'] == $size['size']): ?>
            <span>
                <button type="submit" name="selected_size" value="<?php echo $size['size']; ?>" class="size-sub selection">
                    <?php echo $size['size']; ?>
                </button>
            </span>
        <?php else: ?>
            <span>
                <button type="submit" name="selected_size" value="<?php echo $size['size']; ?>" class="size-sub">
                    <?php echo $size['size']; ?>
                </button>
            </span>
        <?php endif; ?>
    <?php endforeach; ?>
</form>
    
    <form action="addtocart.php?size_id=<?php echo  $size_id ?>" method="POST">
     
        
        <div class="quantity">
            <span class="qty-text">SL:</span><br>
            <div class="control">
                <input type="number" id="quantity" name="quantity" min="0" value="1" max="<?php echo $max_quantity; ?>" class="quantity-input">
            </div>
        </div>
        <input type="submit" name="themgiohang" class="themgiohang" value="Thêm vào giỏ hàng ">
            
        </input>

    </form>
        </div>
</div>
<div class="RELATED-PRODUCTS">
    <div class="related-title">SẢN PHẨM TƯƠNG TỰ</div>
    <div class="row">
        <div class="listcard">
        <?php 
         $sql = "SELECT *
         FROM Products
         WHERE category_id=$category";
         $result =sqlsrv_query($conn, $sql);
         $count=0;
         while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if($count>=4) break;
            $imgSrc = $row["image_url"]; // Đường dẫn ảnh từ cột "image" trong cơ sở dữ liệu
            $name = $row["name"]; // Tên sản phẩm từ cột "name" trong cơ sở dữ liệu
            $price = $row["price"]; // Giá sản phẩm từ cột "price" trong cơ sở dữ liệu
        $count++;
         ?>
         <a href="product.php?product_id=<?php echo $row['product_id']; ?>" style="color: #000000;">
         <div class="card">
         <img src="<?php echo $imgSrc; ?>"  alt="poster">
                <div class="sub-card">
                    <div class="name"><?php echo $name; ?> </div>
                    <div class="price-card"><?php echo $price; ?>đ</div>
                </div>
         </div> </a>

         <?PHP 
             }
             ?> 
    </div></div>
   
</div>
<?php 
        include "./footer.php";
        ?>

</body>
<style>
     .footer-tilte {
        padding-top: 23px;
    }
</style>
</html>