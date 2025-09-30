<?php
include 'connection.php';

$q = $_GET['query'] ?? '';
$suggestions = [];

if($q){
    $q_safe = mysqli_real_escape_string($conn, $q);
    $sql = "SELECT BookName, Image, Price FROM books WHERE BookName LIKE '$q_safe%' LIMIT 5";
    $res = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($res)){
        // Prepend images folder
        $row['Image'] = !empty($row['Image']) ? 'images/' . $row['Image'] : 'images/default.jpg';
        $row['Price'] = number_format($row['Price'], 2);
        $suggestions[] = $row;
    }
}

echo json_encode($suggestions);
?>
