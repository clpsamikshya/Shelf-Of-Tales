<html>
<style>
     .center{
            padding:50px;
        }

        body{
    background-image: url(images/bg.png);
}
        </style>


<?php include('header2.php');?>


<section class="container grey-text">
        <h4 class="center"></h4>
        <form id="forms" class="white" name="forms" method="post"  enctype="multipart/form-data"  action="">

        <label for="uname">username</label>
        <input type="text" name="UserName" value="" autocomplete="off" required><br><br>

        <label type="pword">password</label>
        <input type="password" name="Password" value="" autocomplete="off" required> <br><br>

        <label for="bname">Book name</label>
        <input type="text"  name="bname" id="bname" autocomplete="off" required> <br><br>

        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" value="" autocomplete="off" required><br><br>

        <label for="price">price</label>
        <input type="text" id="price" name="price" value="" autocomplete="off" required><br><br>

        <label for="image">Book Cover Image:</label>
        <input type="file" id="image" name="image"  accept="image/*" required><br><br>

        <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"> 
        </div>
    </form>
</section>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $bname = $_POST["bname"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];

    // Check if UserName exists in customers table
    $stmt = $conn->prepare("SELECT 1 FROM customers WHERE UserName = ?");
    $stmt->bind_param("s", $UserName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        // UserName does not exist, insert into customers table
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
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
    
            // If everything is ok, try to upload file
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Prepare SQL statement to insert into product table
                    $stmt = $conn->prepare("INSERT INTO sellproducts (UserName, Password, BookName, BookGenre, Price, Images) VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ssssss", $UserName, $Password, $bname, $genre, $price, $imageFilename);
    
                    // Execute prepared statement
                    if ($stmt->execute()) {
                        // echo "Book added successfully!";
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