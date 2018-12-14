<?php
if(isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['email']) && !empty($_GET['email']))
{
	$file = 'data.txt';
	// Open the file to get existing content
	$current = file_get_contents($file);
	// Append a new person to the file
	$current .= $_GET['name']."\t".$_GET['email']."\n";
	// Write the contents back to the file
	file_put_contents($file, $current);	
	echo '200';
}
exit;
?>