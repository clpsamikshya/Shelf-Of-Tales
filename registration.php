<?php
include 'connection.php';



$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$pword = $_POST['pword'];
$contact =$_POST['contact'];

$sql = "INSERT INTO customers(FirstName,LastName,Email,UserName,Password,Contact) VALUES ('$fname','$lname','$email','$uname','$pword','$contact')";

if(mysqli_query($conn,$sql)){

header('Location: login.php');
     
}else{
    echo 'query error:' . mysqli_error($conn);
}
?> 
