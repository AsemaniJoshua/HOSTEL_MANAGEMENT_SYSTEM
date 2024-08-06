<?php
    include("connectdb.php");

    session_start();

    

    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["Subscribe"] )) {

        $Email = $_POST["Email"];
        
    

        try{

            $Email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_EMAIL);
            $Email = filter_input(INPUT_POST,"Email", FILTER_VALIDATE_EMAIL);

        }

        catch(Exception $e){

            header("Location: WrongCredentialError.html");
        }

        try{

            $sql = "SELECT * FROM newsletter WHERE Email = '$Email'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){

                // echo "<script> alert('Please you have already subscribed to our NewsLetter') </script>";

                // header("Location: main.html");
                
                header("Location: NewsLetterAlertError.php");

            }
            else{

                try{
                    $sql = "INSERT INTO newsletter(Email) VALUES ('$Email')";


                    mysqli_query($conn, $sql);
                    header("Location: NewsLetterAlert.php");
                    // echo "<script> alert('Thank you for Subscribing to our NewsLetter') </script>";
                    

                }
                catch(Exception $e){

                    //  echo "<script> alert('OOPS!!!!! \n Something went wrong. \n Tips:\n Check your Internet Connection\n This can also be that, you have already subscribed to our NewsLetter.') </script>";

                    header("Location: NewsLetterAlertError.php");
                    
                }
            }


        }
        catch(Exception $e){

            header("Location: WrongCredentialError.html");
            
        }


        
    }
        


    
?>