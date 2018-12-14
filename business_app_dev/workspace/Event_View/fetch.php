<?php
$connect = mysqli_connect("localhost", "root", "", "hybrid");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM Event 
	WHERE event_name LIKE '%".$search."%'
	OR event_city LIKE '%".$search."%'
	OR date LIKE '%".$search."%'#
	";
}
else
{
	$query = "
	SELECT * FROM Event ORDER BY event_id";
}
$result = mysqli_query($connect, $query);
 
if(mysqli_num_rows($result) > 0)
{
	          $event_id = $row['event_id'];

	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Event Name</th>
							<th>Event City</th>
							<th>Date</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		 $event_id = $row['event_id'];
		$output .= '
			<tr>
			    
				<td>'.$row["event_name"].'</td>
				<td>'.$row["event_city"].'</td>
				<td>'.$row["date"].'</td>
				<td><a href="../customersaveevent/home.php?event_id=$event_id"><button name = "eventadd" class="btn_primary">View in Detail</button></td>
			</tr>

		';

	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>