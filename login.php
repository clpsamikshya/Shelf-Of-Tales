<html>
<style>
     .center{
            padding:50px;
        }
        
        body{
    background-image: url(images/bg.png);
}
        </style>


<?php session_start();

include('header1.php');
?>
 


<section class="container grey-text">
        <h4 class="center"></h4>
        <form id="forms" class="white" name="forms" method="post"  action="">
        <label for="UserName">Username:</label><br>
        <input type="text" id="UserName" name="UserName" autocomplete="off" required><br>
        <label for="password">Password:</label><br>
        <input type="Password" id="Password" name="Password" autocomplete="off" required><br><br>

        <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"> 
        </div>

        <p>Don't Have an account?<a  style = "color: black;" href="index1.php" >Register here</a></p>
    </form>
   

    <?php
include 'connection.php';


// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];

    // Query to check if the username and password exist in the database
    $sql = "SELECT * FROM customers WHERE UserName = '$UserName' AND Password = '$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      
        header("Location: home.php?UserName=" . urlencode($UserName));
   
    } else {
        
        echo "Invalid username or password";
       
    }
}

$conn->close()
?>


</body>
</html>
