<?php 
include "../connection.php";

$cookie_name = "link";
$link = $_COOKIE[$cookie_name];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Search</title>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src= ../js/javascript.js></script>

</head>

<body>

<!-- Header start -->
<div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/">Home</a>
    <div class="dropdown">
    <button class="active dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="../account/register.php">Register</a>
      <a href="../account/profile.php">Profile</a>
      <a href="../account/edit.php">Edit details</a>
      <a href="../account/logged_out.php">Sign out</a>
    </div>
  </div> 
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>
<!-- Header end -->
<center>
  <div class="bodyContainer">
     <p>You are being directed to <b><?php echo $link ?></b>. Do you wish to continue?</p>
     <p><a href="<?php echo $link ?>" target="_blank" class="button">Yes</a></p>
  </div>
</center>
