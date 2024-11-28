<?php
$username = $_REQUEST['username'];
include('../database.php');
$sql = "DELETE FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('ลบผู้ใช้เสร็จสิ้น');</script>";
    echo "<script>window.location='../user/show_all_users.php?username=$username';</script>";
}
else{
    echo "<script>alert('ไม่สสามารถลบได้');</script>";
    echo "<script>window.location='../user/show_all_users.php?username=$username';</script>";
}
?>