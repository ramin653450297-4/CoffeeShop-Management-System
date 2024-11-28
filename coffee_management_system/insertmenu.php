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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sidebar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_page/insertmenu1.css">
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
                <a href="../login.php" onclick="logout(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
            </li>
        </ul>
    </div>
    <?php
    $username = $_REQUEST['username'];
    ?>
    <h1>เพิ่มเมนู</h1>
    <form name="form1" action="process_insertmenu.php" method="post">
        ชื่อเมนู : <input type="text" name="menuname" required><br>
        ราคา : <input type="number" name="price" required><br>
        รูปภาพ (URL) : <input type="url" name="image" required><br>
        <input type="hidden" name="username" value="<?php echo urlencode($username); ?>"><br>
        <button type="submit" onclick="return Del();" class="submit-btn">เพิ่มเมนู</button>
        <button type="button" onclick="window.location.href='editmenu_page.php?username=<?=htmlspecialchars($username)?>'" class="back-btn">ย้อนกลับ</button>
    </form>
    <script src="slidebar.js"></script>
</body>
</html>
<script src="slidebar.js"></script>
<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการเพิ่มเมนูหรือไม่");
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