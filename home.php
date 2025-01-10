<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Shelf of Tales">
	<meta name="author" content="">
	<title>Shelf of Tales</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet"
	 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
	 integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
	 crossorigin="anonymous" 
	referrerpolicy="no-referrer" />
<style>
		.horizontal-line {
		  margin: 20px 0; /* Adds spacing above and below the line */
		  border-top: 2px solid white; /* Adjust thickness and color as needed */
		}

		.popup {
    display: none;
    position: absolute;
    background: #f9f9f9;
    border: 1px solid #ccc;
    padding: 15px;
    z-index: 1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }
  .ser {
        display: flex; 
        align-items: center;
	 }
    .ser > * {
        margin-right: 100px; 
    }
    .ser img {
        width: 50px; 
        height: auto; 
        margin-right: 0px;
    }
    .ser h5 {
        margin: 0; 
        padding-left: 5px; 
        font-size: 14px; 
    }

	  </style>
</head>
<body class="pic" >
	<section class="xyz">


<div class="navbar">
	<header style=" width: 100%; height: 100%;">
		<div  class="logo">
		<image src="images/image.jpg" width="100%" height="20%"></image>
		</div>

		


 
<!-- <div class="navbar"> -->
    <a href="home.php">Home</a>
	<a href="product.php">Product</a>
	<a href="contact.html">Contact</a>
    <a href="blog.html">Blog</a>
    <a href="research.html">Research</a>
    <div class="search-bar">
		<a href="123.php"><image src="images/cart.jpg.png" width="30px"></image></a>
        <input type="text" placeholder="Search...">
		<a href="logout.php">Logout</a>
    </div>
	
</div>
</section>
 	</header>	
        <div class="offer">
			<h1>CHOOSE YOUR AESTHETIC</h1><br><br><br><br><br><br>
             <h2>SALE UPTO 40%</h2><br><br.<br><br><br><br>
			 <!-- <p>Dive, Dine And Dream</p>  -->
			<div> <p style="align-text:right;">We care for your interest and enthusiasm about books.</p><br><br>
			 <p>So we provide you with the best offers </p></div>
			 <div id="fairy"><img src="images/read.webp" width="300px" height="100%"></div>
			 <img src="images/st.webp" width="300px" height="100%">
	   </div>

	   <div class="ser">
        <img src="images/del.jpg" alt="Home Delivery" style="width: 50px; height: auto;">
        <h5>Home Delivery</h5><br><br><br>
        
        <img src="images/py.jpg" alt="Payment" style="width: 50px; height: auto;">
        <h5>Payment</h5><br><br><br>
        
        <img src="images/qu.jpg" alt="Quality Assurance" style="width: 50px; height: auto;">
        <h5>Quality Assurance</h5><br><br><br>
        
        <img src="images/ret.jpg" alt="Guarantee Return" style="width: 50px; height: auto;">
        <h5>Guarantee Return</h5><br><br><br>
    </div>	
		 		<!--starting of first heading-->
				<div class="text">
					
				<h3 style="width:10%; padding: 20px">Books</h3>
				<div class="horizontal-line"><img src="images/gir.webp" alt="Image" class="abc"></div>
				</div>

				<table>

				<div class="book">
				 <!-- insterting image for book products -->
					

					<button onclick="togglePopup(popup)">
					<div id="popup" class="popup">
						<img src="images/harry.jpg" height="300px" width="100%">
						<h2>Harry Potter and the Sorcerer’s Stone</h2>
						<div class="price">Nrs. 1500</div>
						<p>"Turning the envelope over, his hand trembling, 
						Harry saw a purple wax seal bearing a coat of arms; a lion,
						 an eagle, a badger and a snake surrounding a large letter 'H'."
                        Harry Potter has never even heard of Hogwarts when the letters start dropping
						on the doormat at number four, Privet Drive. Addressed in green ink on
						yellowish parchment with a purple seal, they are swiftly confiscated by 
						his grisly aunt and uncle. Then, on Harry's eleventh birthday, 
						a great beetle-eyed giant of a man called Rubeus Hagrid bursts in
						with some astonishing news: Harry Potter is a wizard, and he has 
						a place at Hogwarts School of Witchcraft and Wizardry. An incredible
						adventure is about to begin!
