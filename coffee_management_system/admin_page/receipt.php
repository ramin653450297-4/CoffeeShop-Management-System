<?php
include('database.php');
$username=$_REQUEST['username'];
$sql_show = "SELECT * FROM user WHERE username='$username'";
$result_show = mysqli_query($conn, $sql_show);
$row_show = mysqli_fetch_assoc($result_show);
$realname = $row_show['realname'];
$userType = $row_show['userType'];
$image = $row_show['image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipts</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .receipt {
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .receipt h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    .receipt p {
        margin: 5px 0;
    }

    .total {
        font-weight: bold;
        text-align: right;
        margin-top: 20px;
    }

    .insert-bill {
        display: block;
        text-align: center;
    }

    .insert-bill a {
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .insert-bill a:hover {
        background-color: #0056b3;
    }

    .payment-order {
        display: inline-block;
        padding: 10px 20px;
        color: white;
        background-color: #4caf50;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .payment-order:hover {
        background-color: #45a049;
    }
    .payment-succeed {
        display: inline-block;
        background-color: gray;
        padding: 10px 20px;
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 10px;
    }
    .edit-order {
        display: inline-block;
        padding: 10px 20px;
        color: white;
        background-color: #F6C645;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        margin-left: 155px;
    }
    .edit-succeed{
        display: inline-block;
        background-color: gray;
        padding: 10px 20px;
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 10px;
        margin-left: 85px;
    }
    </style>
</head>

<body>
<div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus icon'></i>
            <div class="logo_name">Coffee</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="dashboard.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="menu.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-coffee'></i>
                    <span class="links_name">Menu</span>
                </a>
                <span class="tooltip">Menu</span>
            </li>
            <li>
                <a href="bill.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-receipt'></i>
                    <span class="links_name">Order</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="receipt.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Receipt</span>
                </a>
                <span class="tooltip">Receipt</span>
            </li>
            <li>
                <a href="save.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="editmenu_page.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bxs-edit'></i>
                    <span class="links_name">edit</span>
                </a>
                <span class="tooltip">edit</span>
            </li>
            <li>
            <a href="../admin_page/user/show_all_users.php?username=<?php echo urlencode($username); ?>">
                <i class='bx bx-user'></i>
                <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="<?php echo $image; ?>" alt="Profile Image">
                    <div class="name_job">
                        <div class="name"><?=$realname?></div>
                        <div class="job"><?=$userType?></div>
                    </div>
                </div>
                <a href="../login.php" onclick="Del(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>
        <div class="container">
            <?php
    $sql = "SELECT c.*, d.*, m.* FROM orderDetail c 
        JOIN coffeeOrder d ON c.orderID = d.orderID 
        JOIN menu m ON m.menuID = c.menuID
        ORDER BY d.orderID DESC";

    $result = mysqli_query($conn,$sql);

    echo "
    <html>
    <head>
        <title>Receipts</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .receipt {
                width: 350px;
                margin: 0 auto;
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 10px;
            }
            .receipt h1 {
                text-align: center;
            }
            .receipt p {
                margin: 5px 0;
            }
            .receipt .total {
                font-weight: bold;
                text-align: right;
            }
            .menu-item {
                display: flex;
                justify-content: space-between;
            }
            h2{
                font-size: 32px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 10px;
                margin-top: -10px;
            }
            .menu-item {
                display: flex;
                justify-content: space-between;
                align-items: center; /* Align items vertically */
            }
            .menu-item p {
                flex: 1; /* Equal distribution of space for both paragraphs */
            }
        </style>
    </head>
    <body>";
    echo "<h2>ใบเสร็จ</h2>";
    $currentOrderID = null;
    $total = 0;
    while ($row = mysqli_fetch_array($result)) {
        if ($row['orderID'] != $currentOrderID) {
            // If it's a new orderID, display receipt header
            if ($currentOrderID !== null) {
                // Display total for previous order
                echo "============================
                <p class='total'>ราคารวม: $total บาท</p>";
                // Payment button inside the receipt
                echo $PaymentLink;
                echo $EditBill;
                echo "</div>";

                $total = 0; // Reset total for the new order
            }

            echo "<div class='receipt'>
                <h1>คิวที่ {$row['orderID']}</h1>
                <p>วันที่: {$row['orderDate']}</p>
                <p>พนักงาน: {$row['username']}</p>
                ============================
                ";

            $currentOrderID = $row['orderID'];
        }

        $total += $row['totalPrice'];

        if ($row["billstatus"] == 'รอการชำระเงิน') {
            $PaymentLink = "<a href='payment.php?username=$username&orderID={$currentOrderID}' class='payment-order'>ชำระเงิน</a>";
            $EditBill  = "<a href='editreceipt.php?username=$username&orderID={$currentOrderID}' class='edit-order'>แก้ไข</a>";
        } else {
            $PaymentLink = "";
            $EditBill = "";
        }

        echo "<div class='menu-item'>
            <p>{$row['menuname']}</p>
            <p>ㅤㅤㅤㅤ{$row['quantity']}ㅤㅤ{$row['totalPrice']}฿</p>
            </div>";
    }

    // Display total for the last order
    if ($currentOrderID !== null) {
        echo "============================
        <p class='total'>ราคารวม: $total บาท</p>"; 
        echo $PaymentLink;
        echo $EditBill;
    }


    echo "
    </body>
    </html>";

    // Close the database connection
    $conn = null;

    ?>
    <script src="slidebar.js"></script>
    </body>
    </html>
    <script language="javaScript">
    function Del(mypage) {
        var agree = confirm("ต้องการออกจากระบบหรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
    </script>