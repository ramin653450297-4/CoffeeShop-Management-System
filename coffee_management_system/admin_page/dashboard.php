<?php 
include('database.php');
$username = $_REQUEST['username'];

// Fetch user information
$sql_show = "SELECT * FROM user WHERE username='$username'";
$result_show = mysqli_query($conn, $sql_show);
$row_show = mysqli_fetch_assoc($result_show);
$realname = $row_show['realname'];
$userType = $row_show['userType'];
$image = $row_show['image'];

// Fetch total number of menus
$menuInfoSql = "SELECT DISTINCT menuID, menuname FROM menu";
$menuInfoResult = mysqli_query($conn, $menuInfoSql);
$totalMenusSql = "SELECT COUNT(DISTINCT menuID) AS totalMenus FROM menu";
$totalMenusResult = mysqli_query($conn, $totalMenusSql);
$totalMenusRow = mysqli_fetch_assoc($totalMenusResult);
$totalMenus = $totalMenusRow['totalMenus'];

// Fetch daily income grouped by months and days
$monthlyIncomeSql = "SELECT 
                        YEAR(orderDate) AS year,
                        MONTH(orderDate) AS month,
                        SUM(totalprice) AS monthlyIncome 
                    FROM 
                        coffeeorder
                    WHERE 
                        billstatus = 'ชำระเงินเสร็จสิ้น' 
                    GROUP BY 
                        YEAR(orderDate), 
                        MONTH(orderDate)";
$monthlyIncomeResult = mysqli_query($conn, $monthlyIncomeSql);
$monthlyIncome = [];
while ($row = mysqli_fetch_assoc($monthlyIncomeResult)) {
    $monthlyIncome[$row['year']][$row['month']] = $row['monthlyIncome'];
}

// Fetch weekly income
$weeklyIncomeSql = "SELECT 
                        YEAR(orderDate) AS year,
                        WEEK(orderDate) AS week,
                        SUM(totalprice) AS weeklyIncome 
                    FROM 
                        coffeeorder
                    WHERE 
                        billstatus = 'ชำระเงินเสร็จสิ้น' 
                    GROUP BY 
                        YEAR(orderDate), 
                        WEEK(orderDate)";
$weeklyIncomeResult = mysqli_query($conn, $weeklyIncomeSql);
$weeklyIncome = [];
while ($row = mysqli_fetch_assoc($weeklyIncomeResult)) {
    $weeklyIncome[$row['year']][$row['week']] = $row['weeklyIncome'];
}

// Fetch daily income
$dailyIncomeSql = "SELECT 
                        DATE(orderDate) AS day,
                        SUM(totalprice) AS dailyIncome 
                    FROM 
                        coffeeorder 
                    WHERE 
                        billstatus = 'ชำระเงินเสร็จสิ้น'    
                    GROUP BY 
                        DATE(orderDate)";
$dailyIncomeResult = mysqli_query($conn, $dailyIncomeSql);
$dailyIncome = [];
while ($row = mysqli_fetch_assoc($dailyIncomeResult)) {
    $dailyIncome[$row['day']] = $row['dailyIncome'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li>
            <a href="user/show_all_users.php?username=<?php echo urlencode($username); ?>">
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
                <a href="../login.php" onclick="Del(this.href);return false;">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
            </li>
        </ul>
    </div>
    <div class="dashboard">
        <div class="grid-container">
            <div class="welcome">
           <h1>
           ยินดีต้อนรับสู่หน้าผู้จัดการร้านกาแฟ
           </h1>
            </div>
            <div class="grid-item-1">
                <div class="todays-sales">
                    <i class='bx bx-bar-chart'></i>
                    <h2>รายได้แต่ละเดือน</h2>
                    <canvas id="monthIncomeChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="grid-item-2">
                <div class="todays-sales">
                    <i class='bx bx-bar-chart'></i>
                    <h2>รายได้แต่ละสัปดาห์</h2>
                    <canvas id="weekedIncomeChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="grid-item-3">
                <div class="todays-sales">
                    <i class='bx bx-bar-chart'></i>
                    <h2>รายได้แต่ละวัน</h2>
                    <canvas id="dailyIncomeChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");

        // Hide all slides
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        // Increment the slide index
        slideIndex++;

        // Reset to the first slide if at the end
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        // Display the current slide
        slides[slideIndex - 1].style.display = "block";

        // Change slide every 3 seconds (adjust as needed)
        setTimeout(showSlides, 3000);
    }
    </script>
<script>
    var monthlyIncome = <?php echo json_encode($monthlyIncome); ?>;
    var weeklyIncome = <?php echo json_encode($weeklyIncome); ?>;
    var dailyIncome = <?php echo json_encode($dailyIncome); ?>;
    
    // Function to sum values in an array
    function sumArray(arr) {
        return arr.reduce((a, b) => a + b, 0);
    }

    // Monthly income chart
    var ctxMonthly = document.getElementById('monthIncomeChart').getContext('2d');
    var labelsMonthly = [];
    var datasetsMonthly = [];

    for (var year in monthlyIncome) {
        for (var month in monthlyIncome[year]) {
            labelsMonthly.push('เดือน ' + month + ', ปี ' + year);
            datasetsMonthly.push(monthlyIncome[year][month]);
        }
    }

    var monthIncomeChart = new Chart(ctxMonthly, {
        type: 'bar',
        data: {
            labels: labelsMonthly,
            datasets: [{
                label: 'รายได้รวมต่อเดือน',
                data: datasetsMonthly,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    // Weekly income chart
    var ctxWeekly = document.getElementById('weekedIncomeChart').getContext('2d');
    var labelsWeekly = [];
    var datasetsWeekly = [];

    for (var year in weeklyIncome) {
        for (var week in weeklyIncome[year]) {
            labelsWeekly.push('สัปดาห์ที่ ' + week + ', ปี ' + year);
            datasetsWeekly.push(weeklyIncome[year][week]);
        }
    }

    var weekedIncomeChart = new Chart(ctxWeekly, {
        type: 'bar',
        data: {
            labels: labelsWeekly,
            datasets: [{
                label: 'รายได้รวมต่อสัปดาห์',
                data: datasetsWeekly,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    // Daily income chart
    var ctxDaily = document.getElementById('dailyIncomeChart').getContext('2d');
    var labelsDaily = Object.keys(dailyIncome);
    var datasetsDaily = Object.values(dailyIncome);

    var dailyIncomeChart = new Chart(ctxDaily, {
        type: 'bar',
        data: {
            labels: labelsDaily,
            datasets: [{
                label: 'รายได้รวมต่อวัน',
                data: datasetsDaily,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
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