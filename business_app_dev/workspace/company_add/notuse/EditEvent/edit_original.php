<?php

/*

Allows user to edit record and load in database
Not actual page.
Active by button [Edit] in showEvent.php

*/

// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function editForm($event_id ,$event_name ,$description, $event_address1 ,$event_address2 ,$event_city ,$event_eircode ,$date ,$start_time, $end_time)

{

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

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

<!--Edit Form-->

    <center>
     <div class='col-md-8 order-md-1'>
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
            
            <div class='form-group'>
              <input class='btn btn-primary btn-lg btn-block' type="submit" value="Submit">
            </div>
                <br>                
        </form>
                        </div>
                        </center>
                                                <br>
        </div>

</body>
</html>


<?php

}

// connect to the database

include('../connection.php');

// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit'])){
// get form data, making sure it is valid
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $description = $_POST['description'];
        $event_address1 = $_POST['event_address1'];
        $event_address2 = $_POST['event_address2'];
        $event_city = $_POST['event_city'];
        $event_eircode = $_POST['event_eircode'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

// save the data to the database

$sql = "UPDATE Event SET event_name='$event_name', description='$description' , event_address1='$event_address1', event_address2='$event_address2', event_city='$event_city', event_eircode='$event_eircode', date='$date', start_time='$start_time', end_time='$end_time'  WHERE event_id='$event_id'";
$result = $db->query($sql);

// once saved, redirect back to the view page
header("Location: company_add/showEvent.php");
}

// if the form hasn't been submitted, get the data from the db and display the form
else{

// get the 'event_id' value from the URL (if it exists), making sure that it is valid 
if (isset($_GET['event_id'])){

// query db
$id = $_GET['event_id'];
$sql = "SELECT * FROM Event WHERE event_id='$id'";
$result = $db->query($sql) or die(mysql_error());


// check that the 'id' matches up with a row in the databse

if($row=$result->fetch_assoc()){
// get data from db
$event_name = $row['event_name'];
$description= $row['description'];
$event_address1 = $row['event_address1'];
$event_address2 = $row['event_address2'];
$event_city = $row['event_city'];
$event_eircode = $row['event_eircode'];
$date = $row['date'];
$start_time = $row['start_time'];
$end_time = $row['end_time'];


// show form

editForm($event_id ,$event_name ,$description, $event_address1 ,$event_address2 ,$event_city ,$event_eircode ,$date ,$start_time, $end_time);

}

// if no match, display result
else{
echo "No results!";
}

}

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
else{
echo 'Error!';
}

}

?>