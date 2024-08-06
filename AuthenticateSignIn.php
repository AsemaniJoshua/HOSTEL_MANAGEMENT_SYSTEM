<?php

    include("connectdb.php");

    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["LoginIn"] )) {

        $Email = $_POST["Email"];
        $Password = $_POST["Password"];

        if(empty($Email) || empty($Password)) {

            header("Location: WrongCredentialError.html");

        }
        else{

        try{

            $Email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_EMAIL);
            $Email = filter_input(INPUT_POST,"Email",FILTER_VALIDATE_EMAIL);

        

        }
        catch(Exception $e){

            header("Location: WrongCredentialError.html");

        }
        
        $sql = "SELECT * FROM logincredentials WHERE Email = '$Email'";

        try{
                
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) === 1){

                    $row = mysqli_fetch_assoc($result);

                    $hashed_password = $row["Passwords"];

                    if(password_verify($Password, $hashed_password)){

                        header("Location: booking.html");
                        session_start();
                        setcookie("Message","Thank you for visiting this website", time() + 86400,"/");


                    }
                    else{

                        header("Location: WrongCredentialError.html");

                    }

                    

                }
                elseif(mysqli_num_rows($result) == 0){

                    header("Location: WrongCredentialError.html"); 

                }
        }
        catch(Exception $e){

                header("Location: GeneralError.html");
        }

        mysqli_close($conn);
        }

    }

?>