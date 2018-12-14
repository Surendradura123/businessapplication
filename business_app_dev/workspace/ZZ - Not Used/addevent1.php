<?php 
include 'connection.php';
include 'header.php';

if(count($_POST)>0){//Check if there are variables passed in $ _POST

    $event_name         = !empty($_POST['event_name']) ? $_POST['event_name'] : ""; /* not null */
    $description        = !empty($_POST['description']) ? $_POST['description'] : "";
    $event_address1     = !empty($_POST['event_address1']) ? $_POST['event_address1'] : ""; /* not null */
    $event_address2     = !empty($_POST['event_address2']) ? $_POST['event_address2'] : "";
    $event_city         = !empty($_POST['event_city']) ? $_POST['event_city'] : "";
    $event_eircode      = !empty($_POST['event_eircode']) ? $_POST['event_eircode'] : "";
    $date               = !empty($_POST['date']) ? $_POST['date'] : "";
    $edit_date          = date("Y-m-d",strtotime($date));
    $start_time         = !empty($_POST['start_time']) ? $_POST['start_time'] : "";
    $end_time           = !empty($_POST['end_time']) ? $_POST['end_time'] : "";
    

 
    /* Field Required */
    $aFieldRequired = [
     $event_name
        
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
        VALUES ('', '$company_id', '$event_name', '$description','$event_address1','$event_address2','$event_city','$event_eircode','$edit_date','$start_time', '$end_time')";

        $successDB = $db->query($sql);
    }
}
?>

<html>
     <head>
          <title>Test Page</title>
     </head>
     
<body>
             <form action="" method="post">
         
         <!--userid-->
     
                <input name='company_id' type='text' value='<?php echo $company_id ?>' hidden='true'> <!-- $company_id is defined in the header.php -->
            </div>
            
             
            <!--Name of Event-->
         
                <label for='event_name'>Name of Event</label>
                <input name='event_name' id='event_name' pattern='[a-zA-Z0-9\s]{1,20}' title='Letters and numbers only, max 20 characters.' type='text'  placeholder='' required><font color="red"><sup>*</sup></font>
            </div>
               <br>
            <!--Description-->
          
                <label for='description'>Description</label>
                <textarea name='description' id='description' pattern='[a-zA-Z0-9\s]{50,255}' onkeyup="countChar(this)" placeholder="Minimun of 50 characters" title='Letters and numbers only.' rows='5'  maxlength='255'required></textarea><font color="red"><sup>*</sup></font>
                Characters left: <qqq id="charNum">255</qqq>/255
            </div>
               <br>
            <!--Address-->
            
                <label for='event_address1' >Address Line 1</label>
                <input name='event_address1' id='event_address1' pattern='^[a-zA-Z0-9\s,]*$' title='Letters and numbers only.' placeholder='Where is the event being held?' type='text' required ><font color="red"><sup>*</sup></font>
            </div>
               <br>
            <!--Address2-->
                <label for='event_address2'>Address Line 2</label>
                <input name='event_address2' id='event_address2' pattern='^[a-zA-Z0-9\s,.]*$'  title='Letters and numbers only.' type='text'>
            </div>
               <br>
            <!--Row Start Selecter Country/City-->


                    <!--Selecter City-->
                          <br>
                        <label for='event_city'>City</label>
                        <input name='event_city' id='event_city' pattern='[a-zA-Z0-9\s]{1,100}' title='Letters and numbers only.' type='text' >

                    <!--Eircode-->
                                  <br>
                        <label for='event_eircode'>Eircode</label>
                        <input name='event_eircode' id='event_eircode' pattern='[a-zA-Z0-9\s]{7}' title='Letters and numbers only.' type='text' placeholder='' maxlength='7'>
     
                <!--Row Finish-->
               <br>
                                <label>Date</label>
                                    <input type='date' name='date' id='date' placeholder='YYYY-MM-DD' required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' title='Enter a date in this format YYYY-MM-DD'/><font color="red"><sup>*</sup></font>
                                    
                                </div>               <br>
                                
                                <label >Start Time</label>
                                    <input type='time' name='start_time' required pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/><font color="red"><sup>*</sup></font>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                   <br>
                                <label>End Time</label>
                                    <input type='time' name='end_time' pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>


                
                    <input type="submit" value="Submit">
                
        </form>
      <?php
                    if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("Required fields not completed");
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
     
     
     
     
</body>
</html>