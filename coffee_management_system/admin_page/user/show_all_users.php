<?php
$link = mysqli_connect('localhost', 'root', '', 'coffee');

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$image = $row['image'];
$realname = $row['realname'];
$userType = $row['userType'];
$email = $row['email'];
$mobile = $row['mobile'];
$username=$_REQUEST['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        /* Style for buttons */
        .add-btn{
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 160px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .add-btn:hover{
            background-color: #0056b3;
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
<script language="javaScript">
function Del(){
    var agree = confirm("ต้องการลบข้อมูลหรือไม่");
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
                <a href="../dashboard.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../menu.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-coffee'></i>
                    <span class="links_name">Menu</span>
                </a>
                <span class="tooltip">Menu</span>
            </li>
            <li>
                <a href="../bill.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-receipt'></i>
                    <span class="links_name">Order</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="../receipt.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Receipt</span>
                </a>
                <span class="tooltip">Receipt</span>
            </li>
            <li>
                <a href="../save.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="../editmenu_page.php?username=<?php echo urlencode($username); ?>">
                    <i class='bx bxs-edit'></i>
                    <span class="links_name">edit</span>
                </a>
                <span class="tooltip">edit</span>
            </li>
            <li>
            <a href="show_all_users.php?username=<?php echo urlencode($username); ?>">
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
                <a href="../../login.php" onclick="logout(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
            </li>
        </ul>
    </div>
    <h1>รายการผู้ใช้ทั้งหมด</h1>
    <button onclick="window.location.href='register.php?username=<?=urlencode($username); ?>'" class="add-btn">เพิ่มผู้ใช้</button>
    <table>
        <thead>
            <tr>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อจริง</th>
                <th>อีเมล</th>
                <th>การทำงาน</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $sql2 = "SELECT * from user where userType='Employee'";
        $result2 = mysqli_query($link, $sql2); 
        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
        <tr>
            <td><?php echo $row2['username']; ?></td>
            <td><?php echo $row2['realname']; ?></td>
            <td><?php echo $row2['email']; ?></td>
            <td>
                <a href="../edituser/edituser.php?username=<?=htmlspecialchars($row2['username'])?>&usename=<?php echo urlencode($username); ?>">
                    <button class="submit-btn">แก้ไขข้อมูลผู้ใช้</button>
                </a>
            </td>
            <td>
                <a href="../edituser/deleteuser.php?username=<?=htmlspecialchars($row2['username'])?>&usename=<?php echo urlencode($username); ?>">
                    <button onclick="return Del()" class="back-btn">ลบผู้ใช้</button>
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    <script src="../slidebar.js"></script>
</body>
</html>

