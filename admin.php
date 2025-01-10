<html>
<style>
     .center{
            padding:50px;
        }
        
        body{
    background-image: url(images/bg.png);
}

        </style>

<?php session_start(); ?>

<?php include('header3.php'); ?>

    <h2>Add a Book</h2>
    <form id="form" class="white" name="form" method="post" enctype="multipart/form-data" action="">
        <label for="productname">Product Name:</label>
        <input type="text" id="productname" name="productname" required><br><br>
        
        <label for="Author">Author:</label>
        <input type="text" id="Author" name="Author" required><br><br>
        
        <label for="Price">Price:</label>
        <input type="number" id="Price" name="Price" required><br><br>
        
        <label for="Genre">Genre:</label>
        <input type="text" id="Genre" name="Genre" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="Description" name="Description" rows="4" cols="50" required></textarea><br><br>
        
        <label for="image">Book Cover Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>
        
        <input type="submit" name="submit" value="Add Book" class="btn brand z-depth-0">
    </form>

    <?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $productName = $_POST['productname'];
    $Author = $_POST['Author'];
    $Price = floatval($_POST['Price']);
    $Genre = $_POST['Genre'];
    $Description = $_POST['Description'];

    if (!empty($_FILES["image"])) {
        $imageFilename = basename($_FILES["image"]["name"]);

        $target_dir = "images/";
        $target_file = $target_dir . $imageFilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
            $uploadOk = 0;
        }

        // Check file size if needed (adjust as necessary)
        if ($_FILES["image"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Prepare SQL statement to insert into product table
                $stmt = $conn->prepare("INSERT INTO product (productname, Author, Descriptions, Genre, Price, Images) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssds", $productName, $Author, $Description, $Genre, $Price, $imageFilename);

                // Execute prepared statement
                if ($stmt->execute()) {
                    echo "Book added successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please select an image file.";
    }
}
$conn->close();
?>

</body>
</html>