<?php
    
 /*

The functions for user to delete record from database.  
Not actual page. 
Active by button [Delete] in showEvent.php

*/   
    include ('../connection.php');

        $id = $_GET['event_id'];
             
        $sql = "DELETE FROM Event WHERE event_id='$id'";
        $result = $db->query($sql);
        
        // Back to view Event page
        header("Location:showEvent.php");
        
        
?>

<!--ref:https://www.killersites.com/community/index.php?/topic/1969-basic-php-system-vieweditdeleteadd-records/-->
