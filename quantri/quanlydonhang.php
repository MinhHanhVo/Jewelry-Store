<?php
// Start session and connect to the database
require "../config/ketnoi.php";

// Handle order status update
if (isset($_POST['update_status'])) {
    $id_donhang = $_POST['id_donhang'];
    $trang_thai = $_POST['trang_thai'];

    $sql = "UPDATE donhang SET trang_thai = '$trang_thai' WHERE id_donhang = $id_donhang";
    mysqli_query($conn, $sql);
}

// Initialize search keyword
$search_keyword = '';

// Check if a search query was submitted
if (isset($_GET['search'])) {
    $search_keyword = $_GET['search'];
    // Sanitize the search input
    $search_keyword = mysqli_real_escape_string($conn, $search_keyword);

    // Modify the SQL query to include search conditions
    $sql = "SELECT * FROM donhang 
            WHERE ten_khachhang LIKE '%$search_keyword%' 
               OR email LIKE '%$search_keyword%' 
               OR so_dien_thoai LIKE '%$search_keyword%'
            --    OR id_donhang LIKE '%$search_keyword%'
            ORDER BY 
                CASE 
                    WHEN trang_thai = 'Chờ giao hàng' THEN 1
                    WHEN trang_thai = 'Đang giao hàng' THEN 2
                    ELSE 3
                END, ngay_dat DESC";
} else {
    // Default SQL query if no search query is submitted
    $sql = "SELECT * FROM donhang ORDER BY 
            CASE 
                WHEN trang_thai = 'Chờ giao hàng' THEN 1
                WHEN trang_thai = 'Đang giao hàng' THEN 2
                ELSE 3
            END, ngay_dat DESC";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/quanly_donhang.css" />
    <script type="text/javascript">
        // JavaScript to toggle the visibility of orders based on status
        function togglePaidOrders() {
            var paidOrders = document.querySelectorAll('.paid-order');
            var button = document.querySelector('.show-paid-orders-button');
            var isActive = button.classList.contains('active');

            paidOrders.forEach(function(order) {
                order.style.display = isActive ? 'table-row' : 'none';
            });

            // Toggle the active class
            button.classList.toggle('active');
        }

        function togglePendingOrders() {
            var pendingOrders = document.querySelectorAll('.pending-order');
            var button = document.querySelector('.show-pending-orders-button');
            var isActive = button.classList.contains('active');

            pendingOrders.forEach(function(order) {
                order.style.display = isActive ? 'table-row' : 'none';
            });

            // Toggle the active class
            button.classList.toggle('active');
        }

        function toggleInTransitOrders() {
            var inTransitOrders = document.querySelectorAll('.in-transit-order');
            var button = document.querySelector('.show-in-transit-orders-button');
            var isActive = button.classList.contains('active');

            inTransitOrders.forEach(function(order) {
                order.style.display = isActive ? 'table-row' : 'none';
            });

            // Toggle the active class
            button.classList.toggle('active');
        }
    </script>
</head>

<body class="order-management-body">
    <h2 class="order-management-title">Quản lý đơn hàng</h2>

    <!-- Search form -->
    <form method="get">
        <input class="timkiem" type="text" name="search" value="<?php echo htmlspecialchars($search_keyword); ?>" placeholder="Tìm kiếm đơn hàng..." />
        <input type="submit" value="Tìm kiếm" class="search-button" />
        <?php if (!empty($search_keyword)) { ?>
            <!-- Back button to reset the search and show all orders -->
            <a href="quantri.php?page_layout=quanlydonhang" class="back-button">Quay lại</a>
        <?php } ?>
    </form>

    <?php
    // Check if any rows were returned by the query
    if (mysqli_num_rows($result) > 0) {
    ?>
        <!-- Buttons to show/hide orders by status -->
        <button class="show-button show-paid-orders-button" onclick="togglePaidOrders()">Đơn hàng đã thanh toán</button>
        <button class="show-button show-pending-orders-button" onclick="togglePendingOrders()">Đơn hàng chờ giao hàng</button>
        <button class="show-button show-in-transit-orders-button" onclick="toggleInTransitOrders()">Đơn hàng đang giao hàng</button>


        <table class="order-management-table">
            <tr class="order-management-header">
                <th>ID Đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt</th>
                <th>PTTT</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
                <th></th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) {
                $rowClass = '';
                if ($row['trang_thai'] == 'Đã thanh toán') {
                    $rowClass = 'paid-order';
                } elseif ($row['trang_thai'] == 'Chờ giao hàng') {
                    $rowClass = 'pending-order';
                } elseif ($row['trang_thai'] == 'Đang giao hàng') {
                    $rowClass = 'in-transit-order';
                }
            ?>
                <tr class="order-management-row <?php echo $rowClass; ?>">
                    <form method="post">
                        <td><?php echo $row['id_donhang']; ?></td>
                        <td><?php echo $row['ten_khachhang']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['so_dien_thoai']; ?></td>
                        <td><?php echo $row['dia_chi']; ?></td>
                        <td><?php echo $row['ngay_dat']; ?></td>
                        <td><?php echo $row['phuong_thuc_thanh_toan']; ?></td>
                        <td>
                            <select name="trang_thai" class="order-status-select">
                                <option value="Chờ giao hàng" <?php if ($row['trang_thai'] == 'Chờ giao hàng') echo 'selected'; ?>>Chờ giao hàng</option>
                                <option value="Đang giao hàng" <?php if ($row['trang_thai'] == 'Đang giao hàng') echo 'selected'; ?>>Đang giao hàng</option>
                                <option value="Đã thanh toán" <?php if ($row['trang_thai'] == 'Đã thanh toán') echo 'selected'; ?>>Đã thanh toán</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id_donhang" value="<?php echo $row['id_donhang']; ?>" />
                            <input type="submit" name="update_status" value="Cập nhật" class="update-status-button" />
                        </td>
                        <td>
                            <a href="quantri.php?page_layout=chitietdonhang&id_donhang=<?php echo $row['id_donhang']; ?>" class="view-details-link">Xem Chi Tiết</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </table>
    <?php
    } else {
        // If no rows are returned, display a message
        echo "<p class='dhktt'>Đơn hàng không tồn tại!</p>";
    }
    ?>

</body>

</html>