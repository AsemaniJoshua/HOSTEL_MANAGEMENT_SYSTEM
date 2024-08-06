<?php

    $db_s = "localhost";
    $db_u = "root";
    $db_p = "root";
    $db_n = "hostel_management_system";
    $conn = "";

    try{
        $conn = mysqli_connect($db_s, $db_u, $db_p, $db_n);
        // echo"Connected!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
    }
    catch(mysqli_sql_exception){
        header("Location: GeneralError.html");
    }


?>