<?php
include "../connection.php";
include "../extras.php";

$cookie_name    = 'user';
$email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user' cookie.

$sql3  = "SELECT * FROM Company WHERE rep_email = '$email'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$company_id = $row3['company_id'];


if (isset($_GET["page"])) { 
     $page  = $_GET["page"]; } 
else { 
     $page=1; 
}; 

$results_per_page = 3; 
$start_from = ($page-1) * $results_per_page;
$sql = "SELECT * FROM Event WHERE company_id = '$company_id' ORDER BY event_id ASC LIMIT $start_from, ".$results_per_page;

$rs_result = $db->query($sql); 
?>
<body>
      <!--<?php echo $header_text;?>-->
<table border="1" cellpadding="4">

<?php 
 while($row = $rs_result->fetch_assoc()) {

 echo "<tr>
          <td>{$row['event_id']}</td>
          <td>{$row['event_name']}</td>
          <td>{$row['description']}</td>
          <td>{$row['event_address1']}</td>
          <td>{$row['event_address2']}</td>
          <td>{$row['event_city']}</td>
          <td>{$row['event_eircode']}</td>
          <td>{$row['date']}</td>
          <td>{$row['start_time']}</td>
          <td>{$row['end_time']}</td>
     </tr>

";
}
?>
</table> 
</body>
  <?php echo $footer_msg ?>
</html>

<?php
$sql2 = "SELECT COUNT(event_id) AS total FROM Event";
$result2 = $db->query($sql2);
$row2 = $result2->fetch_assoc();
$total_pages = ceil($row2["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
     };
?>