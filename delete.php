<?php
// Include the connection script
include "connection.php";

// Check if delete button is clicked
if (isset($_POST["delete"])) {
    // Assuming 'productname' is passed via POST method
    $productname = $_POST["productname"];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM product WHERE productname=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Check for errors in preparing the statement
        echo "Error: Failed to prepare statement";
    } else {
        // Bind parameters and execute the statement
        $stmt->bind_param("s", $productname);
        if ($stmt->execute()) {
            // If deletion is successful
            echo "Product deleted successfully!";
        } else {
            // If execution fails
            echo "Error: Product not deleted";
        }
        // Close statement
        $stmt->close();
    }
} else {
    // If 'delete' button not clicked
    echo "Error: Product not deleted";
}

// Close connection
$conn->close();
?>
