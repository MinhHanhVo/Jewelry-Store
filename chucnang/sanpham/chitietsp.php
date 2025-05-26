<link rel="stylesheet" type="text/css" href="css/chitietsp.css" />
<div class="prd-block">
    <div class="prd-only">
        <?php
        $id_sp = $_GET['id_sp'];
        $sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $so_luong = $row['so_luong']; // Lấy số lượng sản phẩm
        ?>

        <div class="prd-img" style="position: relative;">
            <div id="slide">
                <img id="hinh" style="width: 400px;height: 400px;margin-top:5px;margin-left:50px;" src="quantri/anh/<?php echo $row['anh_sp'] ?>" />
                <i class="fa fa-chevron-circle-left" style="position:absolute;top:25%;left:50px;font-size: 30px;color:#b29696" onclick="prev()"></i>
                <i class="fa fa-chevron-circle-right" style="position:absolute;top:25%;right:21px;font-size: 30px;color:#b29696" onclick="next()"></i>
                <div class="small-img" style="width: 160%;margin-top:30px;margin-left:75px;">
                    <img src="quantri/anh/<?php echo $row['anh_sp'] ?>" onclick="TransPhoto(this)">
                    <img src="quantri/anh/<?php echo $row['anh_sp'] ?>" onclick="TransPhoto(this)">
                    <img src="quantri/anh/<?php echo $row['anh_sp'] ?>" onclick="TransPhoto(this)">
                    <img src="quantri/anh/<?php echo $row['anh_sp'] ?>" onclick="TransPhoto(this)">
                </div>
            </div>
            <div class="rating-box">
                <h3 style="text-align: center;">Đánh giá sản phẩm</h3>
                <div class="rating-info">
                    <span class="rating-score">5/5</span>
                    <span class="rating-text">Tổng số 04 lượt đánh giá</span>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="like-info">
                    <i class="fa fa-thumbs-up"></i>
                    <span class="like-count">04</span>
                    <span class="like-text">Đánh giá yêu thích sản phẩm này</span>
                </div>
            </div>
            <div class="rating-bar">
                <div class="rating-row">
                    <div class="rating-label">5 Sao</div>
                    <div class="rating-bar-fill">
                        <div class="rating-fill" style="width: 100%;">100%</div>
                    </div>
                </div>
                <div class="rating-row">
                    <div class="rating-label">4 Sao</div>
                    <div class="rating-bar-fill">
                        <div class="rating-fill empty" style="width: 0%;">0%</div>
                    </div>
                </div>
                <div class="rating-row">
                    <div class="rating-label">3 Sao</div>
                    <div class="rating-bar-fill">
                        <div class="rating-fill empty" style="width: 0%;">0%</div>
                    </div>
                </div>
                <div class="rating-row">
                    <div class="rating-label">2 Sao</div>
                    <div class="rating-bar-fill">
                        <div class="rating-fill empty" style="width: 0%;">0%</div>
                    </div>
                </div>
                <div class="rating-row">
                    <div class="rating-label">1 Sao</div>
                    <div class="rating-bar-fill">
                        <div class="rating-fill empty" style="width: 0%;">0%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 prd-intro" style="margin-left: 100px;margin-right:50px">
            <h3 style="border-bottom:1px dashed black;margin-bottom: 20px;text-align: center;"><?php echo $row['ten_sp'] ?></h3>
            <p style="line-height:2em;text-align: justify;"><?php echo $row['chi_tiet_sp'] ?></p>
            <p>Giá sản phẩm: <span><?php echo number_format($row['gia_sp'], 0, ',', '.') ?> VNĐ</span></p>
            <p>Khuyến mãi: <span><?php echo $row['khuyen_mai'] ?></span></p>

            <!-- Hiển thị số lượng sản phẩm -->
            <p>Số lượng:
                <?php if ($so_luong > 0): ?>
                    <span><?php echo $so_luong ?> sản phẩm có sẵn</span>
                <?php else: ?>
                    <span class="out-of-stock">Sản phẩm này hiện không có sẵn</span>
                <?php endif; ?>
            </p>
            <hr>
            <div style="margin-top: 50px;text-align: center;">
                <a href="javascript:void(0);" onclick="checkStockAndProceed(<?php echo $so_luong; ?>, 'chucnang/giohang/themhang.php?id_sp=<?php echo $row['id_sp']; ?>')">
                    <button type="button" class="btn-success">Thêm vào giỏ hàng</button>
                </a>

                <a href="javascript:void(0);" onclick="checkStockAndProceed(<?php echo $so_luong; ?>, 'index.php?page_layout=muahangtructiep&id_sp=<?php echo $row['id_sp']; ?>')">
                    <button type="button" class="btn-success">Mua ngay</button>
                </a>
            </div>
            <div style="border: 1px solid #a49a9a4f;border-radius: 10px;margin-top: 50px;">
                <div style="display: block;padding:5px;background-color: #a49a9a4f;border-top-left-radius: 10px;
                border-top-right-radius: 10px;">
                    <a>
                        <span>
                            <span>
                                <i class="fa fa-gift" aria-hidden="true" style="font-size: 20px;"></i>
                            </span>
                            <span>BỘ QUÀ CAO CẤP SỐ LƯỢNG CÓ HẠN</span>
                        </span>
                    </a>
                </div>

                <table style="border:1px solid #a49a9a4f;padding: 15px 10px;border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;">
                    <tr>
                        <td style="border:1px solid #a49a9a4f">
                            <div style="display: flex;">
                                <figure>
                                    <img style="border-radius: 10px;margin-left: 10px;" width="120" height="120" src="https://lili.vn/wp-content/uploads/2020/10/Anh-hop-san-pham-LiLi-Final-400x400.jpg">
                                </figure>
                                <div>
                                    <h3 style="color: #000;font-family:Open Sans,Sans-serif;font-size: 16px;font-weight: 500;margin-top: 50px;margin-left: 20px;">Bộ đóng gói cao cấp, ý nghĩa</h3>
                                </div>
                            </div>
                        </td>


                        <td style="border:1px solid #a49a9a4f">
                            <div style="display: flex;">
                                <figure class="elementor-image-box-img">
                                    <img width="120" height="120" src="https://lili.vn/wp-content/uploads/2022/05/Hop-dung-trang-suc-boc-da-vuong-mien-Royal-LILI_719713_1-400x400.jpg">
                                </figure>
                                <div>
                                    <h3 style="color: #000;font-family:Open Sans,Sans-serif;font-size: 16px;font-weight: 500;margin-top: 50px;margin-left: 20px;">Hộp đựng trang sức bọc da Royal</h3>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr style="border:1px solid #a49a9a4f">
                        <td style="border:1px solid #a49a9a4f">
                            <div style="display: flex;">
                                <figure class="elementor-image-box-img">
                                    <img width="120" height="120" src="https://lili.vn/wp-content/uploads/2020/10/Hop-dung-do-trang-suc-mini-nam-nu-trang-boc-da-Zelda-LILI_878639_10-400x400.jpg">
                                </figure>
                                <div>
                                    <h3 style="color: #000;font-family:Open Sans,Sans-serif;font-size: 16px;font-weight: 500;margin-top: 50px;margin-left: 20px;">Hộp đựng đa trang sức bọc nhung</h3>
                                </div>
                            </div>
                        </td>

                        <td style="border:1px solid #a49a9a4f">
                            <div style="display: flex;">
                                <figure class="elementor-image-box-img">
                                    <img width="120" height="120" src="https://lili.vn/wp-content/uploads/2020/10/Qua-tang-bi-mat-dac-biet-5-400x400.png">
                                </figure>
                                <div>
                                    <h3 style="color: #000;font-family:Open Sans,Sans-serif;font-size: 16px;font-weight: 500;margin-top: 50px;margin-left: 20px;">Món quà bí mật đặc biệt Mystery</h3>
                                </div>
                            </div>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="prd-comment">
        <h3>Bình luận sản phẩm</h3>
        <form method="post">
            <ul>
                <li class="required">Tên <br /><input required type="text" name="ten" /></li>
                <li class="required">Số điện thoại <br /><input required type="text" name="dien_thoai" /></li>
                <li class="required">Nội dung <br /><textarea required name="binh_luan"></textarea></li>
                <li class="binhluansm"><input type="submit" name="submit" value="Bình luận" /></li>
            </ul>
        </form>
    </div>
    
    </div>
</div>


<script>
    function checkStockAndProceed(stock, url) {
        if (stock > 0) {
            window.location.href = url;
        } else {
            alert('Sản phẩm này hiện không có sẵn');
        }
    }
</script>
<script>
    var arr_hinh = [
        "quantri/anh/<?php echo $row['anh_sp'] ?>",
        "quantri/anh/<?php echo $row['anh_sp'] ?>",
        "quantri/anh/<?php echo $row['anh_sp'] ?>",
        "quantri/anh/<?php echo $row['anh_sp'] ?>"
    ]

    var index = 0;

    function next() {
        index++;
        if (index >= arr_hinh.length) index = 0;

        var hinh = document.getElementById("hinh");
        hinh.src = arr_hinh[index];
    }

    function prev() {
        index--;
        if (index < 0) index = arr_hinh.length - 1;

        var hinh = document.getElementById("hinh");
        hinh.src = arr_hinh[index];
    }

    function TransPhoto(smallImg) {
        var allImg = document.getElementById("hinh");
        allImg.src = smallImg.src;
    }
</script>