<?php  
	require_once('db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno) {
    	die ("Could not connect to the database: <br />"). $db->connect_errno;
    }

    $query = "SELECT * FROM kunjungan WHERE DATE(Masuk) = CURDATE()";
    $result = $db->query($query);
    $numRow = $result->num_rows;

    $query1 = "SELECT * FROM grupvisit WHERE DATE(Masuk) = CURDATE()";
    $result1 = $db->query($query1);
    $numRow1 = $result1->num_rows;

	$query2 = "SELECT * FROM kunjungan WHERE Status = 'Active'";
    $result2 = $db->query($query2);
    $numRow2 = $result2->num_rows;
    
    $query3 = "SELECT * FROM grupvisit WHERE Status = 'Active'";
    $result3 = $db->query($query3);
    $numRow3 = $result3->num_rows;

    $query4 = "SELECT * FROM kunjungan WHERE DATE(Keluar) = CURDATE()";
    $result4 = $db->query($query4);
    $numRow4 = $result4->num_rows;

    $query5 = "SELECT * FROM grupvisit WHERE DATE(Keluar) = CURDATE()";
    $result5 = $db->query($query5);
    $numRow5 = $result5->num_rows;

    $query6 = "SELECT * FROM kunjungan WHERE Status = 'Booking'";
    $result6 = $db->query($query6);
    $numRow6 = $result6->num_rows;
    
    $query7 = "SELECT * FROM grupvisit WHERE Status = 'Booking'";
    $result7 = $db->query($query7);
    $numRow7 = $result7->num_rows;

    $db->close();
?>
