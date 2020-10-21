<?php 
	require_once('db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno) {
    	die ("Could not connect to the database: <br />"). $db->connect_errno;
    }
    
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
    	echo '<tr>';
    	echo '<td>'.$row['Code'].'</td>';
    	echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['status'].'</td>';
    	echo '</tr>';
    }

    $db->close();
 ?>