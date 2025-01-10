<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        .center{
            padding:50px;
        }
        
        body{
    background-image: url(images/bg.png);
}
    </style>
</head>

<?php include('header4.php'); ?>

    <h2>Update Product</h2>
    <form  id="form" class="white" name="form" action="updates.php" method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>
        
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        
        <br>
        <input type="submit" value="Update Product"  class="btn brand z-depth-0">
    </form>
</body>
</html>


