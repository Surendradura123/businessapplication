
<?php

    $sql = "select * from Event";
    $result = $conn->query($sql);
    
    // Count the total records
    
    $total_event = mysqli_num_rows($result);
    
    //dividing the total pages
    
    $total_pages = ceil($total_event/ $per_page);
    
    //Going to first page
   
    
    echo "
    <center>
    <div class = 'pagination' style='background-color:green;'>
    <a href='../customersaveevent/home.php?page=1'>First Page</a>
  
    ";
    
    for($i=1; $i<=$total_pages; $i++){
         echo "<a href='../customersaveevent/home.php?page=$i'>$i</a>";
    }
    
    //Going to last page
    
    echo "<a href='../customersaveevent/home.php?page=$total_pages'>Last Page</a> </center></div>";
?>