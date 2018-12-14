<?php
include 'extras.php';
?>

<head>
    <title>Hybrid - 404! Page not found!</title>
    <base href="/"> <!-- This is used with .htaccess. It ensures that /error.php is located, instead of e.g. ../account/error.php, etc.  The error.php page will always direct to site.com/error.php-->
    
    <script src= js/javascript.js></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php echo $header_text;?> <!-- taken from extras.php -->
<!-- Header END -->

<center>
<div class="bodyContainer">
    <h1 style="background-color: #e85e43;"><b>404 - Error!</b></h1>
    <br>
    <h2>Sorry!</h2><br>
    <p><font size='4'>The page you are looking for is not here. It may have been moved or never existed. Our apologies.</font></p>
    <br>
    <img src="img/error.jpg" width="800px">
    <br><br>
    <a href="mailto:info@hybridsearch.com" class="button">Email us</a>&nbsp;-&nbsp;<a href="/" class="button">Home</a>
    <br><br><br>
</center>
   
   <!-- The below showed each of the Team mewmbers. Tthe user was to select which member was to be "punished" for the error that was occured. The button under each photo was a link to a fictional email address. -->
    <!--<table>-->
    <!--    <tr>-->
    <!--        <th>-->
    <!--          <img src="/img/devs/chenleijie.jpg" height="200px" width="200px" alt="Chenlei" title="Chenlei">  -->
    <!--        </th>-->
    <!--        <th>-->
    <!--            <img src="/img/devs/chamanali.jpg" height="200px" width="200px" alt="Ali" title="Ali">-->
    <!--        </th>-->
    <!--        <th> -->
    <!--            <img src="/img/devs/surendradura.jpg" height="200px" width="200px" alt="Surendra" title="Surendra">-->
    <!--        </th>-->
    <!--        <th>-->
    <!--            <img src="/img/devs/keithfeeney.jpg" height="200px" width="200px" alt="Keith" title="Keith">-->
    <!--        </th>-->
    <!--    </tr>-->
    <!--    <tr>-->
    <!--        <td>-->
    <!--            <center><a href="mailto:info@hybridsearch.com" class="button">Chenlei</a></center>-->
    <!--        </td>-->
    <!--        <td>-->
    <!--            <center><a href="mailto:info@hybridsearch.com" class="button">Ali</a></center>-->
    <!--        </td>-->
    <!--        <td>-->
    <!--            <center><a href="mailto:info@hybridsearch.com" class="button">Surendra</a></center>-->
    <!--        </td>-->
    <!--        <td>-->
    <!--            <center><a href="mailto:info@hybridsearch.com" class="button">Keith</a></center>-->
    <!--        </td>-->
    <!--    </tr>-->
    <!--    <tr>-->
    <!--        <td colspan="4">-->
    <!--            <br>-->
    <!--        </td>-->
    <!--    </tr>-->
    <!--    <tr>-->
    <!--        <td colspan="4"><center>-->
    <!--            <a href="/" class="button">Home</a></center>-->
    <!--        </td>-->
            
    <!--    </tr>-->
        
    <!--</table>-->
</div>
</body>
<?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>