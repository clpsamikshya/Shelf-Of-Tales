<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style1.css">
   <style>
   * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    background-image: url(images/bgg.png);
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: lavender;
    color: grey;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
.header {
    background-color: #D8BFD8;
    color: #fff;
    padding: 10px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header .logo {
    font-size: 50px;
    margin: 0;
    color: grey;
}

.header .navigation {
    text-align: right;
    margin-top: 10px;
}

.header .navigation ul {
    list-style-type: none;
}

.header .navigation ul li {
    display: inline-block;
    margin-left: 20px;
}

.header .navigation ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1.1rem;
}

.header .navigation ul li a:hover {
    text-decoration: underline;
}

.section {

    padding: 40px 0;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.service {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.service p{
    font-size: 1.3rem;
}
.service h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}</style>
</head>
<body>
<header class="header">
<!-- <div class="vertical-line"></div> -->
     <div class="container">
            <h1 class="logo">Shelf of Tales</h1>
            <nav class="navigation">
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="index1.php">Register</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
            </ul>
            </nav>
        </div>
    </header>


    <section id="services" class="section">
        <div class="container">
            <h2>Our Products</h2>
            <div class="services-grid">
                <div class="service">
                    <h3>Wide Range of Title</h3>
                   
                    <p>Explore a diverse collection of books spanning genres like fiction, non-fiction, children's books, and more.</p>
                </div>
                <div class="service">
                    <h3>Candles</h3>
                    <p>Make your Reading Experience more Soothing and enjoyable and enrich your connection with your book</p>
                </div>
                <div class="service">
                    <h3>BookMark</h3>
                    <p>Bookmarks are indispensable companions to books, 
                    offering both practical utility and personalization while enriching 
                    the reading experience through aesthetic appeal and sentimental value.</p>
                </div>
                <div class="service">
                    <h3>Gift Box</h3>
                    <p>You can gift your loved ones with exclusive gift box. 
                    Allow customers to build their own box by selecting books 
                    and adding optional extras like bookmarks, mugs, or snacks.</p>
                </div>
              
            </div>
        </div>
    </section>

    <script>
     			

    </script>
</body>
</html>