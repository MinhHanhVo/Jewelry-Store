<?php
ob_start();
// Kết nối tới cơ sở dữ liệu
require "config/ketnoi.php";

// Khởi tạo biến để lưu thông báo lỗi cho từng trường
$ten_error = $mail_error = $dt_error = $dc_error = '';

// Xử lý yêu cầu form mua ngay
if (isset($_POST['submit'])) {
    // Lưu thông tin đơn hàng vào bảng donhang
    $ten = $_POST['ten'];
    $mail = $_POST['mail'];
    $dt = $_POST['dt'];
    $dc = $_POST['dc'];
    $id_sp = $_POST['id_sp'];
    $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
    
    // Kiểm tra dữ liệu
    $has_error = false;

    if (empty($ten)) {
        $ten_error = 'Vui lòng nhập tên khách hàng.';
        $has_error = true;
    }

    if (empty($mail)) {
        $mail_error = 'Vui lòng nhập địa chỉ email.';
        $has_error = true;
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $mail_error = 'Địa chỉ email không hợp lệ.';
        $has_error = true;
    }

   
    if (empty($dt)) {
        $dt_error = 'Vui lòng nhập số điện thoại.';
        $has_error = true;
    } elseif (!ctype_digit($dt)) {
        $dt_error = 'Số điện thoại chỉ được chứa các chữ số.';
        $has_error = true;
    } elseif (strlen($dt) < 9 || strlen($dt) > 10) {
        $dt_error = 'Độ dài số điện thoại không hợp lệ.';
        $has_error = true;
    }

    
    if (empty($dc)) {
        $dc_error = 'Vui lòng nhập địa chỉ nhận hàng.';
        $has_error = true;
    }

    // Nếu không có lỗi, tiến hành xử lý đơn hàng
    if (!$has_error){
        $tong_gia = 0;

        // Lấy thông tin sản phẩm
        $sql = "SELECT gia_sp, so_luong FROM sanpham WHERE id_sp = $id_sp";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $gia_sp = $row['gia_sp'];
        $so_luong_con_lai = $row['so_luong'] - 1; // Cập nhật số lượng sản phẩm

        // Kiểm tra xem có đủ hàng không
        if ($so_luong_con_lai < 0) {
            echo 'Sản phẩm này đã hết hàng.';
            exit();
        }

        // Cập nhật số lượng sản phẩm
        $sql = "UPDATE sanpham SET so_luong = $so_luong_con_lai WHERE id_sp = $id_sp";
        mysqli_query($conn, $sql);

        $tong_gia = $gia_sp; // Chỉ có 1 sản phẩm

        // Thực hiện insert vào bảng donhang
        $sql = "INSERT INTO donhang (ten_khachhang, email, so_dien_thoai, dia_chi, tong_gia, phuong_thuc_thanh_toan) 
                VALUES ('$ten', '$mail', '$dt', '$dc', $tong_gia, '$phuong_thuc_thanh_toan')";
        mysqli_query($conn, $sql);
        $id_donhang = mysqli_insert_id($conn); // Lấy id đơn hàng vừa tạo

        // Thực hiện insert vào bảng chitiet_donhang
        $ten_sanpham = $_POST['ten_sanpham'];
        $thanh_tien = $gia_sp; // Chỉ có 1 sản phẩm, số lượng = 1

        $sql = "INSERT INTO chitiet_donhang (id_donhang, id_sanpham, ten_sanpham, gia, so_luong, thanh_tien) 
                VALUES ($id_donhang, $id_sp, '$ten_sanpham', $gia_sp, 1, $thanh_tien)";
        mysqli_query($conn, $sql);

        // Redirect sau khi xử lý form
        header('location: index.php?page_layout=hoanthanh');
        exit(); // Đảm bảo thoát sau khi điều hướng
    }  
    ob_end_flush();  
}

// Nếu không có form POST, lấy ID sản phẩm từ URL và hiển thị form
$id_sp = intval($_GET['id_sp']);
$sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/muahang.css" />
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="prd-block">
    <h2>Xác nhận hóa đơn thanh toán</h2>
    <div class="payment">
        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
            <tr id="invoice-bar">
                <td width="45%">Tên Sản phẩm</td>
                <td width="20%">Giá</td>
                <td width="15%">Số lượng</td>
                <td width="20%">Thành tiền</td>
            </tr>
            <tr>
                <td class="prd-name"><?php echo $product['ten_sp'] ?></td>
                <td class="prd-price"><?php echo number_format($product['gia_sp'], 0, ',', '.') ?>₫</td>
                <td class="prd-number">1</td>
                <td class="prd-total"><?php echo number_format($product['gia_sp'], 0, ',', '.') ?>₫</td>
            </tr>
            <tr>
                <td class="prd-name">Tổng giá trị hóa đơn là:</td>
                <td colspan="2"></td>
                <td class="prd-total"><span><?php echo number_format($product['gia_sp'], 0, ',', '.') ?>₫</span></td>
            </tr>
        </table>
    </div>

    <div class="form-payment">
        <form method="post">
            <input type="hidden" name="id_sp" value="<?php echo $product['id_sp']; ?>" />
            <input type="hidden" name="ten_sanpham" value="<?php echo $product['ten_sp']; ?>" />
            <ul>
            <li class="info-cus">
                    <label>Tên khách hàng</label><br />
                    <input required type="text" name="ten" value="<?php echo isset($ten) ? htmlspecialchars($ten) : ''; ?>" />
                    <div class="error-message"><?php echo $ten_error; ?></div>
                </li>
                <li class="info-cus">
                    <label>Địa chỉ Email</label><br />
                    <input required type="text" name="mail" value="<?php echo isset($mail) ? htmlspecialchars($mail) : ''; ?>" />
                    <div class="error-message"><?php echo $mail_error; ?></div>
                </li>
                <li class="info-cus">
                    <label>Số Điện thoại</label><br />
                    <input required type="text" name="dt" value="<?php echo isset($dt) ? htmlspecialchars($dt) : ''; ?>" />
                    <div class="error-message"><?php echo $dt_error; ?></div>
                </li>
                <li class="info-cus">
                    <label>Địa chỉ nhận hàng</label><br />
                    <input required type="text" name="dc" value="<?php echo isset($dc) ? htmlspecialchars($dc) : ''; ?>" />
                    <div class="error-message"><?php echo $dc_error; ?></div>
                </li>
                <li class="info-cus">
                    <label>Phương thức thanh toán</label><br />
                    <select name="phuong_thuc_thanh_toan" required>
                        <option value="Tiền mặt" <?php echo isset($phuong_thuc_thanh_toan) && $phuong_thuc_thanh_toan == 'Tiền mặt' ? 'selected' : ''; ?>>Tiền mặt</option>
                        <option value="Chuyển khoản ngân hàng" <?php echo isset($phuong_thuc_thanh_toan) && $phuong_thuc_thanh_toan == 'Chuyển khoản ngân hàng' ? 'selected' : ''; ?>>Chuyển khoản ngân hàng</option>
                        <option value="Ví MOMO" <?php echo isset($phuong_thuc_thanh_toan) && $phuong_thuc_thanh_toan == 'Ví MOMO' ? 'selected' : ''; ?>>Ví MOMO</option>
                    </select>
                </li>
                <li><input type="submit" name="submit" value="Xác nhận mua hàng" /> <input type="reset" name="reset" value="Làm lại" /></li>
                </ul>
        </form>
    </div>
</div>
</body>
</html>
