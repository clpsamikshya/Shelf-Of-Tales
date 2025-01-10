<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <a href="logout.php">Logout</a>

    <?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>

</body>
</html>
