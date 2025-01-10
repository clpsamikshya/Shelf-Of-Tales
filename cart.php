<?php
include "connection.php";
// SQL query to retrieve data from addtocart table
$sql = "SELECT * FROM cartt";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Product: " . $row["product_name"] . " - Quantity: " . $row["quantity"] . "<br>";
        // You can access other columns in the same manner using $row["column_name"]
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
