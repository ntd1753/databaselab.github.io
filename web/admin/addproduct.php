
    <?php
    include "../config/config.php";
    // Truy vấn danh sách loại sản phẩm
    $sql = "SELECT * FROM Category";
         $result =sqlsrv_query($conn, $sql);
    $size_name=array("S","M","L","XL","XXL","XXL");
         

   
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div><h1>ADMIN</h1></div>
    
    <form action="addsize.php" method="post">
        <label for="category">Danh mục</label><br>
        <select name="category" id="category">
            <option value="">--Chọn danh mục--</option>
    <?php   
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo $row['category_name'];
                    echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                 }
          ?>  
          </select>
    <label for="product_name">Tên sản Phẩm</label><br>
    <input type="text" name="product_name">
     <label for="price">Giá Tiền</label> <br>      
     <input type="money" name="price">
     <label for="img">Nhập image url</label>
    <input type="text" name="img">
    <button type="submit" name="submit">Thêm sản phẩm</button>
    </form>
</body>
</html>
