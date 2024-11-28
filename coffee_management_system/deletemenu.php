<?php
$username = $_REQUEST['username'];
$menuID = $_REQUEST['menuID'];
include('database.php');
$sql = "DELETE FROM menu WHERE menuID='$menuID'";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('ลบเมนูเสร็จสิ้น');</script>";
    echo "<script>window.location='editmenu_page.php?username=$username';</script>";
}
?>