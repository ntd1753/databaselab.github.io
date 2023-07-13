<style>
    <?php 
        include "header.css";
    ?>
</style>

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

        <a href="index.php" style="color: #000000;"><div class="header-mid">MOSI</div></a>
        <div class="nav-right">
            <div class="sub-nav">My MASI</div>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
        </div>
    </div>