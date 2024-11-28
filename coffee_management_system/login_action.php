<?php
    include('database.php');
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND status = '1'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if ($result->num_rows > 0) 
    {
        if($data['userType'] == 'Admin'){
            echo "<script>alert('ไปที่หน้าผู้ดูแลระบบ !!!');</script>";
            echo "<script>window.location='admin_page/dashboard.php?username=$username';</script>";
        }else{
            echo "<script>alert('เข้าสู่ระบบเสร็จสิ้น');</script>";
            echo "<script>window.location='dashboard.php?username=$username';</script>";
        }
    } else 
    {
        echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้องหรือบัญชีไม่ได้ใช้งาน');</script>";
        echo "<script>window.location='login.php';</script>";
    }
?>