<?php
include "../extras.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Search</title>
              
              
              <link rel='stylesheet' type='text/css' href='../css/style.css'>
              <script src= ../js/javascript.js></script>

</head>

<body>

<?php echo $header_text;?>

<p>&nbsp;</p>
<center>
<div class="bodyContainer">
     <h2>Search</h2>
     <form action="" method="post">
     <!----- Select Option Fields Starts Here ----->
     <label for="mainSearch">Search the Services:</label>
     <br>
     <input title="Search" id="mainSearch" name="mainSearch" type="search" required><font color="red"><sup>*</sup></font>
     <br><br>

     <label class="heading">Website:</label>
     <br>
     
     <td>
     <select multiple name="service[]">
          
          <option value="https://www.hse.ie/eng/search?q="/>HSE
          <option value="https://data.gov.ie/dataset?q="/>Gov-Hospitals
          <option value="https://www.giveblood.ie/Search/?cof=FORID%3A11&cx=000825887272978772436%3Anbqkywjjhyo&ie=UTF-8&q="/>Bloodfusions
     
     </td>
     
     </select>
     <br><br>
     <input name="submit" type="submit" value="Submit">

     
     <?php
     if(isset($_POST['submit'])){
     if(!empty($_POST['service'])) {
     
     foreach ($_POST['service'] as $service)
     {
          if($service == "event"){
               header ("Location: ../../company_add/showEvent.php"); //this to be fixed.
          }
          else{
          $term = $_POST['mainSearch'];
          header ("Location: ../../customersearch/redirect.php");
          $cookie_name = "link";
          $cookie_value = $service.$term;
          setcookie($cookie_name, $cookie_value, NULL, '/');
          }
     }
     }
     else { echo "<span>Please Select At least One option.</span><br/>";}
     }
     ?>
     </form>
     </br>
     
     
     <br><br>
     <hr/>
     <br><br>
     <input type="button" value="Search Events" onclick="window.location.href='../customersearch/index.1.php'" />
</div>
</center>

</body>
<?php echo $footer_msg;?>
</html>