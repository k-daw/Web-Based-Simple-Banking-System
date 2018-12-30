<?php
    session_start();
    $username = "";
    $password = "";
    $email = "";
    $errors = array(); 
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    
    

    $db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
    //echo "DAWWW";   
    if(isset($_POST['password_recovery_submit'])){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        
        $query = "Select ClientId from ClientEmail where Email= '$email'";
        
        $result = mysqli_query($db, $query);
        
        if($result){
            $user = mysqli_fetch_assoc($result);
            if($result->num_rows > 0){ // If record > 0 -> TRUE
                //var_dump($user);

                $clientid = $user["ClientId"];    
                echo $clientid;          
            }
            if(empty($clientid))
                array_push($errors, "This Email Does not Exist on the System");
            else
                $NEW_PASSWORD = generateRandomString(10);
                //$MESSAGE = "YOUR NEW PASSWORD IS " . $NEW_PASSWORD ."\nNotice that you are required to change it.";
                //SendMail($email, $NEW_PASSWORD);
                $_SESSION['email']=$email;
                $_SESSION['random_password']= $NEW_PASSWORD;
                $password = md5($NEW_PASSWORD);
                $update_password_query = "Update OnlineBankingApp Set PasswordHash = '$password' where SupposedClientId = '$clientid'";
                $result = mysqli_query($db, $update_password_query);
                if($result){
                    $query_change_password_status = "Update OnlineBankingApp Set Status = 'ChangePass' where SupposedClientId = '$clientid'";
                    $result = mysqli_query($db, $query_change_password_status);
                    if($result)
                        header("location: ../../PHPMailer");
                }
                else
                    echo $result;
                    array_push($errors, "This Email Does not Exist on the System");
        }
        else{
            array_push($errors, "This Email Does not Exist on the System");
        }
        
    }


?>