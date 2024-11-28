<?php
$username = $_POST["username"];
$password = $_POST["password"];
$realname = $_POST["realname"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$image = $_POST["image"];
$status = $_POST["status"];

$sql = "UPDATE user set image = '$image', password = '$password', realname = '$realname', email = '$email', mobile = '$mobile', status = '$status' WHERE username = '$username'";

$link = mysqli_connect('localhost', 'root', '', 'coffee');
$result = mysqli_query($link,$sql);
if($result){
    echo "<script>alert('ข้อมูอได้รับการแก้ไขแล้ว');</script>";
    echo "<script>window.location='../user/show_all_users.php?username=$username';</script>";
}else{
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
    echo "<script>window.location='../user/show_all_users.php?username=$username';</script>";
}
?>