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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Books</title>
<link rel="stylesheet" href="style2.css">
<style>
.search-btn{
    background: #D8BFD8 !important;  /* your brand color */
    color: #fff !important;
    font-weight: bold;
    transition: 0.3s ease;
}

.search-btn:hover{
    background: #C2A3C2 !important;  /* slightly darker on hover */
    color: #fff !important;
}

.search-form input:focus {
    border-color: #D8BFD8;
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
   <div class="search-bar">
    <a href="cart.php"><img src="images/cart.jpg.png" alt="Cart" width="30"/></a>
   <form action="search.php" method="GET" class="search-form" style="max-width:460px; margin:20px auto; display:flex; align-items:center; position:relative;">
    <input type="text" id="searchInput" name="query" placeholder="Search books..." autocomplete="off" style="flex:1; padding:10px 15px; border-radius:25px 0 0 25px; border:1px solid #ccc; outline:none;">
    <button type="submit" class="btn search-btn" style="border-radius:0 25px 25px 0; margin-left:-1px; padding:10px 20px;">Search</button>
    <div id="suggestions" style="position:absolute; top:50px; left:0; right:0; background:#fff; border:1px solid #ccc; z-index:1000; max-height:300px; overflow-y:auto;"></div>
</form>
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
        <img src="<?php echo $imagePath; ?>" alt="<?php echo $bookName; ?>" onclick="showProductModal('<?php echo $bookName; ?>', <?php echo $price; ?>, '<?php echo $imagePath; ?>', '<?php echo $description; ?>')"/>
        <p><?php echo $bookName; ?></p>
        <p>NPR. <?php echo $price; ?></p>
        <button class="button" onclick="addToCart('<?php echo $bookName; ?>', <?php echo $price; ?>)">Add To Cart</button>
      </article>
    <?php endforeach; ?>
  </section>
<?php endforeach; ?>

<!-- Modal -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Product Image" width="150" />
    <h2 id="modalName">Product Name</h2>
    <p id="modalDescription">Product description goes here...</p>
    <p id="modalPrice">NPR 0</p>
    <button id="modalAddToCart" class="button">Add to Cart</button>
  </div>
</div>

<form id="addToCartForm" action="addtocart.php" method="POST" style="display:none;">
  <input type="hidden" name="ProductName" id="formProductName" />
  <input type="hidden" name="Price" id="formPrice" />
</form>

<script>
// Add to Cart
function addToCart(name, price) {
  document.getElementById('formProductName').value = name;
  document.getElementById('formPrice').value = price;
  document.getElementById('addToCartForm').submit();
}

// Modal
function showProductModal(name, price, imgSrc, desc = "No description available.") {
  document.getElementById('modalName').textContent = name;
  document.getElementById('modalPrice').textContent = "NPR " + parseFloat(price).toFixed(2);
  document.getElementById('modalImage').src = imgSrc;
  document.getElementById('modalImage').alt = name;
  document.getElementById('modalDescription').textContent = desc;
  document.getElementById('modalAddToCart').onclick = function() { addToCart(name, price); };
  document.getElementById('productModal').style.display = 'block';
}
function closeModal() { document.getElementById('productModal').style.display = 'none'; }
window.onclick = function(event) { if(event.target === document.getElementById('productModal')) closeModal(); }

// See All toggle
function toggleBooks(genreHash) {
  const container = document.querySelector(`.genre-group-${genreHash}`);
  const allBooks = container.querySelectorAll('.book-item');
  const btn = document.getElementById(`toggleBtn-${genreHash}`);
  const isExpanded = Array.from(allBooks).some((b,i)=>i>=3 && !b.classList.contains('hidden'));
  allBooks.forEach((book,i)=>{ if(i>=3) book.classList.toggle('hidden'); });
  btn.textContent = isExpanded ? "See All" : "See Less";
}

const input = document.getElementById('searchInput');
const box = document.getElementById('suggestions');

input.addEventListener('input', () => {
    const val = input.value.trim();
    if(!val) return box.innerHTML = '';
    fetch('search_suggestions.php?query=' + encodeURIComponent(val))
        .then(r => r.json())
        .then(data => {
            box.innerHTML = '';
            data.forEach(book => {
                const div = document.createElement('div');
                div.style.display = 'flex';
                div.style.alignItems = 'center';
                div.style.padding = '5px';
                div.style.cursor = 'pointer';
                div.innerHTML = `<img src="${book.Image}" width="40" style="margin-right:10px;"> ${book.BookName}`;
                div.onclick = () => {
                    input.value = book.BookName;
                    box.innerHTML = '';
                    window.location = 'search.php?query=' + encodeURIComponent(book.BookName);
                };
                box.appendChild(div);
            });
        });
});

// Hide suggestions when clicking outside
document.addEventListener('click', function(e){
    if(!input.contains(e.target) && !box.contains(e.target)){
        box.innerHTML = '';
    }
});
</script>


	<!--Starting of footer-->	
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


</body>
</html>
