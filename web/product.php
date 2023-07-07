<?php
$product_id = null;
include"config.php";
if(isset($_GET['product_id'])){
$product_id = $_GET['product_id']; // ID của sản phẩm
}
// Lấy dữ liệu từ bảng Products
$query = "SELECT name, price, image_url FROM Products WHERE product_id = ?";
$params = array($product_id);
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$product = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Lấy dữ liệu từ bảng Size_Product và số lượng sản phẩm có size trong kho
$query ="SELECT size, SoLuongTrongKho FROM Size_Product WHERE product_id = ?";
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
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <link rel="stylesheet" href="./product.css">
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
<body>
        <?php
            include"./head.php";
        ?>    
<div class="product">
        <div class="product-img"><img src="<?php echo $product['image_url']; ?>"></div>
        <div class="product-des">
            <h1><?php echo $product['name']; ?></h1>
            <div class="price"><?php echo $product['price']; ?>đ</div>
            <div class="line"></div>
            <div class="size">Size:</div>
            <form method="post" action="">
                <?php foreach ($sizes as $size): ?>
                    <span>
                        <button type="submit" name="selected_size" value="<?php echo $size['size']; ?>" class="size-sub">
                            <?php echo $size['size']; ?>
                        </button>
                    </span>
                <?php endforeach; ?>
            </form>

            <div class="quantity">
                <span class="qty-text">SL:</span>
                <div class="control">
                    <input type="number" id="quantity" name="quantity" min="1" value="1" max="<?php echo $max_quantity; ?>" class="quantity-input">
                </div>
            </div>
            <button type="submit">Thêm vào giỏ hàng</button>
        </div>
</div>
<?php 
        include "./footer.php";
        ?>
</body>
</html>
