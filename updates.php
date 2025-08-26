<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize inputs
    $id = intval($_POST['id']);  // product id (must be in the form as hidden input)
    $productName = $conn->real_escape_string($_POST['productName']);
    $author = $conn->real_escape_string($_POST['author']);
    $genre = $conn->real_escape_string($_POST['genre']);
    $price = floatval($_POST['price']);
    $description = $conn->real_escape_string($_POST['description'] ?? '');

    // First, get current image name from DB to keep if no new image uploaded
    $stmt = $conn->prepare("SELECT Images FROM shelfoftales.sellproducts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $currentImage = $row ? $row['Images'] : '';
    $stmt->close();

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_temp = $_FILES['image']['tmp_name'];
        $target_dir = "images/";
        $image_path = $target_dir . $image_name;

        if (move_uploaded_file($image_temp, $image_path)) {
            // Optionally delete old image file here if you want
            // unlink($target_dir . $currentImage);
        } else {
            echo "Error uploading new image.";
            exit;
        }
    } else {
        $image_name = $currentImage;  // keep old image if no new one uploaded
    }

    // Prepare update statement with parameterized query for security
    $stmt = $conn->prepare("UPDATE shelfoftales.sellproducts SET BookName = ?, UserName = ?, BookGenre = ?, Price = ?, Images = ? WHERE id = ?");
    $stmt->bind_param("sssisi", $productName, $author, $genre, $price, $image_name, $id);

    if ($stmt->execute()) {
        // Redirect to display.php after success
        header("Location: display.php");
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
