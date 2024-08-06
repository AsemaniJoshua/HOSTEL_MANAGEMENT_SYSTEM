<?php

    include("connectdb.php");



    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["signUp"] )) {

        $Username = $_POST["Username"];
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
        // $ConfirmPassword = $_POST["ConfirmPassword"];
        // $AcceptTerms = $_POST["AcceptTerms"];

        // if(empty($FullName) || empty($Email) || empty($Password) || empty($ConfirmPassword) || empty($AcceptTerms)) {

        //     header("Location: WrongCredentialError.html");

        // }
        // elseif($Password !== $ConfirmPassword) {

        //     header("Location: MismatchInput.html");

        // }
        // else{

            try{

                $Username = filter_input(INPUT_POST,"Username", FILTER_SANITIZE_SPECIAL_CHARS);
                $Email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_EMAIL);

                $hash = password_hash($Password, PASSWORD_DEFAULT);
                $Email = filter_input(INPUT_POST,"Email",FILTER_VALIDATE_EMAIL);

                
                
            }
            catch(Exception $e){

                header("Location: WrongCredentialError.html");

            }

            
            try{

                $sql = "INSERT INTO logincredentials(Email,Username,Passwords) VALUES ('$Email','$Username','$hash')";


                mysqli_query($conn, $sql);
                header("Location: booking.html");
                session_start();
                setcookie("Message","Thank you for visiting this website", time() + 86400,"/");
                

            }
            catch(mysqli_sql_exception $e){

                header("Location: GeneralError.html");
                
                
            }

            mysqli_close($conn);
            

            

        

    }

?>