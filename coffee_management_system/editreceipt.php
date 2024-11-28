<?php
include('database.php');
$username=$_REQUEST['username'];
$orderID = $_REQUEST['orderID'];
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

    .back-order {
        display: inline-block;
        padding: 10px 20px;
        color: white;
        background-color: orange;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        
        margin-left: 175px;
    }

    .back-order:hover {
        background-color: #FFCF4F;
    }
    .add-order{
        display: inline-block;
        padding: 10px 15px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        }
    .add-order:hover {
        background-color: #0056b3;
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
            <li class="profile">
                <div class="profile-details">
                    <img src="<?php echo $image; ?>" alt="Profile Image">
                    <div class="name_job">
                        <div class="name"><?=$realname?></div>
                        <div class="job"><?=$userType?></div>
                    </div>
                </div>
                <a href="login.php" onclick="Del(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
            </li>
        </ul>
    </div>
    <div class="container">
        <?php
$sql = "SELECT c.*, d.*, m.* FROM orderDetail c 
JOIN coffeeOrder d ON c.orderID = d.orderID 
JOIN menu m ON m.menuID = c.menuID
WHERE c.orderID = '$orderID' AND username='$username'
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
        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 5 px 8px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            height: 20px;
            width: 50px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            line-height: 20px;
            margin-top: 5px;
        }
    
        .btn-delete:hover {
            background-color: #d32f2f;
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
            align-items: center;
        }
        .menu-item p {
            flex: 1;
        }
    </style>
</head>
<body>";

echo "<h2>ใบเสร็จ</h2>";
$currentOrderID = null;
$total = 0;
$username=$_REQUEST['username'];
while ($row = mysqli_fetch_array($result)) {
    if ($row['orderID'] != $currentOrderID) {
        if ($currentOrderID !== null) {
            // Display total for previous order
            echo "============================
            <p class='total'>ราคารวม: $total</p>";
            
            echo $Odermenu;
            echo $Back;
            
            echo "</div>";
            $total = 0; 
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

    $Back = "<a href='bill.php?username=$username&orderID={$currentOrderID}' class='back-order'>กลับ</a>";
    $Odermenu = "<a href='menu.php?username=$username&orderID={$currentOrderID}' class='add-order'>เพิ่มเมนู</a>";
    echo "<div class='menu-item'>
        <p>{$row['menuname']}</p>
        <p>ㅤㅤ{$row['quantity']}ㅤㅤ{$row['totalPrice']}฿</p>
        <a href='deletereceiptmenu.php?&orderDID={$row['orderDID']}&username=$username&orderID={$row['orderID']}&totalprice={$row['totalPrice']}' class='btn-delete'>ลบ</a>
        </div>";
}

if ($currentOrderID !== null) {
    echo "============================
    <p class='total'>ราคารวม: $total บาท</p>";
    echo $Odermenu;
    echo $Back;

}
echo "
</body>
</html>";

$conn = null;

?>
<script src="slidebar.js"></script>
</body>
</html>
<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการลบออเดอร์หรือไม่");
    if(!agree){
        return false; // Cancel form submission if the user cancels the action
    }
}
</script>

