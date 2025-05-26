<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<div class="prd-block">
    <div class="title-container">
        <h2 class="section-title"><?php
            $ten_dm = $_GET['ten_dm'];
            echo $ten_dm;
        ?></h2>
    </div>
    <div class="pr-list">
    <?php
        $sql="SELECT * FROM sanpham ORDER BY id_sp DESC";
        $query=mysqli_query($conn, $sql);
    ?>
    <?php
        $id_dm = $_GET['id_dm'];
        //Số bản ghi trên trang
        $rowPerPage = 8;
        //Số trang
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        //Vị trí
        $perRow = $page*$rowPerPage-$rowPerPage;
        $sql = "SELECT * FROM sanpham WHERE id_dm = $id_dm LIMIT $perRow,$rowPerPage";
        $query = mysqli_query($conn, $sql);
        //Tổng số bản ghi
        $totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE id_dm = $id_dm"));
        //Tổng số trang
        $totalPage = Ceil($totalRow/$rowPerPage);
        $listPage = '';
        //Nút trang trước và trang đầu
        if($page>1){
            $listPage .= '<a href="index.php?page_layout=danhsachsp&id_dm='.$id_dm.'&ten_dm='.$ten_dm.'&page=1"> First </a>';
            $prev = $page-1;
            $listPage .= '<a href="index.php?page_layout=danhsachsp&id_dm='.$id_dm.'&ten_dm='.$ten_dm.'&page='.$prev.'"> << </a>';
        }
        //Các phím số
        for($i=1;$i<=$totalPage;$i++){
            if($i==$page){
                $listPage .=  '<span> '.$i.' </span>';
            }else{
                $listPage .= '<a href="index.php?page_layout=danhsachsp&id_dm='.$id_dm.'&ten_dm='.$ten_dm.'&page='.$i.'"> '.$i.' </a>';
            }
        }
        //Nút trang sau và trang cuối
        if($page<$totalPage){
            $next = $page+1;
            $listPage .= '<a href="index.php?page_layout=danhsachsp&id_dm='.$id_dm.'&ten_dm='.$ten_dm.'&page='.$next.'"> >> </a>';
            $listPage .= '<a href="index.php?page_layout=danhsachsp&id_dm='.$id_dm.'&ten_dm='.$ten_dm.'&page='.$totalPage.'"> Last </a>';
           
        }
        while($row = mysqli_fetch_array($query)){
    ?>
    	<div class="prd-item">
        	<a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><img src="quantri/anh/<?php echo $row['anh_sp'] ?>" /></a>
            <p class="prd-name"><a href="index.php?page_layout=chitietsp&id_sp=<?php echo $row['id_sp'] ?>"><?php echo $row['ten_sp'] ?></a></p>
            <p class="price"><span>Giá: <?php echo number_format($row['gia_sp'], 0, ',', '.') ?>₫</span></p>
        </div>
    <?php
        }
    ?>
    </div>
</div>

<div id="pagination"><?php echo $listPage ?></div>
