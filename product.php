<?php
include 'connection.php';

$sql = "SELECT * FROM Books ORDER BY Genre, BookName";
$result = $conn->query($sql);

$books_by_genre = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books_by_genre[$row['Genre']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shelf of Tales - Books</title>
  <link rel="stylesheet" href="style2.css" />
  <style>
    .hidden {
      display: none;
    }

    .see-toggle-btn {
      float: right;
      margin-top: -30px;
      margin-right: 10px;
      background-color: #5e3b6a;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    .see-toggle-btn:hover {
      background-color: #51305bff;
    }
  </style>
</head>
<body>
<header>
<div class="navbar">
      <div class="logo">
        <img src="images/img.jpg" alt="Logo" />
      </div>

      <nav class="nav-links">
        <a href="home.php">Home</a>
        <a href="product.php">Product</a>
        <a href="contact.html">Contact</a>
        <a href="blog.html">Blog</a>
        <a href="research.html">Research</a>
      </nav>

      <div class="search-bar">
        <a href="cart.php"><img src="images/cart.jpg.png" alt="Cart" width="30"/></a>
        <input type="text" placeholder="Search..." />
        <a href="logout.php">Logout</a>
      </div>
    </div>
</header>

<?php foreach ($books_by_genre as $genre => $books): ?>
  <div class="text">
    <h3><?php echo htmlspecialchars($genre, ENT_QUOTES); ?></h3>
    <div class="horizontal-line"></div>
    <button 
      class="see-toggle-btn" 
      id="toggleBtn-<?php echo md5($genre); ?>" 
      onclick="toggleBooks('<?php echo md5($genre); ?>')"
    >See All</button>
  </div>
  <section class="book genre-group-<?php echo md5($genre); ?>">
    <?php foreach ($books as $index => $row): ?>
      <?php
        $bookName = addslashes(htmlspecialchars($row['BookName'], ENT_QUOTES));
        $price = number_format($row['Price'], 2);
        $imagePath = strpos($row['Image'], 'images/') === 0 
                     ? htmlspecialchars($row['Image'], ENT_QUOTES)
                     : 'images/' . htmlspecialchars($row['Image'], ENT_QUOTES);
        $description = addslashes(htmlspecialchars($row['Description'] ?: "No description available.", ENT_QUOTES));
      ?>
      <article class="book-item <?php echo $index >= 3 ? 'hidden' : ''; ?>">
        <img src="<?php echo $imagePath; ?>" alt="<?php echo $bookName; ?>" />
        <p><?php echo $bookName; ?></p>
        <p>NPR. <?php echo $price; ?></p>
        <button class="button" onclick="event.stopPropagation(); addToCart('<?php echo $bookName; ?>', <?php echo $price; ?>)">Add To Cart</button>
      </article>
    <?php endforeach; ?>
  </section>
<?php endforeach; ?>

<!-- Modal structure -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Product Image" />
    <h2 id="modalName">Product Name</h2>
    <p id="modalDescription">Product description goes here...</p>
    <p id="modalPrice">NPR 0</p>
    <button id="modalAddToCart" class="button">Add to Cart</button>
  </div>
</div>

<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h3>Customer Care</h3>
      <ul>
        <li><a href="#Help Center">Help Center</a></li>
        <li><a href="#How To Shop">How To Shop</a></li>
        <li><a href="#Gift Card">Gift Card</a></li>
        <li><a href="contact.html">Contact Us</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Learn More</h3>
      <ul>
        <li><a href="research.html">Research</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="#Terms & Conditions">Terms & Conditions</a></li>
        <li><a href="#Privacy Policy">Privacy Policy</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Stay Connected</h3>
      <div class="social-icons">
        <a href="https://www.facebook.com/"><img src="images/facebook.jpg" alt="Facebook" width="30" height="30"></a>
        <a href="https://www.instagram.com/"><img src="images/insta.jpg" alt="Instagram" width="30" height="30"></a>
        <a href="https://web.whatsapp.com/"><img src="images/whatsapp.png" alt="WhatsApp" width="30" height="30"></a>
        <a href="https://twitter.com/"><img src="images/twitter.jpg" alt="Twitter" width="30" height="30"></a>
      </div>
    </div>
  </div>
</footer>

<form id="addToCartForm" action="addtocart.php" method="POST" style="display:none;">
  <input type="hidden" name="ProductName" id="formProductName" />
  <input type="hidden" name="Price" id="formPrice" />
</form>

<script>
function addToCart(name, price) {
  document.getElementById('formProductName').value = name;
  document.getElementById('formPrice').value = price;
  document.getElementById('addToCartForm').submit();
}

function showProductModal(name, price, imgSrc, desc = "No description available.") {
  document.getElementById('modalName').textContent = name;
  document.getElementById('modalPrice').textContent = "NPR " + parseFloat(price).toFixed(2);
  document.getElementById('modalImage').src = imgSrc;
  document.getElementById('modalImage').alt = name;
  document.getElementById('modalDescription').textContent = desc;

  document.getElementById('modalAddToCart').onclick = function() {
    addToCart(name, price);
  };

  document.getElementById('productModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('productModal').style.display = 'none';
}

window.onclick = function(event) {
  const modal = document.getElementById('productModal');
  if (event.target === modal) closeModal();
};

// Toggle "See All" / "See Less"
function toggleBooks(genreHash) {
  const container = document.querySelector(`.genre-group-${genreHash}`);
  const allBooks = container.querySelectorAll('.book-item');
  const btn = document.getElementById(`toggleBtn-${genreHash}`);

  const isExpanded = Array.from(allBooks).filter((b, i) => i >= 3 && b.style.display !== 'none' && !b.classList.contains('hidden')).length > 0;

  if (isExpanded) {
    // Collapse back to 3
    allBooks.forEach((book, index) => {
      if (index >= 3) book.classList.add('hidden');
    });
    btn.textContent = "See All";
  } else {
    // Show all
    allBooks.forEach(book => book.classList.remove('hidden'));
    btn.textContent = "See Less";
  }
}
</script>
</body>
</html>
