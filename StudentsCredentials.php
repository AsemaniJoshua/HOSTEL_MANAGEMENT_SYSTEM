<?php
    include("connectdb.php");

    session_start();

    

    if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["next"] )) {

        $StudentID = $_POST["StudentID"];
        $FirstName = $_POST["FirstName"];
        $MiddleName = $_POST["MiddleName"];
        $LastName = $_POST["LastName"];
        $Gender = $_POST["Gender"];
        $DOB = $_POST["DOB"];
        $Course = $_POST["Course"];
        $HouseAddress = $_POST["HouseAddress"];
        $PhoneNumber = $_POST["PhoneNumber"];
        $Email = $_POST["Email"];

        try{

            $StudentID = filter_input(INPUT_POST,"StudentID", FILTER_SANITIZE_SPECIAL_CHARS);
            $FirstName = filter_input(INPUT_POST,"FirstName", FILTER_SANITIZE_SPECIAL_CHARS);
            $MiddleName = filter_input(INPUT_POST,"MiddleName", FILTER_SANITIZE_SPECIAL_CHARS);
            $LastName = filter_input(INPUT_POST,"LastName", FILTER_SANITIZE_SPECIAL_CHARS);
            $Gender = filter_input(INPUT_POST,"Gender", FILTER_SANITIZE_SPECIAL_CHARS);
            $DOB = filter_input(INPUT_POST,"DOB", FILTER_SANITIZE_SPECIAL_CHARS);
            $Course = filter_input(INPUT_POST,"Course", FILTER_SANITIZE_EMAIL);
            $HouseAddress = filter_input(INPUT_POST,"HouseAddress",FILTER_VALIDATE_EMAIL);    
            $PhoneNumber = filter_input(INPUT_POST,"PhoneNumber",FILTER_VALIDATE_EMAIL);  
            
            $Email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_EMAIL);
            $Email = filter_input(INPUT_POST,"Email",FILTER_VALIDATE_EMAIL);

        }

        catch(Exception $e){

            header("Location: WrongCredentialError.html");
        }

        try{

            $sql = "SELECT * FROM Student WHERE Student_IndexNumber = '$StudentID'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){

                echo "<script> alert('You tried to book a Room but you did not finish the process. Continue the  Process') </script>";

                header("Location: bookingMain.html");
                session_start();

            }
            else{

                try{
                    $sql = "INSERT INTO Student(Student_IndexNumber,Student_FirstName,Student_MiddleName,	Student_LastName,Student_Gender,Student_DOB,Student_Course,Student_House_Address,	Student_Phone_Number,Student_Email_Address) VALUES ('$StudentID','$FirstName','$MiddleName','$LastName','$Gender','$DOB','$Course','$HouseAddress','$PhoneNumber','$Email')";


                    mysqli_query($conn, $sql);
                    header("Location: bookingMain.html");
                    session_start();

                }
                catch(Exception $e){
                    header("Location: GeneralError.html");
                }
            }


        }
        catch(Exception $e){

            header("Location: WrongCredentialError.html");

        }


        
    }
        


    
?>