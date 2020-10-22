<?php 
	require 'db_login.php';

    
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
    	echo '<tr>';
        print_r('<td>'.$row['Code'].'</td>');
    	print_r('<td>'.$row['id'].'</td>');
        print_r('<td>'.$row['status'].'</td>');
    	echo '</tr>';
    }

    $db->close();
 ?>
