
<?php
session_start();
require "cauhinh/ketnoi.php";
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Trang sức Hạnh Phương</title>
    <script src="https://kit.fontawesome.com/7a44704f56.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/trangchu.css" />
    <link rel="stylesheet" type="text/css" href="css/header.css" />
    <link rel="stylesheet" type="text/css" href="css/footer.css" />
    <link rel="stylesheet" type="text/css" href="css/lienhe.css" />
    <link rel="stylesheet" type="text/css" href="css/banner.css" />

<!-- banner js -->
 <script>
    document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.slider-content img');
    let currentIndex = 0;

    // Hàm để chuyển đổi ảnh
    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    // Bắt đầu slideshow, chuyển ảnh sau mỗi 3 giây
    images[currentIndex].classList.add('active');
    setInterval(showNextImage, 3000);
});
 </script>
</head>

<body>
    <!-- Header -->
    <?php
    include_once('header.php');
    ?>
    <!-- End Header -->


    <!-- Banner -->
    <?php if (!isset($_GET['page_layout']) || in_array($_GET['page_layout'], ['home', ''])): ?>
        <div class="banner">
            <?php require "banner.php"; ?>
        </div>
    <?php endif; ?>

    <!--Main-->
    <div id="main">
        <?php
        if (isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
                case 'gioithieu':
                    require_once('chucnang/menungang/gioithieu.php');
                    break;
                case 'dichvu':
                    require_once('chucnang/menungang/dichvu.php');
                    break;
                case 'lienhe':
                    require_once('chucnang/menungang/lienhe.php');
                    break;
                case 'chitietsp':
                    require_once('chucnang/sanpham/chitietsp.php');
                    break;
                case 'danhsachsp':
                    require_once('chucnang/sanpham/danhsachsp.php');
                    break;
                case 'danhsachtimkiem':
                    require_once('chucnang/timkiem/danhsachtimkiem.php');
                    break;
                case 'giohang':
                    require_once('chucnang/giohang/giohang.php');
                    break;
                case 'muahang':
                    require_once('chucnang/giohang/muahang.php');
                    break;
                case 'hoanthanh':
                    require_once('chucnang/giohang/hoanthanh.php');
                    break;
                case 'lichsudonhang':
                    require_once('chucnang/giohang/lichsudonhang.php');
                    break;
                case 'thongtindonhang':
                    require_once('chucnang/giohang/thongtindonhang.php');
                    break;
                case 'chitietdonhang':
                    require_once('chucnang/giohang/chitietdonhang.php');
                    break;
                case 'muahangtructiep':
                    require_once('chucnang/giohang/muahangtructiep.php');
                    break;
                default:
                    require_once('chucnang/sanpham/sanphamdacbiet.php');
                    require_once('chucnang/sanpham/sanphammoi.php');
            }
        } else {

            require "chucnang/sanpham/sanphamdacbiet.php";
            require "chucnang/sanpham/sanphammoi.php";
        }
        ?>
    </div>
    <!-- Footer -->
    <div>
        <?php
        include_once('footer.php');
        ?>
    </div>
    <!-- End Footer -->
</body>

</html>