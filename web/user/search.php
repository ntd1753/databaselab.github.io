<?php
include "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- link css -->
    <link rel="stylesheet" href="./css/search2.css">
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
<div id="main">

<?php
            include "./head.php";
        ?>
    <?php

        if(isset($_POST['search'])) {
   
        $searchTerm = $_POST['search'];
        // Thực hiện truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
        $sql = "SELECT * FROM Products WHERE name LIKE '%$searchTerm%'";
        $result = sqlsrv_query($conn, $sql);
    ?>
    
     <div class="result" >
      <?php  echo 'Kết quả tìm kiếm: "' . $searchTerm . '"'; ?>
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
                <div class="skin">
                    <div class="color-skin" style="background-color: #000000;"></div>
                    <div class="color-skin" style="background-color: #FFFFFF;"></div>
                    <div class="color-skin" style="background-color: #BFECFF;"></div>
                </div>
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
        }
        sqlsrv_close($conn);
    ?>
    <?php 
        include "./footer.php";
    ?>
</div>
</body>
</html>


