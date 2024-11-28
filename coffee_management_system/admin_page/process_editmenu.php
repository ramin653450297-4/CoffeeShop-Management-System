<?php
$username = $_POST['username'];
$menuID = $_POST['menuID'];
$menuname = $_POST['menuname'];
$price = $_POST['price'];
$image = $_POST['image'];
include('database.php');
$sql = "UPDATE menu SET menuname='$menuname',price='$price',image='$image' WHERE menuID='$menuID'";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('แก้ไขเมนูเสร็จสิ้น');</script>";
    echo "<script>window.location='editmenu_page.php?username=$username';</script>";
}
?>