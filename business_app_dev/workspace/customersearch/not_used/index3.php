<?php
include "header.php";

// Create connection
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        //die('Could not connect: ' . mysql_error());
        header( 'Location: ../error.html' ) ;
    }
    
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $entered_title          = !empty($_POST ['entered_title']) ? $_POST['entered_title'] : "";
    }

    /* Field Required */
    $aFieldRequired = [
        $entered_title
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
        $query      = "SELECT * FROM Services WHERE title LIKE '%$entered_title%'";
        $result     = $db->query($query);
        $row        = $result->fetch_assoc(); 

        $sid            = $row['sid'];
        $title          = $row['title'];
        $description    = $row['description'];
        $date           = $row['date'];
        
    }
    $successDB = true;
?>
<html>
    <title>search 2</title>
    <link rel="stylesheet" href="../../css/style.css">
    
    
    
    
    <body>
          <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../customersearch/index.html">Section Index</a>
        <div>

    <table>
        <tr>
            <td colspan="2">
                <center>
                    <h2>Register</h2>
                    
                </center>
            </td>
            <td>
            </td>
        </tr>
        <br><br>
        <tr>
            <td>
            </td>
            <td>
                <center>
                
                
                
                
                    
                <h2>Login to your account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                    <div class="search-wrapper hidden-print">
                <form autocomplete="off" role="search" action="" method="get">
                    <label class="hidden" for="mainSearch">How can we help you?</label>
                    <input name="q" title="Search" id="mainSearch" type="search" placeholder="How can we help you?" required><font color="red"><sup>*</sup></font>
                    <select name="service" id="service">
                        <option value="https://www.hse.ie/eng/search?q="<?php if ($row[month] == 'HSE') echo ' selected="selected"'; ?>>HSE</option>
                        <option value="https://data.gov.ie/dataset/list-of-hospitals-in-irelands"<?php if ($row[month] == 'Hospitals') echo ' selected="selected"'; ?>>Hospitals</option>
                    </select>
                    <input type="submit" value="Submit">
                    
                    
                    
                    
                    <!--<div class="dropdown">-->
    <!--<button class="dropbtn">Account-->

    <!--</button>-->
    <!--<div class="dropdown-content">-->
    <!--  <a href="https://www.hse.ie/eng/search?q=health%20services">HSE Ireland</a>-->
    <!--  <a href="https://data.gov.ie/dataset/list-of-hospitals-in-ireland">Hospitals</a>-->
    <!--  <a href="account/edit.php">Edit details</a>-->
    <!--</div>-->
  <!--</div> -->
   
    
    
<!--    <script>-->
<!--     (function() {-->
<!--    var cx = '004047810572905618870:q8cmb9wyfha';-->
<!--    var gcse = document.createElement('script');-->
<!--    gcse.type = 'text/javascript';-->
<!--    gcse.async = true;-->
<!--    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;-->
<!--    var s = document.getElementsByTagName('script')[0];-->
<!--    s.parentNode.insertBefore(gcse, s);-->
<!--  })();-->
<!--</script>-->
<!--<gcse:search></gcse:search>-->
    
<!--                </form>-->
<!--            </div>-->
            
 
               
                 
<!--                    <?php-->
                    
// <!--                    if(!isset($bFieldRequired)){-->
// <!--                        echo ("");-->
// <!--                    }-->
// <!--                    else if(isset($bFieldRequired) && $bFieldRequired){-->
// <!--                        echo ("<font color='red'>Required fields not completed</font>");-->
// <!--                    }-->
// <!--                    else if (isset($successDB) && !$successDB){-->
// <!--                        echo ("<font color='red'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");-->
//                         //header( 'Location: ../../error.html' ) ;
// <!--                    }-->
// <!--                    else if (isset($successDB) && $successDB){-->
// <!--                        echo ("<font color='#3eb740'>Here are your results:</font>");-->
// <!--                    }-->
<!--                    ?>-->
<!--                    <br><br>-->
<!--                    <table>-->
<!--                    <tr>-->
<!--                        <td colspan="2">-->
<!--                            <h4><b><u>Your Results:</b></u></h4>-->
<!--                        </td>-->

<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>-->
<!--                            <h4>sid::</h4>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <?php echo ($sid)?>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                     <tr>-->
<!--                        <td>-->
<!--                            <h4>Title:</h4>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <?php echo ($title)?>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>-->
<!--                            <h4>Description:</h4>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                           <?php echo ($description)?>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>-->
<!--                            <h4>Date:</h4>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                           <?php echo ($date)?>-->
<!--                        </td>-->
<!--                    </tr>-->
                    


<!--                </table>-->
<!--                </center>-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
</div>
        
        
        
    </body>
</html>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
