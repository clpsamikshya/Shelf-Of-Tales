<?php
// Establish database connection (example using PDO)
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error: Could not connect. " . $e->getMessage());
}

// Assuming data is received via POST (product ID and rating)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['productId'];
  $rating = $_POST['rating'];

  // Insert into ratings table
  $stmt = $pdo->prepare("INSERT INTO ratings (product_id, rating) VALUES (?, ?)");
  $stmt->execute([$productId, $rating]);

  // Respond with success message or error handling
  echo json_encode(['success' => true, 'message' => 'Rating saved successfully']);
} else {
  echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
