<?php
    session_start();
    
    
    $fname = "";
    $lname = "";
    $bdate = "";
    $clientid = "";
    $nationalid = "";
    $accountnumber = "";
    $password = "";
    $confirm = "";
    $status = "Pending";
    
    
    
    //Initialize Variables//

    $errors = array();
    $db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

    // $action = isset($_POST['action'])? $_POST['action']: '';

    if(isset($_POST['create_account'])) {

        $fname = mysqli_real_escape_string($db, $_POST['fname']);
        $lname = mysqli_real_escape_string($db, $_POST['lname']);
        $bdate = mysqli_real_escape_string($db, $_POST['bdate']);
        $accountnumber = mysqli_real_escape_string($db, $_POST['accountnumber']);
        $nationalid = mysqli_real_escape_string($db, $_POST['nationalid']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $confirm = mysqli_real_escape_string($db, $_POST['confirm']); 

        //Checking on Errors//

        if (empty($fname)) { array_push($errors, "First Name is required"); }
        if (empty($lname)) { array_push($errors, "Last Name is required"); }
        if (empty($bdate)) { array_push($errors, "Birthdate is required"); }
        if (empty($accountnumber)) { array_push($errors, "Accout Number is required"); }
        if (empty($nationalid)) { array_push($errors, "National ID is required"); }
        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($password)) { array_push($errors, "Email is required"); }
        if ($password != $confirm){
                array_push($errors, "The two passwords do not match");
            }
        
        
        $_SESSION['errors'] = $errors;
        
        if (count($errors) == 0) {

            CheckUserExistance($db, $errors, $accountnumber, $username);
            $clientid = GetClientId($db, $erros, $nationalid);
        }
        
        
        if (count($errors) == 0) {
            
            
            $password = md5($password);

            $query = "INSERT INTO OnlineBankingApp
            (fname, lname, Bdate, SupposedClientId, NationalId, Username, PasswordHash, SupposedAccountNumber, Status) 
                    VALUES('$fname', '$lname', '$bdate', '$clientid', '$nationalid', '$username','$password', '$accountnumber', '$status' )";
            $result = mysqli_query($db, $query);
            if($result){
            header('location: ../teller.php');
            }
            else
            {
                // echo "Could Not ";
                array_push($errors, "Not A Register Client");
            }
            }
            
            exit();
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
    
    function GetClientId($db, &$errors, $nationalid){
        $clientid_query = "Select ClientId from Client where nationalid=$nationalid";
        $clientid = "";
        $result = mysqli_query($db, $clientid_query);
        if($result){
            $user = mysqli_fetch_assoc($result);
            if($result->num_rows > 0){ // If record > 0 -> TRUE
                var_dump($user);
                $clientid = $user["ClientId"];                
            }
            if(empty($clientid))
                array_push($errors, "This National ID Does not Exist on the System");
            else
                return $clientid;
        }
        else{
            array_push($errors, "This National ID Does not Exist on the System");
        }
        return "";
    }
    function CheckUserExistance($db, &$erros, $accountnumber, $username){
        $user_check_query = "SELECT * FROM OnlineBankingApp WHERE Username='$username' OR SupposedAccountNumber='$accountnumber' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user['Username'] === $username) {
                array_push($errors, "Username already exists");
                }
                if ($user['SupposedClientId'] === $accountnumber) {
                array_push($errors, "Account Number has submitted an Application");
                }
 
    }
}
?>