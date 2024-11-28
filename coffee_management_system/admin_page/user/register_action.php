<?php
$username = $_POST['username'];
$password = $_POST['password'];
$realname = $_POST['realname'];
$userType = "Employee";
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$createDate = date("Y-m-d");
$status = '1';
$image = $_POST['image'];

$link = mysqli_connect('localhost', 'root', '', 'coffee');
$sql = "INSERT INTO user(username, password, realname, userType, mobile, email,  createDate, image, status) VALUES ('$username', '$password', '$realname', '$userType', '$mobile', '$email', '$createDate', '$image', '$status')";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<script>alert('มีข้อผิดพลาดบางอย่าง');</script>";
    echo "<script>window.location='register.php';</script>";
} else {
    echo "<script>alert('สร้างบัญชีผู้ใช้เสร็จสิ้น');</script>";
    echo "<script>window.location='show_all_users.php?username=$username';</script>";
}

mysqli_close($link);
?>