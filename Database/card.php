<?php 
	include 'db_login.php';

    
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
    	echo '<tr>';
        print_r('<td>'.$row['Code'].'</td>');
    	echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['status'].'</td>';
    	echo '</tr>';
    }

    $db->close();
 ?>
