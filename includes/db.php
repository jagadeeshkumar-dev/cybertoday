<<?php

    // Creating a database connection

    $conn = mysqli_connect("localhost", "root", "", "cybertoday");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    // Selecting a database

    $db_select = mysqli_select_db($conn, "cybertoday");
    if (!$db_select) {
        die("Database selection failed: " . mysqli_connect_error());
    }

?>
