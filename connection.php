<?php

$conn = mysqli_connect('localhost','Project','test@1234','project');

if(!$conn){
echo 'Connection error' .mysqli_connect_error();
}
?>