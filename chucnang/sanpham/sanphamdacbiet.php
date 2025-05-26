<?php
require "config/ketnoi.php";

// Hàm để lấy số lượng sản phẩm đã thêm vào giỏ hàng
function getQuantityInCart($id_sp) {
    return isset($_SESSION['giohang'][$id_sp]) ? $_SESSION['giohang'][$id_sp] : 0;
}
?>

<div class="prd-block">
    <!-- <h2 class="section-title">Sản phẩm yêu thích nhất</h2> -->
    <div class="title-container">
        <h2 class="section-title">Sản phẩm yêu thích nhất</h2>
    </div>
    <div class="pr-list">
        <?php
        $sql = "SELECT * FROM sanpham WHERE dac_biet = 1 ORDER BY id_sp DESC LIMIT 0,12";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
            $id_sp = $row['id_sp'];

            // Truy vấn để lấy số lượng sản phẩm trong kho
            $sql_stock = "SELECT so_luong FROM sanpham WHERE id_sp = ?";
            $stmt = $conn->prepare($sql_stock);
            $stmt->bind_param("i", $id_sp);
            $stmt->execute();
            $result = $stmt->get_result();
            $stock = ($result->num_rows > 0) ? $result->fetch_assoc()['so_luong'] : 0;

            // Lấy số lượng sản phẩm đã thêm vào giỏ hàng
            $quantity_in_cart = getQuantityInCart($id_sp);
        ?>
            <div class="prd-item">
                <a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><img src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></a>
                <p class="prd-name"><a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><?php echo $row['ten_sp'] ?></a></p>
                <p class="price"><span>Giá: <?php echo number_format($row['gia_sp'], 0, ',', '.') ?>₫</span></p>
                <a class="btn_cart" href="javascript:void(0);" onclick="checkStockAndProceed(<?php echo $stock; ?>, <?php echo $quantity_in_cart; ?>, 'chucnang/giohang/themhangindex.php?id_sp=<?php echo $row['id_sp']; ?>')">
                    <i class="fa-solid fa-cart-plus fa-2xl" style="color: #fa0303;"></i>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    function checkStockAndProceed(stock, quantityInCart, url) {
    var quantityToAdd = 1; // Số lượng thêm vào giỏ hàng

    if (stock <= 0) {
        // Sản phẩm không có sẵn trong kho
        alert('Sản phẩm này hiện không có sẵn');
    } else if (quantityInCart + quantityToAdd > stock) {
        // Số lượng trong giỏ hàng cộng với số lượng muốn thêm vượt quá số lượng trong kho
        alert('Bạn đã thêm hết số lượng sản phẩm có trong kho');
    } else {
        // Điều kiện để thêm sản phẩm vào giỏ hàng
        window.location.href = url;
    }
}
</script>

<?php

?>
