<style>
    <?php 
        include "../user/css/header.css";

    ?>
</style>
<?php
$query_category_women="SELECT category_id, category_name
FROM Category
WHERE category_name NOT LIKE N'%nam%'
ORDER BY category_name ASC;
";
$query_category_men="SELECT category_id, category_name
FROM Category
WHERE category_name LIKE N'%nam%'
ORDER BY category_name ASC;
";
$result1 =sqlsrv_query($conn, $query_category_women);
$result2 =sqlsrv_query($conn, $query_category_men);

?>

<div id="header">
        <div class="nav-left">
           
            <div class="click-menu"><i class="fa-solid fa-bars" style="color: #000000;"></i>
            <div class="sub-nav">Menu</div></div>
            <div id="search-form" class="hidden">
            <form action="search.php" method="POST">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit"><img src="./img/magnifying-glass.png" alt=""></button>
            </form>

            </div>
        </div>

        <a href="index.php" style="color: #000000;"><div class="header-mid">MOSI</div></a>
        <div class="nav-right">
            <div class="sub-nav">My MOSI</div>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
        </div>
    </div>
    <div class="parent-menu" style="display: none;">
    <div class="head-menu" >
    <div class="menu-choice">
        <h3 class="gender">Nữ</h3>
        <div style="border-right: 1px solid #b6a2a2; width: 200px;">

        <div class="list-category">
            <ul>
            <?php 
            while($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)){ ?>
                <a href="category.php?category_id=<?php echo $row['category_id']; ?>" style="color: #000000;">
                    <li><?php echo $row['category_name'] ?></li>
                </a>
            <?php }
            ?>
            </ul>
        </div></div>
    </div>
    <div class="menu-choice" >
        <h3 class="gender1">Nam</h3>
        <div style="border-right: 1px solid #b6a2a2; width: 200px;">

            <div class="list-category1">
        <ul>
            <?php 
            while($row1 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){ ?>
                <a href="category.php?category_id=<?php echo $row1['category_id']; ?>" style="color: #000000;">
                    <li><?php echo $row1['category_name'] ?></li>
                </a>
            <?php }
            ?>
            </ul>
        </div></div>
    </div>
    <div class="menu-choice">
        <h3 class="gender"> Cửa Hàng</h3>
       
    </div>
    

</div></div>
<html>
<script>
    const menu = document.querySelector(".click-menu");
    const parentchoice=document.querySelector(".parent-menu");
    const gender=document.querySelector(".gender");
    const gender2=document.querySelector(".gender1");
    const list=document.querySelector(".list-category");
    const list1=document.querySelector(".list-category1");

    menu.addEventListener(
        'click', function() {
            if(parentchoice.style.display=="block"){
            parentchoice.style.display="none";}else{
                parentchoice.style.display="block";
        }
        } 
    );
    gender.addEventListener(
        'click', function(){
            list1.style.display="none";
            list.style.display="block";
            gender.style.backgroundColor="black";
            gender.style.color="white";
            gender2.style.backgroundColor="#d6d5d5";
            gender2.style.color="black";
        }
    );
    gender2.addEventListener(
        'click', function(){
            list.style.display="none";
            list1.style.display="block";
            gender2.style.backgroundColor="black";
            gender2.style.color="white";
            gender.style.backgroundColor="#d6d5d5";
            gender.style.color="black";
        }
    );
</script>
</html>
