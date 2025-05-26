<?php
//session_start();
require "cauhinh/ketnoi.php"; // Kết nối cơ sở dữ liệu của bạn

if (isset($_POST['update_cart'])) {
    if (isset($_POST['sl'])) {
        foreach ($_POST['sl'] as $id_sp => $sl) {
            // Nếu số lượng nhập vào là 0 thì unset sản phẩm đó
            if ($sl == 0) {
                unset($_SESSION['giohang'][$id_sp]);
            } else {
                // Nếu số khác 0 thì gán ngược lại
                $_SESSION['giohang'][$id_sp] = $sl;
            }
        }
    }
}

?>
<link rel="stylesheet" type="text/css" href="css/giohang.css" />
<div class="prd-block">
    <h2>Giỏ hàng của bạn</h2>
    <div class="cart">
        <?php
        if (isset($_SESSION['giohang'])) {
            $arrId = array();
            // Lấy ra id sản phẩm từ mảng session
            foreach ($_SESSION['giohang'] as $id_sp => $sl) {
                $arrId[] = $id_sp;
            }

            // Tách mảng arrId thành 1 chuỗi và ngăn cách bởi dấu ,
            $strID = implode(',', $arrId);

            // Kiểm tra xem $strID có rỗng không trước khi thực hiện truy vấn SQL
            if (!empty($strID)) {
                $sql = "SELECT * FROM sanpham WHERE id_sp IN ($strID)";
                $query = mysqli_query($conn, $sql);
                $totalPriceAll = 0;

        ?>
                <div class="form-container">
                    <form method="post" id="giohang">
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                            $totalPrice = $_SESSION['giohang'][$row['id_sp']] * $row['gia_sp'];
                        ?>
                            <table width="100%">
                                <tr>
                                    <td class="cart-item-img" width="25%" rowspan="4"><img width="200" height="200" src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></td>
                                    <td width="15%">Sản phẩm:</td>
                                    <td class="cart-item-title" width="40%"><?php echo $row['ten_sp'] ?></td>
                                </tr>
                                <tr>
                                    <td>Giá:</td>
                                    <td><span class="product-price" data-price="<?php echo $row['gia_sp'] ?>"><?php echo number_format($row['gia_sp'], 0, ',', '.') ?>₫</span></td>
                                </tr>
                                <tr>
                                    <td>Số lượng:</td>
                                    <td>
                                        <div class="quantity-control">
                                            <button type="button" class="decrement">-</button>
                                            <input type="number" name="sl[<?php echo $row['id_sp'] ?>]" value="<?php echo $_SESSION['giohang'][$row['id_sp']] ?>" class="quantity-input" min="0" data-max="<?php echo $row['so_luong'] ?>" />
                                            <button type="button" class="increment">+</button>
                                            <?php if ($row['so_luong'] > 0): ?>
                                                <span class="stock-info"><?php echo $row['so_luong'] ?> sản phẩm có sẵn</span>
                                            <?php else: ?>
                                                <!-- <span class="stock-info out-of-stock">Hết hàng</span> -->
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="chucnang/giohang/xoahang.php?id_sp=<?php echo $row['id_sp'] ?>"><i class="fa-solid fa-trash " style="color: #ea1f29;"></i> Xóa sản phẩm</a></td>
                                </tr>
                            </table>
                        <?php
                            $totalPriceAll += $totalPrice;
                        }
                        ?>
                        <input type="hidden" name="update_cart" value="1" />
                    </form>
                </div>

                <div class="thaotac">
                    <p>Tổng giá trị giỏ hàng là: <span id="total-price"><?php echo number_format($totalPriceAll, 0, ',', '.') ?>₫</span></p>
                    <p><a href="index.php">Thêm sản phẩm</a> <span> </span> <a href="chucnang/giohang/xoahang.php?id_sp=0">Xóa hết sản phẩm</a> <span> </span> <a href="index.php?page_layout=muahang">Thanh toán</a></p>
                </div>
        <?php
            } else {
                echo '
                        <div class="empty-cart">
                            <a href="index.php" class="back-link">Quay lại trang chủ</a>
                            <img src="anh/empty-cart.png" alt="Giỏ hàng trống">
                            <p>Giỏ hàng trống</p>
                        </div>';
            }
        } else {
            echo '
                    <div class="empty-cart">
                        <a href="index.php" class="back-link">Quay lại trang chủ</a>
                        <img src="anh/empty-cart.png" alt="Giỏ hàng trống">
                        <p>Giỏ hàng trống</p>
                    </div>';
        }
        ?>
    </div>
</div>

<script>
    function formatCurrency(value) {
        return value.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });
    }

    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.previousElementSibling;
            let maxQuantity = parseInt(input.dataset.max);
            let currentQuantity = parseInt(input.value);

            if (currentQuantity < maxQuantity) {
                input.value = currentQuantity + 1;
                document.getElementById('giohang').submit(); // Gửi form để cập nhật giỏ hàng
            } else {
                alert('Số lượng bạn chọn đã đạt mức tối đa của sản phẩm này.');
            }
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.nextElementSibling;
            let quantity = parseInt(input.value);
            if (quantity > 0) {
                quantity--;
                input.value = quantity;
                if (quantity === 0) {
                    confirmDeletion(input);
                } else {
                    document.getElementById('giohang').submit(); // Gửi form để cập nhật giỏ hàng
                }
            }
        });
    });

    function confirmDeletion(input) {
        const productName = input.closest('table').querySelector('.cart-item-title').textContent.trim();
        if (confirm(`Bạn chắc chắn muốn bỏ sản phẩm này?\n\n${productName}`)) {
            document.getElementById('giohang').submit(); // Gửi form để cập nhật giỏ hàng
        } else {
            input.value = 1; // Giữ lại số lượng là 1 nếu người dùng không muốn xóa
        }
    }

    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            const row = input.closest('table');
            const price = parseFloat(row.querySelector('.product-price').dataset.price);
            const quantity = parseInt(input.value) || 0;
            totalPrice += price * quantity;
        });

        document.getElementById('total-price').textContent = formatCurrency(totalPrice);
    }

    // Xử lý sự kiện click trên các liên kết xóa sản phẩm
    document.querySelectorAll('.fa-trash').forEach(function(trashIcon) {
        trashIcon.parentElement.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
            const productName = this.closest('table').querySelector('.cart-item-title').textContent.trim();
            const deleteUrl = this.href; // Lưu lại URL để xóa sản phẩm

            if (confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}" khỏi giỏ hàng không?`)) {
                window.location.href = deleteUrl; // Chuyển hướng đến URL xóa sản phẩm
            }
        });
    });

    // Xử lý sự kiện click trên liên kết "Xóa hết sản phẩm"
    document.querySelector('a[href*="xoahang.php?id_sp=0"]').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng không?')) {
            window.location.href = this.href; // Chuyển hướng đến URL xóa tất cả sản phẩm
        }
    });


    // Cập nhật giá trị tổng khi trang được tải
    document.addEventListener('DOMContentLoaded', updateTotalPrice);
</script>