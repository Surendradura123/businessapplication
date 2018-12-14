<?php

     $query = "SELECT event_id AS 'Event ID', event_name AS 'Event Name', description AS 'Description', event_address1 AS 'Location', event_address2 AS 'Event Address', event_city AS 'City', event_eircode AS 'Eircode', date AS 'Date', start_time AS 'Start', end_time AS 'End' FROM Event";
     $result = $db->query($query);;
     
     echo("<table>");
     $first_row = true;
     
     while ($row = $result->fetch_assoc()) {
         if ($first_row) {
             $first_row = false;
             // Output header row from keys.
             echo '<tr>';
             foreach($row as $key => $field) {
                 echo '<th>' . htmlspecialchars($key) . '</th>';
             }
             echo '</tr>';
         }
         echo '<tr>';
         foreach($row as $key => $field) {
             echo '<td>' . htmlspecialchars($field) . '</td>';
         }
         echo '</tr>';
     }
     echo("</table>");
     ?>