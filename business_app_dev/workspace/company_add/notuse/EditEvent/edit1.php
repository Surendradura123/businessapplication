<?php

    include '../connection.php';
    include '../extras.php';
    
    if (!($user_type_id == '2')){ //if user is not a Company account, send them to Home page
        header ('Location: /');
    }
    
// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($event_id ,$event_name ,$description, $event_address1 ,$event_address2 ,$event_city ,$event_eircode ,$date ,$start_time, $end_time, $error)

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

    <link rel="stylesheet" href="css/smoothness/jquery.ui.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css" />

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
</head>

<body onload="showDiv()">
     <?php echo $header_text;?>

  <!--    <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../company_add/index.html">Section Index</a>-->
    <!--navbar-->
  <!--  <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
  <!--      <a class="navbar-brand" href="#">Navbar</a>-->
  <!--      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
  <!--  <span class="navbar-toggler-icon"></span>-->
  <!--</button>-->

  <!--      <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
  <!--          <ul class="navbar-nav mr-auto">-->
  <!--              <li class="nav-item active">-->
  <!--                  <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                  <a class="nav-link" href="#">Link</a>-->
  <!--              </li>-->
  <!--              <li class="nav-item dropdown">-->
  <!--                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
  <!--        Dropdown-->
  <!--      </a>-->
  <!--                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
  <!--                      <a class="dropdown-item" href="#">Action</a>-->
  <!--                      <a class="dropdown-item" href="#">Another action</a>-->
  <!--                      <div class="dropdown-divider"></div>-->
  <!--                      <a class="dropdown-item" href="#">Something else here</a>-->
  <!--                  </div>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                  <a class="nav-link disabled" href="#">Disabled</a>-->
  <!--              </li>-->
  <!--          </ul>-->
  <!--          <form class="form-inline my-2 my-lg-0">-->
  <!--              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
  <!--              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
  <!--          </form>-->
  <!--      </div>-->
  <!--  </nav>-->
    <!--navbar end-->


    <!--header-->
  <!--  <nav aria-label="breadcrumb">-->
  <!--      <ol class="breadcrumb">-->
  <!--          <li class="breadcrumb-item"><a href="#">Home</a></li>-->
  <!--          <li class="breadcrumb-item"><a href="#">Library</a></li>-->
  <!--          <li class="breadcrumb-item active" aria-current="page">Data</li>-->
  <!--      </ol>-->
  <!--  </nav>-->

    <!--header end-->
<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>

