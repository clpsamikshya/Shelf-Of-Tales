<?php
// Start session (if not already started)
session_start();

// Check if form was submitted and "Add to Cart" button clicked
if (isset($_POST['add'])) {
    // Retrieve product details from form
    if (isset($_POST['ProductName'], $_POST['Price'])) {
        $productName = $_POST['ProductName'];
        $price = $_POST['Price'];

        // Include database connection
        include 'connection.php'; 

        // Check if the database connection is successful
        if ($conn === false) {
            echo "Database connection error.";
            exit();
        }

        // Prepare SQL statement to insert into cartt table
        $stmt = $conn->prepare("INSERT INTO cartt (UserName,ProductName, Quantity, Price) VALUES (?,?, 1, ?)");

        // Check if prepare() succeeded
        if ($stmt === false) {
            echo "Database error: Failed to prepare statement.";
            exit();
        }

        // Bind parameters: 's' for string (ProductName), 'd' for decimal (Price)
        $stmt->bind_param("sd", $productName, $price);

        // Execute prepared statement
        if ($stmt->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Failed to add product to cart: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Product name and price are required.";
    }
} else {
    echo "Invalid request.";
}
?>
