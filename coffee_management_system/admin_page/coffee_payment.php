<?php 
    include('database.php');
    $username = $_REQUEST['username'];
    $totalprice = $_REQUEST['totalprice'];
    $orderID = $_REQUEST['orderID'];
    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-m-d H:i:s");
    $payment = $_POST['payment'];
    $picture = $_POST['picture'];

    $sql = "INSERT INTO payment(orderID, paymentType, orderDate, totalprice,picture) VALUES ('$orderID','$payment','$date','$totalprice','$picture')";
    $result = mysqli_query($conn,$sql);
    $sql2 = "UPDATE coffeeOrder SET billstatus = 'ชำระเงินเสร็จสิ้น' WHERE orderID=$orderID";
    $result2 = mysqli_query($conn,$sql2);

    if($result && $result2){
        echo "<script>alert('ชำระเงินเสร็จสิ้น 🧾');</script>";
        echo "<script>window.location='menu.php?&username=$username';</script>";
    }else{
        echo "fail";
    }
?>