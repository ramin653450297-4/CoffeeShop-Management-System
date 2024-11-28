<?php
include('database.php');
$username = $_REQUEST['username'];
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="save.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <?php
// Include database connection
include('database.php');

// SQL query to get the total quantity of each menu item sold
$sql = "SELECT m.menuID, m.menuname, m.image, SUM(od.quantity) AS totalQuantity 
        FROM orderdetail od 
        JOIN menu m ON od.menuID = m.menuID 
        GROUP BY od.menuID 
        ORDER BY totalQuantity DESC 
        LIMIT 3";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Initialize rank
    $rank = 1;

    // Display the top 3 best-selling menu items with their details
    echo "<h1>3 อันดับเมนูขายดีที่สุด</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        $menuID = $row['menuID'];
        $menuname = $row['menuname'];
        $totalQuantity = $row['totalQuantity'];
        $image = $row['image'];

        echo "<div class='menu-item'>
                <p>อันดับที่ $rank: $menuname - จำนวนที่ขาย: $totalQuantity แก้ว</p>
                <img src='$image' alt='$menuname'>
              </div>";
        $rank++;
    }
} else {
    echo "<h1 style='margin-left: 80px; margin-top: 20px'>ไม่พบข้อมูล</h1>";
}

// Close the database connection
mysqli_close($conn);
?>
<script src="slidebar.js"></script>
<script language="javaScript">
function Del(mypage) {
    var agree = confirm("ต้องการออกจากรระบบหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>
</body>
</html>