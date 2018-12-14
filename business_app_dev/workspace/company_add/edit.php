<!--ref:https://www.killersites.com/community/index.php?/topic/1969-basic-php-system-vieweditdeleteadd-records/-->
<!--ref:editCompany from folder company-->


<?php

include "../connection.php";
include "../extras.php";

/*

Allows user to edit and see previous record and load in database
Not actual page.
Active by button [View/Edit] in showEvent.php

*/

// Only Company can view this page
if (!($user_type_id == '2')){
    header ('Location: /');
}

if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];

    // Get exist data from database and show in the filed when re-edit the record
    $query  = "SELECT * FROM Event WHERE event_id = '$event_id'";
        $result = $db->query($query);
        
        if ($result->num_rows > 0){
           
            $row             = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
           
            $event_name     = $row['event_name'];
            $description    = $row['description'];
            $event_address1 = $row['event_address1'];
            $event_address2 = $row['event_address2'];
            $event_city     = $row['event_city'];
            $event_eircode  = $row['event_eircode'];
            $date           = $row['date'];
            $start_time     = $row['start_time'];
            $end_time       = $row['end_time'];
        
        }
    
    // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland --> 
    
    if(count($_POST)>0){//Check if there are variables passed in $ _POST
    
        $event_name_new     = !empty($_POST['event_name']) ? $_POST['event_name'] : ""; /* not null */
        $description_new    = !empty($_POST['description']) ? $_POST['description'] : ""; /* not null */
        $event_address1_new = !empty($_POST['event_address1']) ? $_POST['event_address1'] : ""; 
        $event_address2_new = !empty($_POST['event_address2']) ? $_POST['event_address2'] : "";
        $event_city_new     = !empty($_POST['event_city']) ? $_POST['event_city'] : "";
        $event_eircode_new  = !empty($_POST['event_eircode']) ? $_POST['event_eircode'] : "";
        $date_new           = !empty($_POST['date']) ? $_POST['date'] : "";
        $start_time_new     = !empty($_POST['start_time']) ? $_POST['start_time'] : "";
        $end_time_new       = !empty($_POST['end_time']) ? $_POST['end_time'] : "";
    
    
        // The requied field need to be filled in otherwise is not process
        /* Field Required */
        $aFieldRequired = [
             $event_name_new,
             $description_new,
             $event_address1_new,
             $date_new,
             $start_time_new,
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
            $sql = "UPDATE Event
                SET
                    event_name      = '$event_name_new', 
                    description     = '$description_new', 
                    event_address1  = '$event_address1_new',
                    event_address2  = '$event_address2_new',
                    event_city      = '$event_city_new',
                    event_eircode   = '$event_eircode_new',
                    date            = '$date_new',
                    start_time      = '$start_time_new',
                    end_time        = '$end_time_new'
                WHERE
                    event_id        = '$event_id'";
    
            $successDB = $db->query($sql);
            
            // redirect to the showEvent.php and the record has been changed
            header("Location: showEvent.php");
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>

    <!--<link rel="stylesheet" href="css/smoothness/jquery.ui.css" type="text/css" />-->
    <!--<link rel="stylesheet" type="text/css" href="css/css.css" />-->

    <title>HybirdWeb</title>
    
    <style>     
           footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: #ca97e5;
                color: #7d24ad;
                text-align: center;
           }
     </style>
        
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

<?php echo $header_text;?>

<!--Form start-->
    <center>
     <br>
     <br>
     <div class='col-md-8 order-md-1' style='border-radius: 15px; background-color:#dab59b;'>
     <br>
     <h4 class="mb-3">Event Edit Page</h4>
          <form action="" method="post">
          <input type="hidden" name="event_id" value="<?php echo $event_id; ?>"/>
            
            <!--Name of Event-->
            <div class='form-group'>
                <b><label for='event_name' class='control-label'>Name of Event</label><font color="red"><sup>*</sup></font></b>
                <input name='event_name' value="<?php echo $event_name; ?>" id='event_name' class='form-control' pattern='[a-zA-Z0-9\s]{1,20}' title='Letters and numbers only, max 20 characters.' type='text' class='form-control' placeholder='' required>
            </div>

            <!--Description-->
            <div class='form-group'>
                <b><label for='description' class='control-label'>Description</label><font color="red"><sup>*</sup></font></b>
                <textarea name='description' id='description' class='form-control' pattern='[a-zA-Z0-9\s]{50,255}' onkeyup="countChar(this)" placeholder="Minimun of 50 characters" title='Letters and numbers only.' class='form-control' rows='5'  maxlength='255'required><?php echo $description; ?></textarea>
                Characters left: <qqq id="charNum">255</qqq>/255
            </div>

            <!--Address-->
            <div class='form-group'>
                <b><label for='event_address1' class='control-label'>Address Line 1</label><font color="red"><sup>*</sup></font></b>
                <input name='event_address1' value="<?php echo $event_address1; ?>" id='event_address1' class='form-control' pattern='^[a-zA-Z0-9\s,]*$' title='Letters and numbers only.' placeholder='Where is the event being held?' type='text' required class='form-control'>
            </div>

            <!--Address2-->
            <div class='form-group'>
                <b><label for='event_address2' class='control-label'>Address Line 2</label></b>
                <input name='event_address2' value="<?php echo $event_address2; ?>" id='event_address2' class='form-control' pattern='^[a-zA-Z0-9\s,.]*$'  title='Letters and numbers only.' type='text' class='form-control'>
            </div>

            <!--Row Start City/Eircode-->
            <div class='form-group'>
                <div class='row'>

                    <!--Selecter City-->
                    <div class='col-md-4 mb-3'>
                        <b><label for='event_city' class='control-label'>City</label></b>
                        <input name='event_city' value="<?php echo $event_city; ?>" id='event_city' class='form-control' pattern='[a-zA-Z0-9\s]{1,100}' title='Letters and numbers only.' type='text' class='form-control'>

                    </div>

                    <!--Eircode-->
                    <div class='col-md-3 mb-3'>
                        <b><label for='event_eircode' class='control-label'>Eircode</label></b>
                        <input name='event_eircode' value="<?php echo $event_eircode; ?>" id='event_eircode' class='form-control' pattern='[a-zA-Z0-9\s]{7}' title='Letters and numbers only.' type='text' placeholder='' maxlength='7' class='form-control'>
                    </div>
                </div>
                <!--Row Finish-->
            </div>
            
            <!--Row Start Date/Time-->
            <div class='form-group'>
                <div class='row'>

                    <!--Choose Date-->
                    <div class='col-md-5 mb-3'>
                        <b><label class='search-lab'>Date</label><font color="red"><sup>*</sup></font></b>
                        <input type='date' name='date' value="<?php echo $date; ?>" id='date' class='form-control' placeholder='YYYY-MM-DD' required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' title='Enter a date in this format YYYY-MM-DD'/>

                    </div>

                    <!--Put Start Time-->
                    <div class='col-md-4 mb-3'>
                        <b><label class='search-lab'>Start Time</label><font color="red"><sup>*</sup></font></b>
                        <input type='time' name='start_time' value="<?php echo $start_time; ?>" required class='form-control' pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>
                    </div>
                    
                    <!--Put End Time-->
                    <div class='col-md-3 mb-3'>
                        <b><label class='search-lab'>End Time</label></b>
                        <input type='time' name='end_time' value="<?php echo $end_time; ?>" class='form-control' pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>
                    </div>
                    
                </div>
                <!--Row Finish-->
            </div>
            
            <div class='col-md-8 order-md-1'>
              <p><b><font color="red"><sup>*</sup></font> means required field</p>
            </div>
            
            <br>
        </div>    
            <br>            
            <div class='col-md-8 order-md-1'>
            <div class='form-group'>
              <input class='btn btn-primary btn-lg btn-block' type="submit" value="Submit">
            </div>
                <br>
                              <?php  // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland
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
                                    echo ("");
                                }
                            ?>
        </form>
                        </div>
                        </center>
                                                <br>
        </div>
<br><br><br>
</body>
<?php echo $footer_msg;?>
</html>


