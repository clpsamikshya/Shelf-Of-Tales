<?php
include "connection.php";

// Verify connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query with corrected column names
$sql = "SELECT productname, Author, Descriptions, Genre, Price, Images FROM product";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
    <html>
    <head>
        <title>Books</title>
        <!-- Include Materialize CSS from CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <style>
            /* Custom styles */
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px; /* Adjust as needed */
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            .brand {
                background: #D8BFD8 !important;
            }
            body {
                background-color: lavender;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h2 class="center-align">Book Details</h2>
        <table class="striped">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Author</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['productname']); ?></td>
                    <td><?php echo htmlspecialchars($row['Author']); ?></td>
                    <td><?php echo htmlspecialchars($row['Descriptions']); ?></td>
                    <td><?php echo htmlspecialchars($row['Genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['Price']); ?></td>
                    <td>
                        <img src="images/<?php echo htmlspecialchars($row['Images']); ?>" alt="Book Cover" style="max-width: 100px; height: auto;">
                    </td>
                    <td>
                        <form action="update.php" method="post">
                            <input type="hidden" name="productname" value="<?php echo $row['productname']; ?>">
                            <button class="btn brand z-depth-0" type="submit" name="action">Update</button>
                        </form>
                        <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <input type="hidden" name="productname" value="<?php echo $row['productname']; ?>">
                            <button  class="btn brand z-depth-0" type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
