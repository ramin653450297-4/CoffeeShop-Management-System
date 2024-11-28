<?php
$username = $_POST['username'];
$menuname = $_POST['menuname'];
$price = $_POST['price'];
$image = $_POST['image'];
include('database.php');
$sql = "INSERT INTO menu(menuname,price,image) VALUES('$menuname','$price','$image')";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('เพิ่มเมนูเสร็จสิ้น');</script>";
    echo "<script>window.location='editmenu_page.php?username=$username';</script>";
}
?>