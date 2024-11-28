<?php 
include('database.php');
$username = $_REQUEST['username'];

$sql_show = "SELECT * FROM user WHERE username='$username'";
$result_show = mysqli_query($conn, $sql_show);
$row_show = mysqli_fetch_assoc($result_show);
$realname = $row_show['realname'];
$userType = $row_show['userType'];
$image = $row_show['image'];

$menuInfoSql = "SELECT DISTINCT menuID, menuname, price FROM menu";
$menuInfoResult = mysqli_query($conn, $menuInfoSql);
$totalMenusSql = "SELECT COUNT(DISTINCT menuID) AS totalMenus FROM menu";
$totalMenusResult = mysqli_query($conn, $totalMenusSql);
$totalMenusRow = mysqli_fetch_assoc($totalMenusResult);
$totalMenus = $totalMenusRow['totalMenus'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="dashboard.css">
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
    <h1 style="margin-top: 20px;margin-left: 100px;text-align: center;font-size: 28px;font-weight: bold;margin-bottom: 20px;color: #333;">Welcome Coffee System</h1>
    <div class="dashboard">
        <div class="grid-container">
            <div class="grid-item-1">
                <div class="products-list">
                    <i class='bx bx-coffee'></i>
                    <h2>รายการเมนู</h2>
                    <h2>เมนูทั้งหมด<?php echo $totalMenus; ?> เมนู</h2><br>
                    <div class="slideshow-container">
                        <?php
        while ($menuInfoRow = mysqli_fetch_assoc($menuInfoResult)) {
            $menuname = $menuInfoRow['menuname'];
            $menuID = $menuInfoRow['menuID'];
            $price = $menuInfoRow['price'];
            $imageSql = "SELECT image FROM menu WHERE menuID = $menuID LIMIT 1";
            $imageResult = mysqli_query($conn, $imageSql);
            $imageRow = mysqli_fetch_assoc($imageResult);
            $imageUrl = $imageRow['image'];

            echo "<div class='mySlides'>";
            echo "<img src='$imageUrl' alt='$menuname' class='menu-image'>";
            echo "<h2>$menuname<br>ราคา $price ฿</h2>";
            echo "</div>";
        }
        ?>
    </div>
    <script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slideIndex++;

        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        slides[slideIndex - 1].style.display = "block";

        setTimeout(showSlides, 3000);
    }
    </script>
<script src="slidebar.js"></script>
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