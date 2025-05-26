<?php
session_start();
require "../config/ketnoi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Jewelry Admin</title>
    <link rel="stylesheet" type="text/css" href="css/quantri.css" />
    <script type="text/javascript">
        function confirmLogout() {
            return confirm("Bạn có muốn đăng xuất không?");
        }
    </script>
</head>

<body>
    <div id="header">
        <a href="#"><img src="anh/logo.png" /></a>
        <div id="navbar">
            <ul>
                <li id="admin-home"><a href="quantri.php?page_layout=quanlydonhang">Trang chủ</a></li>
                <li><a href="quantri.php?page_layout=thanhvien">Thành viên</a></li>
                <li><a href="quantri.php?page_layout=danhmucsp">Danh mục</a></li>
                <li><a href="quantri.php?page_layout=danhsachsp">Sản phẩm</a></li>
                <li><a href="quantri.php?page_layout=quanlydonhang">Quản lý đơn hàng</a></li>
            </ul>
            <div id="user-info">
                <p><span><?php echo $_SESSION['tk']; ?></span></p>
                <p><a href="dangxuat.php" onclick="return confirmLogout();">Đăng xuất</a></p>
            </div>
        </div>
    </div>
    <div id="body">
        <?php
        if (isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
                case 'themsp':
                    include_once('themsp.php');
                    break;
                case 'suasp':
                    include_once('suasp.php');
                    break;
                case 'danhsachsp':
                    include_once('danhsachsp.php');
                    break;
                case 'danhmucsp':
                    include_once('danhmucsp.php');
                    break;
                case 'thanhvien':
                    include_once('thanhvien.php');
                    break;
                case 'quanlydonhang':
                    include_once('quanlydonhang.php');
                    break;
                case 'chitietdonhang':
                    include_once('chitietdonhang.php');
                    break;
                case 'them_danhmuc':
                    include_once('them_danhmuc.php');
                    break;
                case 'sua_danhmuc':
                    include_once('sua_danhmuc.php');
                    break;
                case 'them_thanhvien':
                    include_once('them_thanhvien.php');
                    break;
                case 'sua_thanhvien':
                    include_once('sua_thanhvien.php');
                    break;
            }
        } else {
            include_once('quanlydonhang.php');
        }
        ?>

    </div>
</body>

</html>