</p>
					</div>
					
					<div class="book2">
						
							<img src="images/harry.jpg" height="300px" width="100%">
							<p style="padding-left: 20px;">Harry Potter and the Sorcerer’s Stone </p>
							<p style="padding-left:20px;">NPR.1500</p>
							<button name="add" onclick="addToCart('Harry Potter and the Sorcerer’s Stone', 1500)">Add To Cart</button>
					</div><br><br>
							 </div> </button>
					<br><br>

					<button onclick="togglePopup(popup1)">
					<div id="popup1" class="popup">
						<img src="images/3.jpg" height="100px" width="100%">
						<h2>The Tattoist of Auschwitz</h2>
						<div class="price">Nrs. 1800</div>
						<p>
							"Turning the envelope over, his hand trembling, 
							Harry saw a purple wax seal bearing a coat of arms; a lion,
							 an eagle, a badger and a snake surrounding a large letter 'H'."
							
							Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive.
							Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. 
							Then, on Harry's eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: 
							Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. 
							An incredible adventure is about to begin
						</p>
					</div>

					<div class="book3" >
						
							<img src="images/3.jpg" height="300px" width="100%">
							<p style="padding-left: 20px;">The Tattoist of Auschwitz</p>
							<p style="padding-left:20px;">NPR.1800</p>
							<button name="add" onclick="addToCart('The Tattoist of Auschwitz', 1800)">Add To Cart</button>
					</div><br><br></div></button>

					
					<button onclick="togglePopup(popup)">
					<div id="popup2" class="popup">
						<img src="images/11.jpg" height="100px" width="100%">
						<h2>Immortals of Meluha</h2>
						<div class="price">Nrs. 2100</div>
						<p>
						1900 BC. In what modern Indians mistakenly call the Indus Valley Civilisation. 
						The inhabitants of that period called it the land of Meluha a near perfect 
						empire created many centuries earlier by Lord Ram, one of the greatest monarchs that ever lived. 
						This once proud empire and its Suryavanshi rulers face severe perils as its primary river, 
						the revered Saraswati, is slowly drying to extinction. They also face devastating terrorist attacks 
						from the east, the land of the Chandravanshis. To make matters worse, the Chandravanshis appear to
					    have allied with the Nagas, an ostracised and sinister race of deformed humans with astonishing
						martial skills!
						</p>
					</div>
					<div class="book4" >
						<img src="images/11.jpg" height="300px" width="100%">
							<p style="padding-left: 20px;">Immortals of Meluha</p>
							<p style="padding-left:20px;">NPR.2100</p>
							<button name="add" onclick="addToCart('Immortals of Meluha', 2100)">Add To Cart</button>
					</div>
</table>
<div class="text">
    <h3 style="width: 4%;">Candles</h3>
    <div class="horizontal-line">
        <img src="images/gir.webp" alt="Image" class="abc">
    </div>
</div>

<div class="Candles">
    <div style="display: flex; flex-wrap: wrap;">
        <div class="candle1" style="flex: 0 0 25%; max-width: 25%; padding: 10px;">
            <img src="images/lav.jpg" height="300px" width="200px">
            <p>Lavender Scented Candles</p>
            <p>NPR.1580</p>
			<button class="add" onclick="addToCart('Lavender Scented Candles', 1580)">Add To Cart</button>
        </div>

        <div class="candle2" style="flex: 0 0 25%; max-width: 25%; padding: 10px;">
            <img src="images/peach.jpg" height="300px" width="200px">
            <p>Peach Scented Candles</p>
            <p>NPR.2100</p>
			<button name="add" onclick="addToCart('Peach Scented Candles', 2100)">Add To Cart</button>
        </div>

        <div class="candle4" style="flex: 0 0 25%; max-width: 25%; padding: 10px;">
            <img src="images/aqua.jpg" height="300px" width="200px">
            <p>Aqua Scented Candles</p>
            <p>NPR.4600</p>
			<button name="add" onclick="addToCart('Aqua Scented Candles', 4600)">Add To Cart</button>
        </div>

        <div class="candle5" style="flex: 0 0 25%; max-width: 25%; padding: 10px;">
            <img src="images/vanilla.jpg" height="300px" width="200px">
            <p>Vanilla Scented Candles</p>
            <p>NPR.750</p>
            <button name="add" onclick="addToCart('Vanilla Scented Candles', 750)">Add To Cart</button>
        </div>
    </div>
