<?php
include "../config/config.php"; 
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id']; // ID của sản phẩm
    $query_c="SELECT category_name
    FROM category
    WHERE category_id = $category_id;
    ";
    $result5 =sqlsrv_query($conn, $query_c);
    $row5=sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC);
    $category_name=$row5['category_name'];
    
    }
    $query_p="SELECT product_id, name, price, image_url
    FROM Products
    WHERE category_id = $category_id;
    ";
    $result =sqlsrv_query($conn,$query_p);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/category.css">
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body><div id="main">
    <?php
    include "head.php";
    ?>
         <div class="resultc" >
      <?php  echo 'Kết quả tìm kiếm: "' . $category_name . '"'; ?>
    </div>
      <div class="row">
        
        <div class="listcard">
            <?php 
            $count = 0;
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if ($count >= 24) break;
                $imgSrc = $row["image_url"];
                $name = $row["name"];
                $price = $row["price"];
                $count++;
            ?>
            <a href="product.php?product_id=<?php echo $row['product_id']; ?>">
            <div class="card">
                <img src="<?php echo $imgSrc; ?>" alt="poster">
             
                <div class="sub-card">
                    <div class="name"><?php echo $name; ?></div>
                    <div class="price"><?php echo $price; ?>đ</div>
                </div>
            </div> </a> 
            <?php 
            }
            ?> 
        </div>
    </div>
    
    <?php 
    include "footer.php";
    ?>
    </div>
</body>
</html>