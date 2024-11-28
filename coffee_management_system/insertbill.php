<?php
$username = $_REQUEST['username'];
$billstatus = "รอการชำระเงิน";
$link = mysqli_connect('localhost', 'root', '', 'coffee') or die("Connect Failed" . mysqli_connect_error());

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO coffeeorder (orderDate, username, billstatus) VALUES ('$date', '$username', '$billstatus')";
$result = mysqli_query($link, $sql);

if ($result) {
    $orderID = mysqli_insert_id($link);
    header("Location: bill.php?username=$username&orderID=$orderID");
    exit;
} else {
    echo "Error inserting into 'order' table: " . mysqli_error($link);
}

mysqli_close($link);
?>