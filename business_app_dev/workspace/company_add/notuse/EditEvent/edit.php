<?php

// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id ,$uid ,$name ,$des, $address ,$address2 ,$country ,$city ,$eircode ,$startDate ,$endDate, $error)

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
</head>

<body>

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
       <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <!--Name of Event-->
            <div class="form-group">
                <label for="Name" class="control-label">Name of Event</label>
                <input name="name" value="<?php echo $name; ?>" pattern="[a-zA-Z0-9\s]{1,20}" title="Only letter and number and no more than 20 letters" type="text" class="form-control" id="Name" placeholder="" required/>
            </div>
            <!--Description-->
            <div class="form-group">
                <label for="des" class="control-label">Description</label>
                <textarea name="des" pattern="{1,20}" class="form-control" rows="5" id="des" maxlength="2000" placeholder="" required/>"<?php echo $des; ?>"</textarea>
            </div>

            <!--Address-->
            <div class="form-group">
                <label for="address" class="control-label">Address 1</label>
                <input name="address" value="<?php echo $address; ?>" pattern="^[a-zA-Z0-9\s,]*$" title="Only letter and number" type="text" placeholder="Apartment or suite, 1234 Main St" required class="form-control"/>
            </div>

            <!--Address2-->
            <div class="form-group">
                <label for="address2" class="control-label">Address 2</label>
                <input name="address2" value="<?php echo $address2; ?>" pattern="^[a-zA-Z0-9\s,.]*$"  title="Only letter and number" type="text" placeholder="County" required class="form-control"/>
            </div>

            <!--Row Start Selecter Country/City-->
            <div class="form-group">
                <div class="row">
                    <!--Selecter Country-->
                    <div class="col-md-5 mb-3">
                        <label for="country" class="control-label">Country</label>
                        <input name="country"  value="<?php echo $country; ?>" pattern="^[a-zA-Z\s,]*$" title="Only letter" type="text" placeholder="Ireland" required class="form-control"/>

                    </div>

                    <!--Selecter City-->
                    <div class="col-md-4 mb-3">
                        <label for="state" class="control-label">City</label>
                        <input name="city" value="<?php echo $city; ?>" pattern="^[a-zA-Z\s,]*$" title="Only letter" type="text" placeholder="Dublin" required class="form-control"/>
                    </div>

                    <!--Eircode-->
                    <div class="col-md-3 mb-3">
                        <label for="eircode" class="control-label">Eircode</label>
                        <input name="eircode" value="<?php echo $eircode; ?>" pattern="[a-zA-Z0-9\s]{7}" title="Only letter and number" type="text" placeholder="" required maxlength="20" class="form-control"/>
                    </div>
                    
                </div>
                <!--Row Finish-->
            
            
                <div class="webIndex">
                    <div class="stay-list clearFloat">
                        <div class="stay-list-left">
                            <form>
                                <div class="sea-div">
                                    <label class="search-lab">Start Date</label><input type="text" name="startDate" value="<?php echo $startDate; ?>"  readonly id="startDate" required/>
                                </div>
                                <div class="sea-div">
                                    <label class="search-lab">End Date</label><input type="text" readonly name="endDate" value="<?php echo $endDate; ?>"  id="endDate" required/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    

            <input type="submit" name="submit" value="Submit">
    </form>
</div>



</body>

</html>



<?php

}


// connect to the database

include ('connect.php');
include ('db.php');



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];
$name = $_POST['name'];
$des = $_POST['des'];
$address = $_POST['address'];
$address2 = $_POST['address2']; 
$country = $_POST['country'];
$city = $_POST['city'];
$eircode = $_POST['eircode'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];



// check that fields are all filled in

if ($name == '' || $des == ''|| $address == ''|| $address2 == ''|| $country == ''|| $city == ''|| $eircode == ''|| $startDate == ''|| $endDate == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $name, $des, $address, $address2, $country, $city, $eircode, $startDate, $endDate, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE Events SET name='$name', des='$des' , address='$address', address2='$address2', country='$country', city='$city', eircode='$eircode', startDate='$startDate', endDate='$endDate'  WHERE id='$id'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: showEvent.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];
$sql = "SELECT * FROM Events WHERE id=$id";
$result = $conn->query($sql) or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$name = $row['name'];
$des= $row['des'];
$address = $row['address'];
$address2 = $row['address2'];
$country = $row['country'];
$city = $row['city'];
$eircode = $row['eircode'];
$startDate = $row['startDate'];
$endDate = $row['endDate'];



// show form

renderForm($id, $name, $des, $address, $address2, $country, $city, $eircode, $startDate, $endDate , '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>