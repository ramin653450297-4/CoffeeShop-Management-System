<?php
include('database.php');

if(isset($_REQUEST['username']) && isset($_REQUEST['orderID']) && isset($_REQUEST['orderDID'])) {
    $username = $_REQUEST['username'];
    $orderID = $_REQUEST['orderID'];
    $orderDID = $_REQUEST['orderDID'];
    $sql_fetch_price = "SELECT totalPrice FROM orderDetail WHERE orderDID='$orderDID'";
    $result_fetch_price = mysqli_query($conn, $sql_fetch_price);
    $row_fetch_price = mysqli_fetch_assoc($result_fetch_price);
    $price_to_subtract = $row_fetch_price['totalPrice'];

    $sql_delete_menu = "DELETE FROM orderDetail WHERE orderDID='$orderDID'";
    mysqli_query($conn, $sql_delete_menu);

    $sql_update_total = "UPDATE coffeeOrder 
                         SET totalPrice = (SELECT SUM(totalPrice) FROM orderDetail WHERE orderID='$orderID') 
                         WHERE orderID='$orderID'";
    mysqli_query($conn, $sql_update_total);

    echo "<script>alert('ลบเสร็จสิ้น');</script>";
    echo "<script>window.location='editreceipt.php?username=$username&orderID=$orderID';</script>";
} else {
    echo "<script>alert('พารามิเตอร์ที่จำเป็นไม่เพียงพอ');</script>";
    echo "<script>window.history.back();</script>";
}
?>