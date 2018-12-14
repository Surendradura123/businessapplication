<?php
     $cookie_name = 'user'; 
     $cookie_value = 'admin@hybridweb.com'; 
     setcookie($cookie_name, $cookie_value, NULL, '/'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="0; url=../../account/admin/index.php" />


</head>

<body>
<!-- @ref https://forums.adobe.com/thread/480963 & edited by Feeney, K -->
<!-- This is used, in case the above refresh doesn't work. It will show after 5 seconds -->
<div id="redirect_link" style="visibility: hidden"><a href="../../account/admin/index.phpp">Click here if you're not redirected</a></div>  
<script type="text/javascript">  
function showIt() {  
  document.getElementById("redirect_link").style.visibility = "visible";  
}  
setTimeout("showIt()", 7000); // after 7 sec  
</script>  
</body>

</html>