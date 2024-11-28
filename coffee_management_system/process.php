<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "coffee";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement to insert receipt information
    $stmt = $conn->prepare("INSERT INTO receipts (date, orderId, item, price, quantity, total) VALUES (:date, :orderId, :item, :price, :quantity, :total)");

    // Bind parameters
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':orderId', $_POST['orderId']);
    $stmt->bindParam(':item', $_POST['item']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':quantity', $_POST['quantity']);
    $total = $_POST['price'] * $_POST['quantity'];
    $stmt->bindParam(':total', $total);

    // Execute the SQL statement
    $stmt->execute();

    echo "Receipt inserted successfully.";
    echo "<a href='all_receipts.php'>View Receipts</a>"; // Fixed the link formatting
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
