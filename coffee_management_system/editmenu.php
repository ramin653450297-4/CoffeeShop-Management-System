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
    <style>
    .submit-btn1{
    background-color: #4caf50;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    }
    .submit-btn1:hover{
    background-color: #45a049;
    }

    .back-btn1 {
    background-color: #a80000;
    color: white;
    margin-left: 175px;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    }

    .back-btn1:hover {
    background-color: #ee0000;
    }
    
.img-area {
    height: 150px;
    width: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    border: 2px solid #ccc;
}

.img-area img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
            </li>
        </ul>
    </div>
        <?php
        $username = $_REQUEST['username'];
        $menuID = $_REQUEST['menuID'];

        $sql1 = "select * from menu where menuID='$menuID'";

        $result1 = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_array($result1);
        $image1 = $row['image'];

        ?>
        <h1>แก้ไขเมนู</h1><br>
        <form name="form1" action="process_editmenu.php" method="post">
        <div class="img-area">
        <img src="<?=$image1?>" width="300px" height="200px">
        </div>
            <input type="hidden" name="menuID" value="<?php echo urlencode($menuID); ?>"><br>
            ชื่อเมนู : <input type="text" name="menuname"  value="<?=htmlspecialchars($row['menuname'])?>"><br>
            ราคา : <input type="number" name="price"  value="<?=htmlspecialchars($row['price'])?>"><br>
            รูปภาพ (url) : <input type="url" name="image"  value="<?=htmlspecialchars($row['image'])?>"><br>
            <input type="hidden" name="username" value="<?php echo urlencode($username); ?>"><br>
            <button type="submit" onclick="return Del();" class="submit-btn1">แก้ไขเมนู</button>
            <button type="button" onclick="window.location.href='editmenu_page.php?username=<?=htmlspecialchars($username)?>'" class="back-btn1">ย้อนกลับ</button>
    </body>
    
<script src="slidebar.js"></script>
</html>

<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการแก้ไขข้อมูลหรือไม่");
    if(!agree){
        return false;
    }
}
</script>
<script>
        function logout(mypage) {
    var agree = confirm("ต้องการออกจากรระบบหรือไม่");
    if (agree) {
        window.location = mypage;
    }
}
</script>