<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/lichsudonhang.css" />
</head>
<body>
    <div class="order-details">
        <?php
        if (isset($_GET['id_donhang'])) {
            $id_donhang = $_GET['id_donhang'];

            // Kết nối đến cơ sở dữ liệu
            require "../config/ketnoi.php";

            if (!$conn) {
                die("Kết nối không thành công: " . mysqli_connect_error());
            }

            // Truy vấn để lấy thông tin chi tiết đơn hàng
            $sql_details = "SELECT * FROM chitiet_donhang WHERE id_donhang = $id_donhang";
            $result_details = mysqli_query($conn, $sql_details);

            if (mysqli_num_rows($result_details) > 0) {
                echo "<h4>Chi Tiết Đơn Hàng</h4>";
                echo "<table>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                        </tr>";
                while ($detail = mysqli_fetch_assoc($result_details)) {
                    echo "<tr>
                            <td>" . $detail['ten_sanpham'] . "</td>
                            <td>" . number_format($detail['gia'], 0, ',', '.') . "₫</td>
                            <td>" . $detail['so_luong'] . "</td>
                            <td>" . number_format($detail['thanh_tien'], 0, ',', '.') . "₫</td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Không có chi tiết đơn hàng.</p>";
            }

            mysqli_close($conn);
        } else {
            echo "<p>Không có ID đơn hàng để hiển thị chi tiết.</p>";
        }
        ?>
    </div>

    <!-- Back to Homepage Button -->
    <a href="quantri.php?page_layout=quanlydonhang" class="back-to-homepage">Quay lại</a>
</body>
</html>
