<link rel="stylesheet" type="text/css" href="css/danhsachtimkiem.css" />
<div class="prd-block">
<?php
    if(isset($_POST['stext'])){
        $stext = $_POST['stext'];
    }else{
        $stext = '';
    }
    $newStext = str_replace(' ', '%', $stext);
    $sql = "SELECT * FROM sanpham WHERE ten_sp LIKE '%$newStext%'";
    $query = mysqli_query($conn, $sql);
?>
	<h2>Kết quả tìm được với từ khóa <span class="skeyword">"<?php echo $stext ?>"</span></h2>
    <div class="pr-list">
    <?php
        while($row = mysqli_fetch_array($query)){
    ?>
    	<div class="prd-item">
        	<a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><img src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></a>
            <p class="prd-name"><a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><?php echo $row['ten_sp'] ?></a></p>
            <p class="price"><span>Giá: <?php echo $row['gia_sp'] ?>₫</span></p></p>
        </div>
    <?php
        }
    ?>
    </div>
</div>

