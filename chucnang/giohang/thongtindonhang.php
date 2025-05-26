<link rel="stylesheet" type="text/css" href="css/lichsudonhang.css" />

<?php
if (isset($_POST['search'])) {
    $phone = $_POST['phone'];

    // Kết nối đến cơ sở dữ liệu
    require "config/ketnoi.php";

    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Truy vấn để lấy thông tin đơn hàng dựa trên số điện thoại
    $sql = "SELECT * FROM donhang WHERE so_dien_thoai = '$phone'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='order-info'>";
        echo "<h3>Thông tin đơn hàng</h3>";
        echo "<table class='order-table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID Đơn Hàng</th>";
        echo "<th>Tên Khách Hàng</th>";
        echo "<th>Email</th>";
        echo "<th>Số Điện Thoại</th>";
        echo "<th>Địa Chỉ</th>";
        echo "<th>Tổng Giá</th>";
        echo "<th>Ngày Đặt</th>";
        echo "<th>Trạng Thái</th>";
        echo "<th>Chi Tiết</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_donhang'] . "</td>";
            echo "<td>" . $row['ten_khachhang'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['so_dien_thoai'] . "</td>";
            echo "<td>" . $row['dia_chi'] . "</td>";
            echo "<td>" . number_format($row['tong_gia'], 0, ',', '.') . "₫</td>";
            echo "<td>" . $row['ngay_dat'] . "</td>";
            echo "<td>" . $row['trang_thai'] . "</td>";
            echo "<td><a class='order-link' href='index.php?page_layout=chitietdonhang&id_donhang=" . $row['id_donhang'] . "'>Xem chi tiết</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='no-order'>Không tìm thấy đơn hàng với số điện thoại này.</p>";
    }

    mysqli_close($conn);
}
?>
