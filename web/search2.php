<?php
include "config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link css -->
    <link rel="stylesheet" href="./search2.css">
    <!-- awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
<div id="main">

    <div id="header">
        <div class="nav-left">
            <div><i class="fa-solid fa-bars" style="color: #000000;"></i>
            <div class="sub-nav">menu</div></div>
            <div id="search-form" class="hidden">
            <form action="search.php" method="POST">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit"><img src="img/magnifying-glass.png" alt=""></button>
            </form>

            </div>
        </div>

        <div class="header-mid">MOSI</div>
        <div class="nav-right">
            <div class="sub-nav">My MASI</div>
            <i class="fa-solid fa-cart-shopping" style="color: #000000;"></i>
        </div>
    </div>
    <?php

        if(isset($_POST['search'])) {
   
        $searchTerm = $_POST['search'];
        // Thực hiện truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
        $sql = "SELECT * FROM Products WHERE description LIKE '%a%'";
        $result = sqlsrv_query($conn, $sql);
    ?>
    <div class="row">
        <div class="listcard">
            <?php 
            $count = 0;
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if ($count >= 8) break;
                $imgSrc = $row["image_url"];
                $name = $row["description"];
                $price = $row["price"];
                $count++;
            ?>
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
            </div> 
            <?php 
            }
            ?> 
        </div>
    </div>
    <?php 
        }
        sqlsrv_close($conn);
    ?>
            <div id="footer">
            <div class="footer-title">
                MOSI
            </div>
            <div class="line"></div>
            <div class="footer-sub">
                <div>
                    <div><a href="">Chính sách hoạt động</a></div>
                    <div><a href="">Chính sách đổi trả</a></div>
                    <div><a href="">Chính sách giao hàng</a></div>

                </div>
                <div>
                    <div><a href="">Thiết kế riêng với Masi</a></div>
                    <div><a href="">Các dịch vụ khác</a></div>
                    <div><a href="">Hướng dẫn sử dụng</a></div>

                </div>
                <div>
                    <div><a href="">Blogs</a></div>
                    <div><a href="">Hỏi đáp - FAGs</a></div>
                    <div><a href="">Chăm sóc khách hàng</a></div>

                </div>
                <div class="recruitment">
                    <div><a href="">Tuyển dụng</a></div>
                    <div><a href="">Hợp tác kinh doanh</a></div>
                </div>
                <div class="contact">
                    <div class="send">
                        <div class="title-contact">Gửi Phản Hồi</div>
                       <div class="send-sub">chúng tôi luôn mong đợi ý kiến từ bạn</div>
                    </div>
                    <div class="contact-inf">
                        <img src="img/image 8.png" alt="poster">
                         <div>
                            <b>Hotline</b><br>
                            (+84) 866 394 681
                         </div>
                    </div>
                    <div class="contact-inf">
                        <img src="img/image 10.png">
                        <div>
                            <b>Email</b><br>
                            masi@storemasi.com
                         </div>
                    </div>
                    <div class="contact-inf">
                        <img src="img/image 12.png">
                        <div>
                            <b>Địa chỉ</b><br>
                            9/71/17/4 Vân Canh, Hoài Đức, HN
                         </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
</div>
</body>
</html>