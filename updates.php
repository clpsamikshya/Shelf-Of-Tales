<?php
    include "connection.php";

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize inputs
        $productName = $conn->real_escape_string($_POST['productName']);
        $author = $conn->real_escape_string($_POST['author']);
        $description = $conn->real_escape_string($_POST['description']);
        $genre = $conn->real_escape_string($_POST['genre']);
        $price = floatval($_POST['price']); // Convert to float for price

        // Handle image upload if provided
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];
            $image_path = "images/" . $image_name;
            
            // Move uploaded file to destination
            if (move_uploaded_file($image_temp, $image_path)) {
                // File moved successfully
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            $image_path = ""; // Default image path if no new image uploaded
        }

        // Prepare SQL query to update the product based on criteria (e.g., ProductName and Author)
        $update_query = "UPDATE product 
                         SET Descriptions = '$description', 
                             Genre = '$genre', 
                             Price = $price, 
                             Images = '$image_path' 
                         WHERE ProductName = '$productName' AND Author = '$author'";

        // Execute query
        if ($conn->query($update_query) === TRUE) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
    ?> 