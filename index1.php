<!DOCTYPE html>
<html lang="en">

 <style>
     .center{
            padding:50px;
        }
        body{
    background-image: url(images/bg.png);
}
        </style>

        <script defer src="validate.js"></script>
   
<body>
      <?php include('header.php');?> 
    
    <section class="container grey-text">
        <h4 class="center"></h4>
    <form id="myform" class="white" name="myforms" method="post"  action="registration.php">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" autocomplete="off" required><br><br>
        <!-- <div class="red-text"></div> -->
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" autocomplete="off" required><br><br>
        <!-- <div class="red-text"></div> -->
        <label for="email">Email</label>
        <input type="email" name="email" value="" autocomplete="off" required><br><br>
        <label for="uname">username</label>
        <input type="text" name="uname" value="" autocomplete="off" required><br><br>
       <!-- <div class="red-text"></div> -->
        <label type="pword">password</label>
        <input type="password" name="pword" value="" autocomplete="off" required> <br><br>
        <div class="red-text"></div>
        <label for="contact">Contact</label>
        <input type="text" name="contact" value="" autocomplete="off" required><br><br>
        <div class="red-text"></div>
        <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">  
    </form>   
    </section>
      
        
</body>
</html>