<div class="col-md-8 order-md-1">
<h4 class="mb-3">Event Edit Page</h4>
   <form action="" method="post">
       <input type="hidden" name="event_id" value="<?php echo $event_id; ?>"/>
            <!--Name of Event-->
            <div class="form-group">
                <label for="Name" class="control-label">Name of Event</label>
                <input name="event_name" value="<?php echo $event_name; ?>" pattern="[a-zA-Z0-9\s]{1,20}" title="Only letter and number and no more than 20 letters" type="text" class="form-control" id="event_name" placeholder="" required/>
            </div>
            <!--Description-->
            <div class="form-group">
                <label for="description" class="control-label">Description</label>
                <textarea name="description" pattern="{1,20}" class="form-control" rows="5" id="description" maxlength="2000" placeholder="" required/><?php echo $description; ?></textarea>
            </div>

            <!--Address-->
            <div class="form-group">
                <label for="event_address1" class="control-label">Address 1</label>
                <input name="event_address1" value="<?php echo $event_address1; ?>" pattern="^[a-zA-Z0-9\s,]*$" title="Only letter and number" type="text" placeholder="Apartment or suite, 1234 Main St" required class="form-control"/>
            </div>

            <!--Address2-->
            <div class="form-group">
                <label for="event_address2" class="control-label">Address 2</label>
                <input name="event_address2" value="<?php echo $event_address2; ?>" pattern="^[a-zA-Z0-9\s,.]*$"  title="Only letter and number" type="text" placeholder="County" required class="form-control"/>
            </div>

            
            <!--Row Start City/Eircode-->
            <div class='form-group'>
                <div class='row'>

                    <!--</div>-->
                    
                    <!--Selecter City-->
                    <div class='col-md-4 mb-3'>
                        <label for='event_city' class='control-label'>City</label>
                        <input name='event_city' value="<?php echo $event_city; ?>" class='form-control' pattern='[a-zA-Z0-9\s]{1,100}' title='Letters and numbers only.' type='text' class='form-control'>

                    </div>

                    <!--Eircode-->
                    <div class='col-md-3 mb-3'>
                        <label for='event_eircode' class='control-label'>Eircode</label>
                        <input name='event_eircode' value="<?php echo $event_eircode; ?>" class='form-control' pattern='[a-zA-Z0-9\s]{7}' title='Letters and numbers only.' type='text' placeholder='' maxlength='7' class='form-control'>
                    </div>
                </div>
                <!--Row Finish-->
            </div>
            
            
            <!--Row Start Date/Time-->
            <div class='form-group'>
                <div class='row'>

                    <!--Choose Date-->
                    <div class='col-md-5 mb-3'>
                        <label class='search-lab'>Date</label>
                        <input type='date' name='date' value="<?php echo $date; ?>" placeholder='YYYY-MM-DD' required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' title='Enter a date in this format YYYY-MM-DD'/><font color="red"><sup>*</sup></font>

                    </div>

                    <!--Put Start Time-->
                    <div class='col-md-4 mb-3'>
                        <label class='search-lab'>Start Time</label>
                        <input type='time' name='start_time' required  value="<?php echo $start_time; ?>" pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/><font color="red"><sup>*</sup></font>
                    </div>
                    
                    <!--Put End Time-->
                    <div class='col-md-3 mb-3'>
                        <label class='search-lab'>End Time</label>
                        <input type='time' name='end_time' value="<?php echo $end_time; ?>" pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>
                    </div>
                    
                </div>
                <!--Row Finish-->
            </div>
            
            
            
                <!--<div class="webIndex">-->
                <!--    <div class="stay-list clearFloat">-->
                <!--        <div class="stay-list-left">-->
                <!--            <form>-->
                <!--                <div class="sea-div">-->
                <!--                    <label class="search-lab">Start Date</label>-->
                <!--                    <input type="text" name="startDate" value="<?php echo $startDate; ?>"  readonly id="startDate" required/>-->
                <!--                </div>-->
                <!--                <div class="sea-div">-->
                <!--                    <label class="search-lab">End Date</label>-->
                <!--                    <input type="text" readonly name="endDate" value="<?php echo $endDate; ?>"  id="endDate" required/>-->
                <!--                </div>-->
                <!--            </form>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
               
            <div class='form-group'>
              <input type="submit" value="Submit">
            </div>
    </form>
</div>
        <footer><p>&copy; 2018 HybridWebSearch.com</p></footer>
        <!--<footer class="my-5 pt-5 text-muted text-center text-small">-->
        <!--    <p class="mb-1">&copy; 2017-2018 Company Name</p>-->
        <!--    <ul class="list-inline">-->
        <!--        <li class="list-inline-item"><a href="#">Privacy</a></li>-->
        <!--        <li class="list-inline-item"><a href="#">Terms</a></li>-->
        <!--        <li class="list-inline-item"><a href="#">Support</a></li>-->
        <!--    </ul>-->
        <!--</footer>-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.ui.js"></script>
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/hotel/hotel.search.js"></script>
        <script type="text/javascript" src="js/datetime.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>

</body>
  
</html>



<?php

}


// connect to the database

include ('../connection.php');


// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'event_id' value is a valid integer before getting the form data
if (is_numeric($_POST['event_id']))

{

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



// check that fields are all filled in

if ($event_name == '' || $description == ''|| $event_address1 == ''|| $event_address2 == ''|| $event_city == ''|| $event_eircode == ''|| $date == ''|| $start_time == ''|| $end_time == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';


//error, display form

renderForm($event_id ,$event_name ,$description, $event_address1 ,$event_address2 ,$event_city ,$event_eircode ,$date ,$start_time, $end_time, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE Event SET event_name='$event_name', description='$description' , event_address1='$event_address1', event_address2='$event_address2', event_city='$event_city', event_eircode='$event_eircode', date='$date', start_time='$start_time', end_time='$end_time'  WHERE event_id='$event_id'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: company_add/showEvent.php");

}

}

else

{

// if the 'event_id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the connection and display the form

{



// get the 'event_id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['event_id']) && is_numeric($_GET['event_id']) && $_GET['event_id'] > 0)

{

// query connection

$id = $_GET['event_id'];
$sql = "SELECT * FROM Event WHERE event_id=$id";
$result = $db->query($sql) 
or die(mysql_error());


// check that the 'event_id' matches up with a row in the databse

if($row=$result->fetch_assoc())

{



// get data from connection

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

renderForm($event_id ,$event_name ,$description, $event_address1 ,$event_address2 ,$event_city ,$event_eircode ,$date ,$start_time, $end_time, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'event_id' in the URL isn't valid, or if there is no 'event_id' value, display an error

{

echo 'Error!';

}

}

?>