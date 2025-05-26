
<?php
// Bắt đầu session
//session_start();

// Kết nối tới cơ sở dữ liệu
require "cauhinh/ketnoi.php";

// Khởi tạo biến để lưu thông báo lỗi cho từng trường
$ten_error = $mail_error = $dt_error = $dc_error = '';

if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $ten = trim($_POST['ten']);
    $mail = trim($_POST['mail']);
    $dt = trim($_POST['dt']);
    $dc = trim($_POST['dc']);
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

    // if (empty($dt)) {
    //     $dt_error = 'Vui lòng nhập số điện thoại.';
    //     $has_error = true;
    // } elseif (!ctype_digit($dt)) {
    //     $dt_error = 'Số điện thoại không hợp lệ.';
    //     $has_error = true;
    // }
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
    if (!$has_error) {
        $tong_gia = 0;

        // Tính tổng giá trị đơn hàng
        foreach ($_SESSION['giohang'] as $id_sp => $sl) {
            $sql = "SELECT gia_sp, so_luong FROM sanpham WHERE id_sp = $id_sp";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $tong_gia += $sl * $row['gia_sp'];
        }

        // Thực hiện insert vào bảng donhang
        $sql = "INSERT INTO donhang (ten_khachhang, email, so_dien_thoai, dia_chi, tong_gia, phuong_thuc_thanh_toan) 
        VALUES ('$ten', '$mail', '$dt', '$dc', $tong_gia, '$phuong_thuc_thanh_toan')";
        mysqli_query($conn, $sql);
        $id_donhang = mysqli_insert_id($conn); // Lấy id đơn hàng vừa tạo

        // Thực hiện insert vào bảng chitiet_donhang
        foreach ($_SESSION['giohang'] as $id_sp => $sl) {
            $sql = "SELECT ten_sp, gia_sp, so_luong FROM sanpham WHERE id_sp = $id_sp";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $ten_sanpham = $row['ten_sp'];
            $gia = $row['gia_sp'];
            $thanh_tien = $sl * $gia;

            // Insert chi tiết đơn hàng
            $sql = "INSERT INTO chitiet_donhang (id_donhang, id_sanpham, ten_sanpham, gia, so_luong, thanh_tien) 
                    VALUES ($id_donhang, $id_sp, '$ten_sanpham', $gia, $sl, $thanh_tien)";
            mysqli_query($conn, $sql);

            // Cập nhật lại số lượng sản phẩm
            $so_luong_moi = $row['so_luong'] - $sl;
            $sql_update = "UPDATE sanpham SET so_luong = $so_luong_moi WHERE id_sp = $id_sp";
            mysqli_query($conn, $sql_update);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        unset($_SESSION['giohang']);

        // Redirect sau khi xử lý form
        header('location: index.php?page_layout=hoanthanh');
        exit(); // Đảm bảo thoát sau khi điều hướng
    }
}
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
            <?php
            $arrId = array();
            // Lấy ra id sản phẩm từ mảng session
            foreach ($_SESSION['giohang'] as $id_sp => $sl) {
                $arrId[] = $id_sp;
            }
            // Tách mảng arrId thành 1 chuỗi và ngăn cách bởi dấu ,
            $strID = implode(',', $arrId);
            $sql = "SELECT * FROM sanpham WHERE id_sp IN ($strID)";
            $query = mysqli_query($conn, $sql);
            $totalPriceAll = 0;
            while ($row = mysqli_fetch_array($query)) {
                $totalPrice = $_SESSION['giohang'][$row['id_sp']] * $row['gia_sp'];
            ?>
                <tr>
                    <td class="prd-name"><?php echo $row['ten_sp'] ?></td>
                    <td class="prd-price"><?php echo number_format($row['gia_sp'], 0, ',', '.') ?>₫</td>
                    <td class="prd-number"><?php echo $_SESSION['giohang'][$row['id_sp']] ?></td>
                    <td class="prd-total"><?php echo number_format($totalPrice, 0, ',', '.') ?>₫</td>
                </tr>
            <?php
                $totalPriceAll += $totalPrice;
            }
            ?>
            <tr>
                <td class="prd-name">Tổng giá trị hóa đơn là:</td>
                <td colspan="2"></td>
                <td class="prd-total"><span><?php echo number_format($totalPriceAll, 0, ',', '.') ?>₫</span></td>
            </tr>
        </table>
    </div>

    <div class="form-payment">
        <form method="post">
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
