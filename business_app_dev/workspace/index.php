<?php
include 'extras.php';



// @ref: https://stackoverflow.com/questions/8662535/trigger-php-function-by-clicking-html-link
// This is used for the Admin button. When clicked, it sets the user_id to 3 (Admin) and redirects to admin log in 
if (isset($_GET['function'])){
     $cookie_name = 'user_id';
     $cookie_value = '3';
     setcookie($cookie_name, $cookie_value, NULL, '/');
     
     header("Location: account/admin/login.php");
}

?>

<head>
    <title>Hybrid - Home</title>
    
    <script src= js/javascript.js></script>
    <link rel="stylesheet" href="css/style.css">
    
    <style>
          #img {
            width: 40%;
          }
          
          #img_header {
            background-color: #dab59b;
            margin-top: 20px;
            
            
            
          }
          body { 
              overflow: visible;
          }

        
    </style>
    
    <!-- @ref: https://stackoverflow.com/questions/13975891/change-image-in-html-page-every-few-seconds -->
    <!-- This cycles through the images -->
    <script type = "text/javascript">
          function displayNextImage() {
              x = (x === images.length - 1) ? 0 : x + 1;
              document.getElementById("img").src = images[x];
          }

          function displayPreviousImage() {
              x = (x <= 0) ? images.length - 1 : x - 1;
              document.getElementById("img").src = images[x];
          }

          function startTimer() {
              setInterval(displayNextImage, 7500); //sets when images change to 7.5 seconds.
          }

          var images = [], x = -1;
          images[0] = "img/main_index/beach.jpg";
          images[1] = "img/main_index/clay.jpg";
          images[2] = "img/main_index/cycle.jpg";
          images[3] = "img/main_index/happy.jpg";
          images[4] = "img/main_index/talking.jpg";
          images[5] = "img/main_index/walker.jpg";
          images[6] = "img/main_index/family.jpg"; // All images used are in the public domain and were obtained from pexels.com.
      </script>
</head>
<body onload="startTimer()" style="display: inline-block;">

<?php echo $header_text;?> <!-- taken from extras.php -->



<div id="img_header">
     <center>
     <br>
     <font size="5" color="#7d24ad"><b><i>Search medical assistance or events, designed for the later stage in life</i></b></font>
     <br><br>
     <!-- @ref: https://stackoverflow.com/questions/13975891/change-image-in-html-page-every-few-seconds -->
     <img id="img" src="img/main_index/family.jpg"/>
     <br>
     <button type="button" onclick="displayPreviousImage()" title="Previous" alt="Previous"><img src="img/main_index/left-arrow.png" height="20px"></button><!-- ↞ -->
     <button type="button" onclick="displayNextImage()" title="Next" alt="Next"><img src="img/main_index/right-arrow.png" height="20px"></button><!-- ↠ -->
                 <!-- @ref: Arrow images: http://www.iconsplace.com/purple-icons/arrow-icon -->
          <hr/>
     <br>

     <a href="customersearch/index.php" class="button"><font size="5" color="#7d24ad">Search</font></a>
     &nbsp;-&nbsp;
     <a href="account/register.php" class="button"><font size="5" color="#7d24ad">Register</font></a>
     &nbsp;-&nbsp;
     <a href="account/login.php" class="button"><font size="5" color="#7d24ad">Login</font></a>
     &nbsp;-&nbsp;
     <a href="customersaveevent/home.php" class="button"><font size="5" color="#7d24ad">Events</font></a>
     
     </center>
     <br>
     <hr/>
     <a href='?function' class='button'>Switch to Admin account</a>
     <!-- @ref - ?function - https://stackoverflow.com/questions/8662535/trigger-php-function-by-clicking-html-link-->
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>


