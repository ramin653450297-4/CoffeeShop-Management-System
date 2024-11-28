<?php
$link = mysqli_connect('localhost','root','','coffee');
$username = $_GET["username"];

$sql = "select * from user where username='$username'";

$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);
if ($result && mysqli_num_rows($result) > 0) {
    $image = $row['image'];
    $realname = $row['realname'];
    $userType = $row['userType'];
    $email = $row['email'];
    $status = $row['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EDIT Information</title>
    <link rel="stylesheet" href="edituser.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="../dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function validateForm() {
            var password = document.forms["registrationForm"]["password"].value;
            var confirmPassword = document.forms["registrationForm"]["confirmPassword"].value;

            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match");
                return false;
            }
            return true;
        }

        function Del() {
            var agree = confirm("คุณต้องการแก้ไขข้อมูลหรือไม่?");
            if (agree) {
                document.forms["registrationForm"].submit();
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
            <a href="../user/show_all_users.php?username=<?php echo urlencode($username); ?>">
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
                <a href="../login.php" onclick="logout(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
            </li>
        </ul>
    </div>
</div>
<div class="registration-form">
        <form name="registrationForm" action="edituser_action.php?username=<?=$username?>" method="POST" onsubmit="return validateForm()">
            <h2>แก้ไขข้อมูล</h2>
            <div class="form-group">
                <div class="img-area">
                    <div class="inner-area">
                        <img src="<?=$image?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>ลิงก์รูปภาพ</label>
                <input type="url" name="image" value="<?=htmlspecialchars($row['image'])?>">
            </div>
            <div class="form-group">
                <label>ชื่อ</label>
                <input type="text" name="realname" value="<?=htmlspecialchars($row['realname'])?>">
            </div>
            <div class="form-group">
                <label>เบอร์โทรศัพท์</label>
                <input type="text" name="mobile" value="<?=htmlspecialchars($row['mobile'])?>">
            </div>
            <div class="form-group">
                <label>อีเมล</label>
                <input type="email" name="email" value="<?=htmlspecialchars($row['email'])?>">
            </div>
            <div class="form-group">
                <label>ชื่อผู้ใช้</label>
                <input type="text" name="username" value="<?=htmlspecialchars($row['username'])?>">
            </div>
            <div class="form-group">
                <label>รหัสผ่าน</label>
                <input type="password" name="password" value="<?=htmlspecialchars($row['password'])?>">
            </div>
            <div class="form-group">
                <label>ยืนยันรหัสผ่าน</label>
                <input type="password" name="confirmPassword" value="<?=htmlspecialchars($row['password'])?>">
            </div>
            <div class="from-grop">    
                <label>Active</label>
                <input type="checkbox" name="status" class="form-check-input" <?php echo $row['status'] == 1 ? 'checked' : ''; ?>><br>
            </div><br>
            <div class="form-group">
                <?php
                 $sql2 = "select * from user where userType='Admin'";
                 $result2 = mysqli_query($link,$sql2);
                $row2 = mysqli_fetch_array($result2);
                ?>
                <button type="submit" onclick="Del();" class="submit-btn">แก้ไข</button>
                <button type="button" onclick="window.location.href='../user/show_all_users.php?username=<?=htmlspecialchars($row2['username'])?>'" class="back-btn">ย้อนกลับ</button>

            </div>
        </form>
    </div>
    <script src="../slidebar.js"></script>
</body>
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