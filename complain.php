<?php
    include("connectdb.php");

    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["SendMessage"] )) {

        $StudentID = $_POST["StudentID"];

        $Message = $_POST["Message"];

        try{

            $StudentID = filter_input(INPUT_POST,"StudentID", FILTER_SANITIZE_SPECIAL_CHARS);
            $Message = filter_input(INPUT_POST,"Message", FILTER_SANITIZE_SPECIAL_CHARS);

        }

        catch(Exception $e){

            header("Location: WrongCredentialError.html");
        }

        // try{

        //     $sql = "SELECT * FROM newsletter WHERE Email = '$Email'";

        //     $result = mysqli_query($conn, $sql);

        //     if(mysqli_num_rows($result) === 1){

        //         echo "<script> alert('Please you have already subscribed to our NewsLetter') </script>";

        //         header("Location: main.html");
                

        //     }
        //     else{

                try{
                    $sql = "INSERT INTO complain(Student_IndexNumber,Message) VALUES ('$StudentID','$Message')";


                    mysqli_query($conn, $sql); 
                    header("Location: alert.php");                    
                    
                    // echo "alert('Thank you for Submitting a complain')"; 

                }
                catch(Exception $e){

                    //  echo "<script> alert('OOPS!!!!! \n Something went wrong. \n Tips:\n Check your Internet Connection.') </script>";

                    header("Location: alertError.php");    
                    
                }
            // }


        // }
        // catch(Exception $e){

        //     header("Location: WrongCredentialError.html");
            
        // }


        
    }
        


    
?>