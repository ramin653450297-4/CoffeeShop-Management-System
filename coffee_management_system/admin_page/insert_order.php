<?php
include('database.php'); // Adjust this path based on your file structure

// Assuming you have the menuID, quantity, type, sweetOption, and orderID from the AJAX request.
$data = json_decode(file_get_contents("php://input"), true);
$menuID = $data['menuID'];
$quantity = $data['quantity'];
$type = $data['type'];
$sweetOption = $data['sweetOption'];
$orderID = $data['orderID'];

// Retrieve menu details from the database to calculate total price.
$sql_menu = "SELECT * FROM menu WHERE menuID = ?";
$stmt_menu = mysqli_prepare($conn, $sql_menu);
mysqli_stmt_bind_param($stmt_menu, "i", $menuID);
mysqli_stmt_execute($stmt_menu);
$result_menu = mysqli_stmt_get_result($stmt_menu);

if (mysqli_num_rows($result_menu) > 0) {
    $row_menu = mysqli_fetch_assoc($result_menu);
    $price = $row_menu['price'];

    // Adjust price based on type
    if ($type == 'ปั่น') {
        $price += 10;
    } elseif ($type == 'เย็น') {
        $price += 5;
    }

    $totalPrice = $price * $quantity;

    // Insert data into the orderDetail table using prepared statement.
    $sql_insert = "INSERT INTO orderDetail (orderID, menuID, quantity, totalPrice, type, sweetOption) VALUES (?, ?, ?, ?, ?, ?)";
    $sql_update = "UPDATE coffeeOrder SET totalPrice = (SELECT SUM(totalPrice) FROM orderDetail WHERE orderID = ?) WHERE orderID = ?";

    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    $stmt_update = mysqli_prepare($conn, $sql_update);

    mysqli_stmt_bind_param($stmt_insert, "iiisss", $orderID, $menuID, $quantity, $totalPrice, $type, $sweetOption);
    mysqli_stmt_bind_param($stmt_update, "ii", $orderID, $orderID);

    if (mysqli_stmt_execute($stmt_insert)) {
        // Execute update query to update totalPrice in coffeeOrder table
        mysqli_stmt_execute($stmt_update);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt_insert);
} else {
    echo json_encode(['error' => 'Menu not found']);
}

mysqli_close($conn);
?>