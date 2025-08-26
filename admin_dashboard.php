<?php
session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['UserName'] !== 'admin') {
    header("Location: home.php");
    exit;
}

include 'connection.php';

$message = "";

// Handle delete request securely for Books
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "✅ Book deleted successfully.";
    } else {
        $message = "❌ Error deleting book: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
}

// Handle delete request securely for Accessories
if (isset($_GET['delete_accessory'])) {
    $accId = intval($_GET['delete_accessory']);

    $stmt = $conn->prepare("DELETE FROM accessories WHERE id = ?");
    $stmt->bind_param("i", $accId);

    if ($stmt->execute()) {
        $message = "✅ Accessory deleted successfully.";
    } else {
        $message = "❌ Error deleting accessory: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
}

// Fetch all books
$result = $conn->query("SELECT * FROM books ORDER BY Genre, BookName");
$books = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Fetch all accessories
$resultAcc = $conn->query("SELECT * FROM accessories ORDER BY Category, Name");
$accessories = [];
if ($resultAcc && $resultAcc->num_rows > 0) {
    while ($rowAcc = $resultAcc->fetch_assoc()) {
        $accessories[] = $rowAcc;
    }
}

$conn->close();

// Helper function to truncate description safely
function truncate_text($text, $chars = 100) {
    if (strlen($text) <= $chars) return htmlspecialchars($text);
    $truncated = substr($text, 0, $chars);
    // Cut at last space to avoid cutting words
    $truncated = substr($truncated, 0, strrpos($truncated, ' '));
    return htmlspecialchars($truncated) . '...';
}

// Image folder path relative to this PHP file
$imageFolder = 'images/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard - Manage Books & Accessories</title>
<style>
  /* Reset */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    margin: 0;
    padding: 20px 15px;
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  h1 {
    color:#987c98;
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 25px;
    text-align: center;
    text-shadow: 0 2px 4px rgba(79, 70, 229, 0.3);
  }

  .message {
    max-width: 900px;
    margin: 10px auto 25px auto;
    padding: 15px 20px;
    background-color: #dbeafe;
    border-left: 6px solid #6366f1;
    color: #987c98;
    font-weight: 600;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    user-select: none;
    transition: background-color 0.3s ease;
  }

  .top-bar {
    width: 100%;
    max-width: 900px;
    margin-bottom: 30px;
    display: flex;
    gap: 15px;
    justify-content: flex-start;
    align-items: center;
    flex-wrap: wrap;
  }

  .top-bar > a {
    background: #987c98;
    color: white;
    padding: 12px 22px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    box-shadow: 0 6px 12px rgba(99, 102, 241, 0.25);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    flex-shrink: 0;
  }

  .top-bar > a:hover {
    background: #987c98;
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
  }

  .logout-link {
    margin-left: auto;
    background: transparent;
    color: #987c98;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: underline;
    padding: 10px 18px;
    border-radius: 10px;
    box-shadow: none;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .logout-link:hover {
    color: #987c98;
  }

  table {
    width: 100%;
    max-width: 900px;
    border-collapse: separate;
    border-spacing: 0 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    background: white;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 50px;
  }

  thead tr {
    background-color: #987c98;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 15px 15px 0 0;
  }

  thead th {
    padding: 15px 12px;
  }

  tbody tr {
    background: #fafafa;
    box-shadow: 0 3px 6px rgba(0,0,0,0.05);
    border-radius: 10px;
    transition: transform 0.2s ease;
  }

  tbody tr:hover {
    background: #e0e7ff;
    transform: translateY(-3px);
  }

  tbody td {
    text-align: center;
    padding: 15px 10px;
    vertical-align: middle;
    font-size: 0.95rem;
    color: #333;
    max-width: 150px;
    word-wrap: break-word;
  }

  tbody td img {
    max-width: 80px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 3px 8px rgba(79, 70, 229, 0.3);
  }

  .btn {
    padding: 7px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    color: white;
    cursor: pointer;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: background-color 0.25s ease, box-shadow 0.25s ease;
    display: inline-block;
    font-size: 0.9rem;
    user-select: none;
  }

  .edit-btn {
    background-color: #987c98;
  }

  .edit-btn:hover {
    background-color: #987c98;
    box-shadow: 0 6px 15px hsla(221, 83%, 53%, 0.23);
  }

  .delete-btn {
    background-color: #ef4444;
  }

  .delete-btn:hover {
    background-color: #b91c1c;
    box-shadow: 0 6px 15px rgba(239, 68, 68, 0.5);
  }

  /* Description container and read more */
  .desc-container {
    max-width: 200px;
    position: relative;
  }
  .desc-text {
    white-space: pre-wrap;
  }
  .read-more-btn {
    background: transparent;
    border: none;
    color: #987c98;
    font-weight: 700;
    cursor: pointer;
    padding: 0;
    margin-left: 4px;
    font-size: 0.9rem;
    user-select: none;
  }

  /* Responsive */
  @media (max-width: 950px) {
    .top-bar {
      justify-content: center;
    }
    .logout-link {
      margin-left: 0;
    }
  }

  @media (max-width: 700px) {
    table, thead tr, tbody tr, tbody td, thead th {
      display: block;
      width: 100%;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 20px;
      background: white;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      border-radius: 12px;
      padding: 15px 10px;
    }
    tbody td {
      text-align: left;
      padding: 8px 12px;
      position: relative;
      font-size: 0.9rem;
      border-bottom: 1px solid #ddd;
    }
    tbody td:last-child {
      border-bottom: none;
    }
    tbody td::before {
      content: attr(data-label);
      font-weight: 700;
      color: #4f46e5;
      position: absolute;
      left: 12px;
      top: 8px;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    tbody td img {
      max-width: 100%;
      height: auto;
      margin-top: 8px;
      box-shadow: none;
    }
    .btn {
      margin-right: 10px;
      margin-top: 8px;
      font-size: 0.9rem;
      padding: 8px 16px;
    }
  }
</style>

<script>
  function toggleDescription(id) {
    const shortDesc = document.getElementById('short-desc-' + id);
    const fullDesc = document.getElementById('full-desc-' + id);
    const btn = document.getElementById('read-more-btn-' + id);

    if (shortDesc.style.display !== 'none') {
      shortDesc.style.display = 'none';
      fullDesc.style.display = 'inline';
      btn.textContent = 'Show less';
    } else {
      shortDesc.style.display = 'inline';
      fullDesc.style.display = 'none';
      btn.textContent = 'Read more';
    }
  }
</script>
</head>
<body>

<div class="top-bar">
  <a class="add-book-btn" href="addbook.php">+ Add New Book</a>
  <a class="add-accessory-btn" href="add_accessory.php">+ Add Accessories</a>
  <a class="logout-link" href="logout.php">Logout</a>
</div>

<h1>Admin Dashboard - Manage Books</h1>

<?php if ($message): ?>
  <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (count($books) === 0): ?>
  <p style="text-align:center; color:#666; font-size: 1.1rem;">No books found in the database.</p>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Book Name</th>
        <th>Genre</th>
        <th>Author</th>
        <th>Price (NPR)</th>
        <th>Image</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($books as $book): ?>
        <tr>
          <td data-label="ID"><?= $book['id'] ?></td>
          <td data-label="Book Name"><?= htmlspecialchars($book['BookName']) ?></td>
          <td data-label="Genre"><?= htmlspecialchars($book['Genre']) ?></td>
          <td data-label="Author"><?= htmlspecialchars($book['Author']) ?></td>
          <td data-label="Price (NPR)"><?= number_format($book['Price'], 2) ?></td>
          <td data-label="Image">
           <?php
            $imgPath = $imageFolder . $book['Image'];
            $imgFullPath = __DIR__ . '/' . $imgPath;
            if ($book['Image'] && file_exists($imgFullPath)):
           ?>
              <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($book['BookName']) ?>" />
           <?php else: ?>
              N/A
           <?php endif; ?>
          </td>
          <td data-label="Description">
            <div class="desc-container">
              <span id="short-desc-<?= $book['id'] ?>" class="desc-text"><?= truncate_text($book['Description'], 100) ?></span>
              <span id="full-desc-<?= $book['id'] ?>" class="desc-text" style="display:none;"><?= nl2br(htmlspecialchars($book['Description'])) ?></span>
              <?php if (strlen($book['Description']) > 100): ?>
                <button class="read-more-btn" id="read-more-btn-<?= $book['id'] ?>" onclick="toggleDescription(<?= $book['id'] ?>)">Read more</button>
              <?php endif; ?>
            </div>
          </td>
         <td data-label="Actions">
  <a class="btn edit-btn" href="addbook.php?id=<?= $book['id'] ?>">Edit</a>
  <a class="btn delete-btn" href="?delete=<?= $book['id'] ?>" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
</td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>


<h1>Admin Dashboard - Manage Accessories</h1>

<?php if (count($accessories) === 0): ?>
  <p style="text-align:center; color:#666; font-size: 1.1rem;">No accessories found in the database.</p>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price (NPR)</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($accessories as $acc): ?>
        <tr>
          <td data-label="ID"><?= $acc['id'] ?></td>
          <td data-label="Name"><?= htmlspecialchars($acc['Name']) ?></td>
          <td data-label="Category"><?= htmlspecialchars($acc['Category']) ?></td>
          <td data-label="Price (NPR)"><?= number_format($acc['Price'], 2) ?></td>
          <td data-label="Image">
            <?php 
              $accImgPath = $imageFolder . $acc['Image'];
              $accImgFullPath = __DIR__ . '/' . $accImgPath;
              if ($acc['Image'] && file_exists($accImgFullPath)):
            ?>
              <img src="<?= htmlspecialchars($accImgPath) ?>" alt="<?= htmlspecialchars($acc['Name']) ?>" />
            <?php else: ?>
              N/A
            <?php endif; ?>
          </td>
          <td data-label="Actions">
            <a class="btn edit-btn" href="add_accessory.php?id=<?= $acc['id'] ?>">Edit</a>
            <a class="btn delete-btn" href="?delete_accessory=<?= $acc['id'] ?>" onclick="return confirm('Are you sure you want to delete this accessory?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

</body>
</html>
