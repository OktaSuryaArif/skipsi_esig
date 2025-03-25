
<?php
    $db_host = 'localhost'; // or your database host
    $db_user = 'root'; // your database username
    $db_pass = ''; // your database password
    $db_name = 'chat'; // your database name

    // Create connection
    $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
