<?php
include 'connection.php';

// Check if ID is set in GET
if (!isset($_GET['id'])) {
    die("Product ID is required.");
}

$id = intval($_GET['id']);

// Fetch current product data
$stmt = $conn->prepare("SELECT BookName, UserName, BookGenre, Price, Images FROM shelfoftales.sellproducts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update Product</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
        }
        label, input, textarea {
            display: block;
            margin-bottom: 10px;
            width: 100%;
        }
        .center {
            padding: 50px;
        }
        body {
            background-image: url(images/bg.png);
        }
    </style>
</head>
<body>

<?php include('header4.php'); ?>

<h2>Update Product</h2>

<form id="form" class="white" name="form" action="updates.php" method="post" enctype="multipart/form-data">
    <!-- Hidden input to send product id -->
     <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">


    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName" required value="<?php echo htmlspecialchars($product['BookName']); ?>">

    <label for="author">Seller Username:</label>
    <input type="text" id="author" name="author" required value="<?php echo htmlspecialchars($product['UserName']); ?>">

    <label for="genre">Genre:</label>
    <input type="text" id="genre" name="genre" required value="<?php echo htmlspecialchars($product['BookGenre']); ?>">

    <label for="price">Price (NRS):</label>
    <input type="number" id="price" name="price" step="0.01" required value="<?php echo htmlspecialchars($product['Price']); ?>">

    <label for="image">Image: (leave blank to keep current)</label>
    <input type="file" id="image" name="image">

    <br>
    <input type="submit" value="Update Product" class="btn brand z-depth-0">
</form>

</body>
</html>
