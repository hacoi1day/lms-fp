<?php
    $server = 'mysql';
    $user = 'lms';
    $pass = '1234';
    $db = 'lms_db';
    $port = 3306;
    $conn = mysqli_connect($server, $user, $pass, $db, $port);
    
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>