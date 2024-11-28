<?php 
include('database.php');
$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);
$username=$_REQUEST['username'];
$sql2 = "SELECT * FROM user WHERE username='$username'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$realname = $row2['realname'];
$userType = $row2['userType'];
$image = $row2['image'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="bill.css">
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
                <a href="login.php" onclick="logout(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>
    <?php
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
    $link = mysqli_connect('localhost', 'root', '', 'coffee') or die("Connect Failed" . mysqli_connect_error());

    $sql = "SELECT * FROM coffeeOrder WHERE username = '$username' ORDER BY orderID DESC";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        die('Error: Unable to execute the query');
    }
    ?>

    <h1>รายการสั่งซื้อ</h1>
    <?php
    $lastOrderID = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(orderID) AS maxOrderID FROM coffeeOrder WHERE username = '$username'"))['maxOrderID'];
    mysqli_close($link);
    ?>
    <a href='insertbill.php?username=<?php echo urlencode($username); ?>&orderID=<?php echo urlencode($lastOrderID); ?>' class="btn-insert">สร้างใบสั่งซื้อใหม่</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>คำสั่งซื้อที่</th>
                <th>วันที่ทำการสั่งซื้อ</th>
                <th>ราคารวม</th>
                <th>สถานะการชำระเงิน</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $currentOrderID = null;
            while ($data = mysqli_fetch_array($result)) {

                if ($data["billstatus"] == 'รอการชำระเงิน') {
                    if(!$data['totalprice'] == 0){
                    $PaymentLink = "<a href='payment.php?username=$username&orderID={$data['orderID']}' class='btn-primary'>รอการชำระเงิน</a>";
                    $EditBill  = "<a href='editreceipt.php?username=$username&orderID={$data['orderID']}' class='edit-order'>แก้ไข</a>";
                    $SelectBill = "<a href='menu.php?username=$username&orderID={$data['orderID']}' class='btn-success'>เลือกรายการ</a>";
                    }else{
                    $SelectBill = "<a href='menu.php?username=$username&orderID={$data['orderID']}' class='btn-success'>เลือกรายการ</a>";
                    $PaymentLink = "<button class='btn-secondary' disabled>รอการชำระเงิน</button>";
                    $EditBill = "<button class='btn-secondary' disabled>แก้ไข</button>";
                    }
                    $DeleteLink = "<a href='delete_receipt.php?username=$username&orderID={$data['orderID']}' class='btn-delete' onclick='return Del()'>ลบออเดอร์</a>";
                } else {
                    $PaymentLink = "<a href='printer.php?username=$username&orderID={$data['orderID']}' class='btn-printer' target='_blank'>พิมใบเสร็จ</a>";                    $EditBill = "<button class='edit-succeed' disabled>แก้ไขไม่ได้</button>";
                    $DeleteLink = "<button class='edit-succeed' disabled>ลบออเดอร์</button>";
                    $SelectBill = "<button class='edit-succeed' disabled>เลือกรายการ</button>";
                }

                echo "<tr>";
                echo "<td>{$data['orderID']}</td>";
                echo "<td>{$data['orderDate']}</td>";
                echo "<td>{$data['totalprice']}</td>";
                echo "<td>";
                echo "$PaymentLink";
                echo "</td>";
                echo "<td>";
                echo "$EditBill";
                echo "</td>";
                echo "<td>";
                echo "$DeleteLink";
                echo "</td>";
                echo "<td>";
                echo "$SelectBill";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <script src="slidebar.js"></script>
</body>
</html>
<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการลบออเดอร์หรือไม่");
    if(!agree){
        return false;
    }
}
function logout(mypage) {
    var agree = confirm("ต้องการออกจากรระบบหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>
