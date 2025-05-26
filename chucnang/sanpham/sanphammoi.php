<div class="prd-block">
    <!-- <h2 class="section-title">Sản phẩm mới nhất</h2> -->
    <div class="title-container">
        <h2 class="section-title">Sản phẩm mới nhất</h2>
    </div>
    <div class="pr-list">
        <?php
        $sql = "SELECT * FROM sanpham ORDER BY id_sp DESC LIMIT 12";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="prd-item">
                <a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><img src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></a>
                <p class="prd-name"><a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><?php echo $row['ten_sp'] ?></a></p>
                <p class="price"><span>Giá: <?php echo number_format($row['gia_sp'], 0, ',', '.') ?>₫</span></p>
                <a class="btn_cart" href="chucnang/giohang/themhangindex.php?id_sp=<?php echo $row['id_sp']; ?>">
                    <i class="fa-solid fa-cart-plus fa-2xl" style="color: #fa0303;"></i>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>