</div>

					

				<br>
				<br>
				<div class="text">
        <h3>Bookmarks</h3>
        <div class="horizontal-line">
            <img src="images/gir.webp" alt="Image" class="abc">
        </div>
    </div>

    <div class="Bookmark">
        <div class="bookmark1">
            <img src="images/bm1.jpg" alt="Paper Bookmark">
            <p style="padding-left: 1px;">Paper BookMark</p>
            <p style="padding-left: 20px;">NPR.80</p>
			<button name="add" onclick="addToCart('Paper BookMark', 80)">Add To Cart</button>
        </div>

        <div class="bookmark2">
            <img src="images/bm2.jpg" alt="Metal Bookmark">
            <p style="padding-left: 20px;">Metal BookMark</p>
            <p style="padding-left: 20px;">NPR.700</p>
			<button name="add" onclick="addToCart('Metal BookMark', 700)">Add To Cart</button>
        </div>

        <div class="bookmark3">
            <img src="images/bm3.avif" alt="Acrylic Bookmark">
            <p style="padding-left: 20px;">Acrylic Customizable BookMark</p>
            <p style="padding-left: 20px;">NPR.750</p>
			<button name="add" onclick="addToCart('Acrylic Customizable BookMark', 750)">Add To Cart</button>
			</div>
        </div>
    </div>

				<!--Starting of footer-->	
				<footer>
				
                   <div class="extra">
						<div style="float: left; padding-left:200px">
						<h3>Customer Care</h3>
						<!--list for customer care-->
							<ul class="customercare-list">
								<li><a href="#Help Center">Help Center</a></li>
								<li><a href="#How To Shop">How To Shop</a></li>
								<li><a href="#Gift Card">Gift Card</a></li>
								<li><a href="contact.html">Contact Us</a></li>
							</ul>
						</div><br><br>

						<div style="float: left; padding-left: 200px;">
							<h3>Learn More</h3>
							<ul class="bookstore-list">
								<li><a href="research.html">Research</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="#Terms & Conditions">Terms & Conditions</a></li>
								<li><a href="#Privacy Policy">Privacy Policy</a></li>
							</ul>
						</div><br><br>

						<!--links for social website-->
						<div style="float: left; padding-left:150px;">
							<h3>Stay Connected</h3>
							
							<div style="float:left;">
								<a href="https://www.facebook.com/"><image src="images/facebook.jpg" alt="logo" height="100%" width="30px"></image></a><!--link to facebook-->
							</div>

							<div style="float:left; padding-left:40px">
								<a href="https://www.instagram.com/"><image src="images/inatagram.jpg" alt="logo" height="100%" width="30px"></image></a><!--link to instagram-->
							</div>

							<div style="float:left; padding-left:40px">
								<a href="https://web.whatsapp.com/"><image src="images/whatsapp.png" alt="logo" height="100%" width="30px"></image></a><!--link to whatapp-->
							</div>

							<div style="float:left; padding-left:40px">
								<a href="https://twitter.com/"><image src="images/twitter.jpg" alt="logo" height="100%" width="30px"></image></a><!--link to twitter-->
							</div><br><br>

							<div style="text-align: center; padding-left: 100px;">
								<p>@2022 copyright All Rights Reserved</p><!--for copyright-->
							</div>
						</div>

						
					</div>
		
				</footer>
				<script>

					function togglePopup(popup) {
		 var popup = document.getElementById("popup");
		 if (popup.style.display === "none") {
		   popup.style.display = "block";
		 } else {
		   popup.style.display = "none";
		 }
	   }

	   function togglePopup(popup1) {
		 var popup1 = document.getElementById("popup1");
		 if (popup.style.display === "none") {
		   popup.style.display = "block";
		 } else {
		   popup.style.display = "none";
		 }
	   }

	   function togglePopup(popup2) {
		 var popup = document.getElementById("popup2");
		 if (popup.style.display === "none") {
		   popup.style.display = "block";
		 } else {
		   popup.style.display = "none";
		 }
	   }


	   function addToCart(productName, price) {
            // Send AJAX request to PHP script to add to cart
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addToCart.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Show response from PHP script (debugging)
                }
            };
            xhr.send("productname=" + productName + "&price=" + price);
        }
	   
			   </script>
</body>
</html>