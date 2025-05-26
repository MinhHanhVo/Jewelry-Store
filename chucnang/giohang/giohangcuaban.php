<div id="cart">
    <p class="cart-quantity">
        <span>
            <?php
            if(isset($_SESSION['giohang'])){
                echo count($_SESSION['giohang']);
            }else{
                echo 0;
            }
            ?>
        </span>
    </p>
    <p><a href="index.php?page_layout=giohang"><i class="fa-solid fa-cart-shopping fa-2xl" style="color: #db1f45;"></i></a></p>
    <!-- <p class="cart-text">Giỏ Hàng</p> -->
</div> 
