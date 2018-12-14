<?php
    include ('connect.php');
    include ('db.php');


        $id = $_GET['id'];;
             
        $sql = "DELETE FROM Event WHERE id='$id' ";
        $result = $conn->query($sql);
        header("Location:showEvent.php");
        
        
?>