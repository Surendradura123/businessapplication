<?php
 include 'connect.php';
    include 'db.php';
      include("../header.php");
   $cookie_name = 'user';
   $email = $_COOKIE[$cookie_name];
?>

<!DOCTYPE html>
<html>
<head>
   
<title>My Shop</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    
    <table>
        <tr>
            <td>View All Save Events</td>
        </tr>
        
        <tr>
            <th>Event No</th>
            <th>Email</th>
            <th>Company ID</th>
            <th>Date</th>
            <th>Event Status</th>
        </tr>
    </table>
    <?php
    
    
      $i=0;
            
            $get_pro = "select * from Event";
            
            $run_pro = mysqli_query($con, $get_pro);
            
            while($row_pro=mysqli_fetch_array($run_pro)){
                
                $eid = $row_pro['eid'];
                $email = $row_pro['$email'];
                $cid = $row_pro['cid'];
                $date = $row_pro['date'];
                $status =$row_pro['status'];
                
                $i++;
            
    
    ?>
    
  
          <tr>
              <td> <?php echo $i;?> </td>
                <td> <?php echo $email; ?></td>
                <td> <?php echo $cid; ?></td>
                <td> <?php echo $date ?></td>
                 <td><?php echo $status; ?></td>
              
          </tr>
         
            
       </table>
  </body>
</html>
         