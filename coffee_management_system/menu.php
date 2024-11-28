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
    <title>Menu</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="menu.css">
    <script>
    const orderID = <?php echo isset($_GET['orderID']) ? $_GET['orderID'] : 'null'; ?>;
    </script>
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
        </ul>
    </div>
    <!-- HTML -->
    <?php
   $orderID = isset($_REQUEST['orderID']) ? $_REQUEST['orderID'] : null;

   ?>
    <div class="container">
        <h1>รายการเครื่องดื่ม</h1><br>
        <div class="menu-con">
            <?php 
            if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $counter++;
                    echo "<div class='menu-item-" . $row['menuID'] . "'>";
                    echo "<div class='menu-img'>";
                    echo "<button class='btn-click' onclick='showDetails(" . $row['menuID'] . "," . $counter . "," . $orderID . ")'><img src='" . $row['image'] . "' alt='Menu Image'></button>";
                    echo "</div>";
                    echo "<div class='menu-detail'>";
                    echo "<h2>" . $row['menuname'] . "</h2>";
                    echo "</div>";
                    echo "<div class='menu-price'>";
                    echo "<p class='price'>ราคา: ฿" . $row['price'] . "</p>";
                    echo "</div>";
                    echo "</div>";

                }
            } else {
                echo "<p class='error-message'>No images found</p><br>";
            }
            mysqli_close($conn);
            ?>
            <div class="menu-click">
                <h2>รายละเอียด</h2>
                <p id="menu-details"></p>
                <button class='btn-checkout' onclick="checkout(window.location.href='bill.php?username=<?php echo urlencode($username); ?>')">กดสั่ง</button>
                <button class='btn-create' type="button" onclick="window.location.href='bill.php?username=<?php echo urlencode($username); ?>'">สร้าง Bill</button>
            </div>
        </div>
    </div>
    <script src="slidebar.js"></script>
    <script src="order.js"></script>
</body>
</html>
<script language="javaScript">
function Del(mypage) {
    var agree = confirm("ต้องการออกจากรระบบหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>