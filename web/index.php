<?php 
include "config.php";

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
    <?php include "style.css";?>
</style>



<body>
<div id="main">

    
    <?php
            include "./head.php";
        ?>
      
    <div id="banner">
        <img src="img/poster.png" alt="posterbanner">
    </div>
    <div id="product">
        <div class="nav-product">
            <div>TOÀN BỘ SẢN PHẨM</div>
            <div id="nav-sort">SẮP XẾP <div>Mới nhất<i class="fa-solid fa-chevron-down fa-2xs" style="color: #000000;"></i></div></div>
        </div>
        <div class="row">
        <div class="listcard">

         <?php 
         $sql = "SELECT * FROM Products";
         $result =sqlsrv_query($conn, $sql);
         $count=0;
         while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if($count>=8) break;
            $imgSrc = $row["image_url"]; // Đường dẫn ảnh từ cột "image" trong cơ sở dữ liệu
            $name = $row["name"]; // Tên sản phẩm từ cột "name" trong cơ sở dữ liệu
            $price = $row["price"]; // Giá sản phẩm từ cột "price" trong cơ sở dữ liệu
        $count++;
         ?>
         <a href="product.php?product_id=<?php echo $row['product_id']; ?>" style="color: #000000;">
         <div class="card">
         <img src="<?php echo $imgSrc; ?>"  alt="poster">
         <div class="skin">
                    <div class="color-skin" style="background-color: #000000;"></div>
                    <div class="color-skin" style="background-color: #FFFFFF;"></div>
                    <div class="color-skin" style="background-color: #BFECFF;"></div>
                </div>
                <div class="sub-card">
                    <div class="name"><?php echo $name; ?> </div>
                    <div class="price"><?php echo $price; ?>đ</div>
                </div>
         </div> </a>

         <?PHP 
             }
             ?> 
        </div></div>
        <div class="list-bonus">
            XEM THÊM
        </div>
    </div>
    <div id="content">
        <img src="img/image 9.png" alt="poster" style="height: 860px;">
        <div class="content-box">
            <div class="title-content">
                TỰ TIN BỨT PHÁ PHONG CÁCH RIÊNG
            </div>
            <div class="sub-content">
                Mỗi người trong chúng ta đều có phần cá tính muốn thể hiện ra ngoài, riêng cái cách thể hiện phần cá tính đó cũng đều rất khác nhau giữa chúng ta. Chính sự đa dạng đó làm nên sự tuyệt vời của xã hội và cuộc sống này, bạn hãy là bạn, hãy tỏa sức lan tỏa phong cách riêng của bạn. 
                <br> Hâm mộ ai, tâm trạng bạn như thế nào, triết lý sống của ban là gì... Bất kì là cái gì, xin hãy để masi giúp đỡ bạn một chút
            </div>
        </div>
    </div>
    <div id="new-product">
        <div class="listname">SẢN PHẨM MỚI</div>
        <div class="row">
        <div class="listcard">
        <?php 
         $sqldesc = "SELECT *
         FROM Products
         ORDER BY product_id DESC;";
         $result =sqlsrv_query($conn, $sqldesc);
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
         <div class="skin">
                    <div class="color-skin" style="background-color: #000000;"></div>
                    <div class="color-skin" style="background-color: #FFFFFF;"></div>
                    <div class="color-skin" style="background-color: #BFECFF;"></div>
                </div>
                <div class="sub-card">
                    <div class="name"><?php echo $name; ?> </div>
                    <div class="price"><?php echo $price; ?>đ</div>
                </div>
         </div> </a>

         <?PHP 
             }
             ?> 
        </div></div>
        <div class="list-bonus-new">
            XEM THÊM
        </div>
     </div>
        <div id="content2">
            <div class="content2-left">
                <div class="title-content">TỰ TIN BỨT PHÁ PHONG CÁCH RIÊNG</div>
                <div class="sub-content">Mỗi người trong chúng ta đều có phần cá tính muốn thể hiện ra ngoài, riêng cái cách thể hiện phần cá tính đó cũng đều rất khác nhau giữa chúng ta. Chính sự đa dạng đó làm nên sự tuyệt vời của xã hội và cuộc sống này, bạn hãy là bạn, hãy tỏa sức lan tỏa phong cách riêng của bạn. 
                    <br>Hâm mộ ai, tâm trạng bạn như thế nào, triết lý sống của ban là gì... Bất kì là cái gì, xin hãy để masi giúp đỡ bạn một chút
                    <div class="design">TỰ DESIGN</div>
                </div>
            </div>
            <div class="content2-right">
                <img src="img/image 7.png" alt="poster">
                <div>VIDEO NÀO ĐÓ, <br>HOẶC POSTER NÀO ĐÓ</div>
            </div>
        
        </div>
        <?php 
        include "./footer.php";
        ?>
</div>


</body>
</html>