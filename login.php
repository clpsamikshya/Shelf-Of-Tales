<?php
session_start();
include('header1.php');
?>

<html>
<style>
    .center {
        padding: 50px;
    }

    body {
        background-image: url(images/bg.png);
    }
</style>

<section class="container grey-text">
    <h4 class="center"></h4>
    <form id="forms" class="white" name="forms" method="post" action="">
        <label for="UserName">Username:</label><br>
        <input type="text" id="UserName" name="UserName" autocomplete="off" required><br>
        <label for="password">Password:</label><br>
        <input type="Password" id="Password" name="Password" autocomplete="off" required><br><br>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

        <p>Don't Have an account?<a style="color: black;" href="index1.php"> Register here</a></p>
    </form>

    <?php
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UserName = $_POST['UserName'];
        $Password = $_POST['Password'];

        // Hardcoded admin check
        if ($UserName === "admin" && $Password === "admin123") {
            // Set a session variable for admin
            $_SESSION['UserName'] = $UserName;
            $_SESSION['is_admin'] = true;
            header("Location: admin_dashboard.php");
            exit;
        }

        // Otherwise check database
        $sql = "SELECT * FROM customers WHERE UserName = ? AND Password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $UserName, $Password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION['UserName'] = $UserName;
            $_SESSION['is_admin'] = false;
            header("Location: home.php");
            exit;
        } else {
            echo "<p style='color:red;'>Invalid username or password</p>";
        }
        $stmt->close();
    }

    $conn->close();
    ?>

</section>

</body>

</html>
