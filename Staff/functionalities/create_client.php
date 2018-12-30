<?php
    session_start();
    
    
    $fname = "";
    $lname = "";
    $bdate = "";
    $clientid = "";
    $nationalid = "";
    $client_email = "";
    $client_phone = "";
    
    
    
    
    //Initialize Variables//

    $errors = array();
    $db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

    // $action = isset($_POST['action'])? $_POST['action']: '';

    if(isset($_POST['create_client'])) {

        $fname = mysqli_real_escape_string($db, $_POST['client_fname']);
        $lname = mysqli_real_escape_string($db, $_POST['client_lname']);
        $bdate = mysqli_real_escape_string($db, $_POST['client_bdate']);
        $nationalid = mysqli_real_escape_string($db, $_POST['client_nationalid']);
        $client_phone = mysqli_real_escape_string($db, $_POST['client_phone']);
        $client_email = mysqli_real_escape_string($db, $_POST['client_email']);
        $clientid = mysqli_real_escape_string($db, $_POST['client_id']); 

        //Checking on Errors//

        if (empty($fname)) { array_push($errors, "First Name is required"); }
        if (empty($lname)) { array_push($errors, "Last Name is required"); }
        if (empty($bdate)) { array_push($errors, "Birthdate is required"); }
        if (empty($client_phone)) { array_push($errors, "Client Phone is required"); }
        if (empty($nationalid)) { array_push($errors, "National ID is required"); }
        if (empty($client_email)) { array_push($errors, "Client Email is required"); }
        if (empty($clientid)) { array_push($errors, "Client Id is required"); }
        
        
        
        $_SESSION['errors'] = $errors;
        
        
        
        
        if (count($errors) == 0) {
            
            
    

            $query = "INSERT INTO Client
            (fname, lname, Bdate, ClientId, NationalId) 
            VALUES('$fname', '$lname', '$bdate', '$clientid', '$nationalid' )";
            $result_client = mysqli_query($db, $query);
            
            $query = "INSERT INTO ClientEmail
            (ClientId, Email) 
            VALUES('$clientid', '$client_email' )";
            $result_email = mysqli_query($db, $query);
            $query = "INSERT INTO ClientPhone
            (ClientId, PhoneNumber) 
            VALUES( '$clientid', '$client_phone' )";
            $result_phone = mysqli_query($db, $query);
            if($result_client && $result_email && $result_phone){
                header('location: ../teller.php');
            }
            else
            {
                // echo "Could Not ";
                array_push($errors, "Not A Register Client");
            }
            }
            
        }
      
    $fname = "";
    $lname = "";
    $bdate = "";
    $clientid = "";
    $nationalid = "";
    $username = "";
    $clientid    = "";
    $accountnumber = "";
    $password = "";
    $confirm = "";
    

?>