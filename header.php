

<div class="full-header" style="position: sticky;top:0;z-index:999;" >
    <div id="header">
        <div id="logo"><a href="index.php"><img src="anh/logo.png" /></a></div>
        <!-- Navigation -->
        <div id="navbar">
            <ul>
                <li id="menu-home"><a href="index.php">Trang chủ</a></li>
                <li><a href="index.php?page_layout=gioithieu">Giới thiệu</a></li>
                <!-- <li><a href="index.php?page_layout=dichvu">Dịch vụ</a></li> -->
                <li><a href="index.php?page_layout=lienhe">Liên hệ</a></li>
            </ul>
        </div>
        <!-- Tìm kiếm -->
        <div id="search-bar">
            <?php require "chucnang/timkiem/timkiem.php"; ?>
        </div>
        <!-- Giỏ hàng -->
        <div id="giohangcuaban">
            <?php require "chucnang/giohang/giohangcuaban.php"; ?>
        </div>
        <!-- lịch sử đơn hàng -->
        <!-- <div id="lichsudonhang">
        <p><a href="index.php?page_layout=lichsudonhang">Tra cứu đơn hàng</a></p>
        </div> -->
        <div id="tracuudonhang">
            <?php require "chucnang/giohang/tracuudonhang.php";?>
        </div>
    </div>
    <!-- Navigation danh mục -->
    <div class="navdm">
        <ul id="danhmucsp">
            <?php
            ob_start();
            $sql = "SELECT * FROM dmsanpham";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <li><a href="index.php?page_layout=danhsachsp&id_dm=<?php echo $row['id_dm'];?>&ten_dm=<?php echo $row['ten_dm'];?>"><?php echo $row['ten_dm'];?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>