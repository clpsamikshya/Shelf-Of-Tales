<?php
include 'connection.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM shelfoftales.sellproducts WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: display.php");
    exit;
}

$sql = "SELECT id, UserName, BookName, BookGenre, Price, Images, created_at FROM shelfoftales.sellproducts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Books for Sale</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />

    <style>
        /* Background with subtle dark overlay for better readability */
        body {
            background: url(images/bg.png) no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        h4 {
            color: #D8BFD8 ;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 30px;
            letter-spacing: 0.05em;
            user-select: none;
        }

        .add-btn {
            background-color: #D8BFD8 ;
            font-weight: 600;
            padding: 0 1.8rem;
            font-size: 1.1rem;
            border-radius: 32px;
            box-shadow: 0 6px 14px rgba(123, 31, 162, 0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 40px;
            user-select: none;
        }

        .add-btn:hover {
            background-color: #D8BFD8 ;
            box-shadow: 0 10px 30px rgba(74, 20, 140, 0.45);
        }

        /* Custom book container instead of card */
        .book-container {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-container:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        }

        .book-image {
            width: 100%;
            height: 240px;
            object-fit: contain;
            background: #f9f9f9;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .book-info {
            flex-grow: 1;
        }

        .book-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            user-select: text;
        }

        .book-meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 6px;
            user-select: text;
        }

        .price {
            font-weight: 700;
            color: #2e7d32;
            font-size: 1.1rem;
            margin: 12px 0 8px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        @media only screen and (max-width: 600px) {
            .book-image {
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="center-align">
            <h4>Explore Books for Sale</h4>
            <a href="sellproduct.php" class="btn add-btn waves-effect waves-light">➕ Add New Book</a>
        </div>

        <div class="row">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col s12 m6 l4">
                        <div class="book-container">
                            <img
                                src="images/<?php echo htmlspecialchars($row['Images']); ?>"
                                alt="Book Cover"
                                class="book-image"
                            />
                            <div class="book-info">
                                <span class="book-title"><?php echo htmlspecialchars($row['BookName']); ?></span>
                                <p class="book-meta">📖 Genre: <?php echo htmlspecialchars($row['BookGenre']); ?></p>
                                <p class="book-meta">👤 Seller: <?php echo htmlspecialchars($row['UserName']); ?></p>
                                <p class="price">NRS <?php echo htmlspecialchars($row['Price']); ?></p>
                                <p class="book-meta"><small>🕒 <?php echo date("F j, Y", strtotime($row['created_at'])); ?></small></p>
                            </div>
                            <div class="actions">
                                <a
                                    href="update.php?id=<?php echo $row['id']; ?>"
                                    class="btn-small blue lighten-1 waves-effect waves-light"
                                    >✏️ Update</a
                                >
                                <a
                                    href="display.php?delete_id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this book?');"
                                    class="btn-small red lighten-1 waves-effect waves-light"
                                    >🗑️ Delete</a
                                >
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col s12">
                    <div class="empty-msg">No books are listed right now. Be the first to sell one!</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
