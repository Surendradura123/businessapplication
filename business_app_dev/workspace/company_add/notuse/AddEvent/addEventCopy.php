<?php
    include '../connection.php';
    include '../header.php';
    include '../footer.php';
    session_start();
    
    if (!($user_type_id == '2')){
        header ('Location: /');
    }

if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $company_id         = !empty($_POST['company_id']) ? $_POST['company_id'] : ""; /* not null */
    $event_name         = !empty($_POST['event_name']) ? $_POST['event_name'] : ""; /* not null */
    $description        = !empty($_POST['desscription']) ? $_POST['desscription'] : "";
    $event_address1     = !empty($_POST['event_address1']) ? $_POST['event_address1'] : ""; /* not null */
    $event_address2     = !empty($_POST['event_address2']) ? $_POST['event_address2'] : "";
    $event_city         = !empty($_POST['event_city']) ? $_POST['event_city'] : "";
    $event_eircode      = !empty($_POST['event_eircode']) ? $_POST['event_eircode'] : "";
    $date               = !empty($_POST['date']) ? $_POST['date'] : "";
    $edit_date          = date("Y-m-d",strtotime($date));
    
    $start_time         = !empty($_POST['start_time']) ? $_POST['start_time'] : "";
    $edit_start_time    = $start_time.":00";
    
    $end_time           = !empty($_POST['end_time']) ? $_POST['end_time'] : "";
    $edit_end_time      = $end_time.":00";
    

 
    /* Field Required */
    $aFieldRequired = [
        $company_id,
        $event_name,
        $description,
        $event_address1,
        $date,
        $start_time
        
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ""){
            $bFieldRequired = true;
            break;
        }
    }
    /* END */
    

    $successDB = false;
    if(!$bFieldRequired){//Insert in db only if the mandatory fields are filled.
        $sql = "INSERT INTO Event (event_id, company_id, event_name, description, event_address1, event_address2, event_city, event_eircode, date, start_time, end_time) 
        VALUES ('', $company_id', '$event_name', '$description','$event_address1','$event_address2','$event_city','$event_eircode','$edit_date','$edit_start_time', '$edit_end_time)'";

        $successDB = $db->query($sql);
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <link rel="stylesheet" href="../css/style.css">

    <title>HybirdWeb</title>
    
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 255) {
          val.value = val.value.substring(0, 255);
        } else {
          $('#charNum').text(255 - len);
        }
      };

    </script>
    
    
</head>

<body>
     <?php echo "Date: ".$edit_date.
               "<br>Start time: ".$edit_start_time.
               "<br>End time: ".$edit_end_time ; ?>
    <div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/" class="active"><font color="white">Home</font></a>
    <div class="dropdown">
    <button class="dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="../../account/register.php" class="active">Register</a>
      <a href="../../account/profile.php">Profile</a>
      <a href="../../account/edit.php">Edit details</a>
      <a href="../../account/logged_out.php">Sign out</a>
    </div>
  </div> 
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>

    
            <a href='showEvent.php'><button>View Event</button></a>
            <br>
            <br>
        <h4>Event Add Page</h4>
        
        
        <form action="" method="post">
         
         <!--userid-->
     
                <input name='company_id' type='text' value='<?php echo $company_id ?>' hidden='true'> <!-- $company_id is defined in the header.php -->
           
            
             
            <!--Name of Event-->
         
                <label for='event_name' class='control-label'>Name of Event</label>
                <input name='event_name' id='event_name' pattern='[a-zA-Z0-9\s]{1,20}' title='Letters and numbers only, max 20 characters.' type='text'  placeholder='' required><font color="red"><sup>*</sup></font>
           

            <!--Description-->
          
                <label for='description'>Description</label>
                <textarea name='description' id='description' pattern='[a-zA-Z0-9\s]{50,255}' onkeyup="countChar(this)" placeholder="Minimun of 50 characters" title='Letters and numbers only.' rows='5'  maxlength='255'required></textarea><font color="red"><sup>*</sup></font>
                Characters left: <qqq id="charNum">255</qqq>/255
           

            <!--Address-->
            
                <label for='event_address1' >Address Line 1</label>
                <input name='event_address1' id='event_address1' pattern='^[a-zA-Z0-9\s,]*$' title='Letters and numbers only.' placeholder='Where is the event being held?' type='text' required ><font color="red"><sup>*</sup></font>
            

            <!--Address2-->
                <label for='event_address2' class='control-label'>Address Line 2</label>
                <input name='event_address2' id='event_address2' pattern='^[a-zA-Z0-9\s,.]*$'  title='Letters and numbers only.' type='text'>
           

            <!--Row Start Selecter Country/City-->


                    <!--Selecter City-->
           
                        <label for='event_city'>City</label>
                        <input name='event_city' id='event_city' pattern='[a-zA-Z0-9\s]{1,100}' title='Letters and numbers only.' type='text' >

                    <!--Eircode-->
                   
                        <label for='event_eircode'>Eircode</label>
                        <input name='event_eircode' id='event_eircode' pattern='[a-zA-Z0-9\s]{7}' title='Letters and numbers only.' type='text' placeholder='' maxlength='7'>
     
                <!--Row Finish-->
 
   
                                <label class='search-lab'>Date</label>
                                    <input type='date' name='date' id='date' placeholder='YYYY-MM-DD' required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' title='Enter a date in this format YYYY-MM-DD'/><font color="red"><sup>*</sup></font>
                                    
                                
                                
                                <label class='search-lab'>Start Time</label>
                                    <input type='time' name='start_time' required pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/><font color="red"><sup>*</sup></font>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                <label>End Time</label>
                                    <input type='time' name='end_time' pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>


                
                    <input type="submit" value="Submit">
                
        </form>
      <?php
                    if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("");
                    }
                    else if (isset($successDB) && !$successDB){
                        echo ("<font color='red'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                        //header( 'Location: ../../error.html' ) ;
                    }
                    else if (isset($successDB) && $successDB){
                        echo ("<font color='#3eb740'>Thank you. Your event has been created and is queued for approvial.</font>");
                    }
                    ?>
        </div>

</body>
  <?php echo $footer_msg ?>
</html>
