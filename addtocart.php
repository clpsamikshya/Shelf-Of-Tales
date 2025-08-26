<?php
session_start();

include 'connection.php';  // mysqli connection ($conn)

$productName = $_POST['ProductName'] ?? '';
$price = $_POST['Price'] ?? 0;

if (!$productName || !$price) {
    die("Error: Invalid product data.");
}

// Use session id as identifier since no user login
$sessionId = session_id();

// Check if product already in cart for this session
$stmt = $conn->prepare("SELECT id, Quantity FROM cartt WHERE ProductName = ? AND UserName = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $productName, $sessionId); // Using sessionId instead of username
$stmt->execute();
$result = $stmt->get_result();
$existingItem = $result->fetch_assoc();

if ($existingItem) {
    // Update quantity
    $newQty = $existingItem['Quantity'] + 1;
    $updateStmt = $conn->prepare("UPDATE cartt SET Quantity = ? WHERE id = ?");
    if (!$updateStmt) {
        die("Update prepare failed: " . $conn->error);
    }
    $updateStmt->bind_param("ii", $newQty, $existingItem['id']);
    $updateStmt->execute();
    $updateStmt->close();
} else {
    // Insert new item
    $insertStmt = $conn->prepare("INSERT INTO cartt (UserName, ProductName, Price, Quantity) VALUES (?, ?, ?, 1)");
    if (!$insertStmt) {
        die("Insert prepare failed: " . $conn->error);
    }
    $insertStmt->bind_param("ssd", $sessionId, $productName, $price);
    $insertStmt->execute();
    $insertStmt->close();
}

$stmt->close();

header("Location: cart.php");
exit;
