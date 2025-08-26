<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sell Your Book</title>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(images/bg.png);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #444;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"],
        .top-button {
            width: 100%;
            background-color: #D8BFD8;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        input[type="submit"]:hover,
        .top-button:hover {
            background-color: #D8BFD8;
        }

        .top-link {
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>

<body>

<div class="container">
    <h2>Sell Your Book</h2>
    
    <!-- View Books button -->
    <div class="top-link">
        <a href="display.php" class="top-button">📚 View Books for Sale</a>
    </div>

    <!-- Sell Book Form -->
    <form name="forms" method="post" enctype="multipart/form-data" action="">
        <label for="uname">Username</label>
        <input type="text" name="UserName" required autocomplete="off">

        <label for="pword">Password</label>
        <input type="password" name="Password" required autocomplete="off">

        <label for="bname">Book Name</label>
        <input type="text" name="bname" id="bname" required autocomplete="off">

        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" required autocomplete="off">

        <label for="price">Price (NRS)</label>
        <input type="text" id="price" name="price" required autocomplete="off">

        <label for="image">Book Cover Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" name="submit" value="Submit Book">
    </form>
</div>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $bname = $_POST["bname"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];

    $stmt = $conn->prepare("SELECT 1 FROM customers WHERE UserName = ?");
    $stmt->bind_param("s", $UserName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO customers (UserName, Password) VALUES (?, ?)");
        $stmt->bind_param("ss", $UserName, $Password);
        $stmt->execute();
    }

    if (!empty($_FILES["image"])) {
        $imageFilename = basename($_FILES["image"]["name"]);
        $target_dir = "images/";
        $target_file = $target_dir . $imageFilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($check === false) {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "<script>alert('Only JPG, JPEG, PNG, GIF & WEBP files are allowed.');</script>";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "<script>alert('File is too large. Max 500KB');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO sellproducts (UserName, Password, BookName, BookGenre, Price, Images) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $UserName, $Password, $bname, $genre, $price, $imageFilename);

                if ($stmt->execute()) {
                    echo "<script>alert('Book added successfully!');</script>";
                } else {
                    echo "<script>alert('Database error: " . $stmt->error . "');</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Error uploading image.');</script>";
            }
        }
    } else {
        echo "<script>alert('Please select an image file.');</script>";
    }
}
$conn->close();
?>

</body>
</html>
