<?php
    include("connectdb.php");

    session_start();

    

    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["Book"] )) {

        $StudentID = $_POST["StudentID"];
        
        $RoomType = $_POST["RoomType"];

        try{

            $StudentID = filter_input(INPUT_POST,"StudentID", FILTER_SANITIZE_SPECIAL_CHARS);
            

        }

        catch(Exception $e){

            header("Location: WrongCredentialError.html");
        }

        try{

            $sql = "SELECT * FROM booking WHERE Student_IndexNumber = '$StudentID'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){

                // echo "<script> alert('This Student Index Number have already booked a room') </script>";

                // header("Location: bookingMain.html");

                header("Location: alertBookingIfBooked.php");
                

            }
            else{

                try{
                    $sql = "INSERT INTO booking(Student_IndexNumber,Room_Type) VALUES ('$StudentID','$RoomType')";


                    mysqli_query($conn, $sql);
                    header("Location: alertBooking.php");
                    // echo "<script> alert('Thank you for Booking a room.\n You Recieve an email which will provide you with the amount you have to pay and also some extra content. \n You can also use the logout link at the navigation bar \n Thank you.') </script>";
                    

                }
                catch(Exception $e){

                    //  echo "<script> alert('OOPS!!!!! \n Something went wrong. \n Tips:\n Check your Internet Connection \n The index number Must be the same as that of what you used when fill your forms.') </script>";

                    header("Location: alertBookingError.php");
                    
                }
            }


        }
        catch(Exception $e){

            header("Location: WrongCredentialError.html");
            
        }


        
    }
        


    
?>