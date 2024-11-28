<?php
$orderID = $_REQUEST['orderID'];
$username = $_REQUEST['username'];
include('database.php');
$sql = "DELETE FROM coffeeOrder WHERE orderID='$orderID'";
$result = mysqli_query($conn, $sql);
$sql1 = "DELETE FROM orderdetail WHERE orderID='$orderID'";
$result2 = mysqli_query($conn, $sql1);
if($result or $result2)
{
    header("Location: bill.php?username=$username&orderID=$orderID");
    exit();
}
?>