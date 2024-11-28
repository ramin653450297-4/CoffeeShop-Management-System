<?php
include('database.php');

$orderID = $_GET['orderID'];

$sql = "SELECT c.*, d.*, m.menuname 
        FROM orderDetail c 
        JOIN coffeeOrder d ON c.orderID = d.orderID 
        JOIN menu m ON m.menuID = c.menuID 
        WHERE d.orderID = '$orderID'";

$result = mysqli_query($conn, $sql);

$totalPrice = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .order-info {
            margin-bottom: 10px;
        }
        .order-info p {
            margin: 5px 0;
        }
        .item-list {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
            margin-bottom: 10px;
        }
        .item {
            margin-bottom: 5px;
        }
        .item p {
            margin: 2px 0;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ใบเสร็จรับเงิน</h1>
        </div>
        <div class="order-info">
            <?php
                echo "<p>คำสั่งซื้อที่: $orderID</p>";

            ?>
        </div>
        <div class="item-list">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='item'>";
                    echo "<p>เมนูที่สั่ง: {$row['menuname']}</p>";
                    echo "<p>ราคา: {$row['totalprice']}</p>";
                    echo "</div>";

                    $totalPrice += $row['totalprice'];
                }
            ?>
        </div>
        <div class="total">
            <?php
                echo "<p>ราคารวม: $totalPrice</p>";
            ?>
        </div>
        <div class="footer">
            <p>ขอบคุณที่ใช้บริการ</p>
        </div>
        <script>
          window.onload = function() {
        window.print();
    };
    window.onafterprint = function(event) {
        window.close();
    };
    </script>
    </div>
</body>
</html>