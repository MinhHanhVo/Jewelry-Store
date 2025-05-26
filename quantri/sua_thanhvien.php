<?php
require "../cauhinh/ketnoi.php";

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    
    $sql = "UPDATE thanhvien SET email = '$email', mat_khau = '$mat_khau' WHERE id_thanhvien = $id";
    mysqli_query($conn, $sql);
    header("Location: quantri.php?page_layout=thanhvien");
    exit();
}

$sql = "SELECT * FROM thanhvien WHERE id_thanhvien = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
<link rel="stylesheet" type="text/css" href="css/them_sua_tv.css" />

<form method="POST" action="sua_thanhvien.php?id=<?php echo $id; ?>">
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
    <label>Password:</label>
    <input type="text" name="mat_khau" value="<?php echo $row['mat_khau']; ?>" required>
    <button type="submit">Cập nhật thành viên</button>
</form>
