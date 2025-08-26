<?php
$conn = mysqli_connect('localhost', 'root', '', 'shelfoftales');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
?>
