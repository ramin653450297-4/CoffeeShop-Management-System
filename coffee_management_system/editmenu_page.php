<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Bootstrap css -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admin_page/edit.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<style>
    body{
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    }
    h1{
    text-align: center;
    margin-top: 20px;
    color: #333;
}
.submit-btn{
    background-color: #4caf50;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}
.submit-btn:hover{
    background-color: #45a049;
}

.back-btn {
    background-color: #a80000;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.back-btn:hover {
    background-color: #ee0000;
}
</style>
</head>
<body>
<?php 
include('database.php');
$username=$_REQUEST['username'];
$sql2 = "SELECT * FROM user WHERE username='$username'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$realname = $row2['realname'];
$userType = $row2['userType'];
$image = $row2['image'];
?>
<!-- sidebar -->
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
<h1>แสดงสินค้า</h1>
<a href="insertmenu.php?username=<?php echo urlencode($username); ?>" class="btn btn-insert">เพิ่มเมนู</a>
<table class="table">
    <tr>
        <th>ลับดับเมนู</th>
        <th>ชื่อเมนู</th>
        <th>ราคา</th>
        <th>รูป</th>
        <th>การทำงาน</th>
        <th></th>
    </tr>
<?php
$link = mysqli_connect('localhost', 'root', '', 'coffee');
$sql = "select * from menu";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_array($result)){
?>
    <tr>
        <td><?=$row["menuID"]?></td>
        <td><?=$row["menuname"]?></td>
        <td><?=$row["price"]?></td>
        <td><img src=<?=$row["image"]?> class="rounded img-thumbnail" style="max-width: 100px; max-height: 100px;"></td>
        <td>
                <a href="editmenu.php?menuID=<?=$row["menuID"]?>&username=<?php echo urlencode($username); ?>">
                    <button class="submit-btn">แก้ไขเมนู</button>
                </a>
            </td>
            <td>
                <a href="deletemenu.php?menuID=<?=$row["menuID"]?>&username=<?php echo urlencode($username); ?>">
                    <button onclick="return Del()" class="back-btn">ลบเมนู</button>
                </a>
            </td>
    </tr>
<?php
}
?>
</table>
</div></div></div>
</body>
</html>
<script src="slidebar.js"></script>
<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการลบเมนูหรือไม่");
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