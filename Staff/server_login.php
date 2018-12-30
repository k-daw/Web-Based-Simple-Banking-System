<?php
    session_start();
    $staff_username = "";
    $staff_password = "";
    
    // Transactions Information
    $sender_account = "";
    $reciever_account = "";
    $amount = 0.0;
    $amount_out = 0.0;
    $amount_in = 0.0;
    $exchange_rate = 1.0;
    $teller = "";
    $errors = array();

    $db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

    if(isset($_POST['login'])){
        $staff_username = mysqli_real_escape_string($db, $_POST['staff_username']);
        $staff_password = mysqli_real_escape_string($db, $_POST['staff_password']);

        if (empty($staff_username)) { array_push($errors, "Username is required"); }
        if (empty($staff_password)) { array_push($errors, "Password is required"); }
        
        $staff_password = md5($staff_password);
        echo gettype($staff_password);
        if(count($errors) == 0){
            $query = "Select isAdmin, StaffID, NationalID, ChangePass from Staff where username = '$staff_username' and PasswordHash = '$staff_password'";
            $result = mysqli_query($db, $query);
         
            if($result->num_rows > 0){
                
                $obj = mysqli_fetch_object($result);
                if($obj->isAdmin == 1){
                    header('location: admin.php');
                    // $_SESSION['ClientId'] = $obj->SupposedClientId;
                    
                    // $client_information_query = "Select Fname, Lname from Client where ClientId = '$obj->SupposedClientId'";
                    // $client_email_query = "Select Email from ClientEmail where ClientId = '$obj->SupposedClientId'";
                    // $client_phone_query = "Select PhoneNumber from ClientPhone where ClientId = '$obj->SupposedClientId'";
                    // $result = mysqli_query($db, $client_information_query);
                    // $result_email = mysqli_query($db, $client_email_query);
                    // $result_phone = mysqli_query($db, $client_phone_query);
                    // if($result && $result_email && $result_phone){
                    //     $obj = mysqli_fetch_object($result);
                    //     $obj_email = mysqli_fetch_object($result_email);
                    //     $obj_phone = mysqli_fetch_object($result_phone);
                    //     $_SESSION['login_Fname_homepage'] = $obj->Fname;
                    //     $_SESSION['login_Lname_homepage'] = $obj->Lname;
                    //     $_SESSION['client_email'] = $obj_email->Email;
                    //     $_SESSION['client_phone'] = $obj_phone->PhoneNumber;
                    }
                else{
                    
                    $_SESSION['teller'] = $obj->StaffID;
                    $_SESSION['nationalid'] = $obj->NationalID;
                    if($obj->ChangePass)
                        header('location: change_password.php');
                    else
                        header('location: teller.php');
                }
            }
            else{
                array_push($errors, "Incorrect Username/Password Combination"); 
            }
        }
    }
    
    if(isset($_POST['forgot_password'])){
        header( 'location: forgot_password.php');
    }

    if(isset($_POST['register'])){
        header( 'location: register.php');
    }

    if(isset($_POST['update_contact_information'])){
        $update_place = mysqli_real_escape_string($db, $_POST['update_place']);
        $information_to_update = mysqli_real_escape_string($db, $_POST['information_to_update']);
        $clientid = $_SESSION['ClientId'];
        echo $update_place;
        if($update_place == "email"){
            $email_update_query = "UPDATE ClientEmail set Email = '$information_to_update' where ClientID = '$clientid'";
            $result = mysqli_query($db, $email_update_query);
            $_SESSION['client_email'] = $information_to_update;
            header('location: homepage/homepage.php');
        }
        if($update_place == "phone"){

            $phone_update_query = "Update ClientPhone Set PhoneNumber='$information_to_update' where ClientId = '$clientid'";
            $result = mysqli_query($db, $phone_update_query);
            $_SESSION['client_phone'] = $information_to_update;
            header('location: homepage/homepage.php');
        }
        
    }
    
    if(isset($_POST['confirm_transaction'])){
        
        $sender_account = mysqli_real_escape_string($db, $_POST['sender_account']);
        $receiver_account = mysqli_real_escape_string($db, $_POST['receiver_account']);
        $amount = mysqli_real_escape_string($db, $_POST['amount']);
        
        echo $receiver_account;
        
        $sender_currency_query= "SELECT Currency, Balance from BankAccount WHERE AccountNumber = '$sender_account'";
        $result_scq = mysqli_query($db, $sender_currency_query);

        $reciever_currency_query = "SELECT Currency, ClientID, Balance from BankAccount WHERE AccountNumber = '$receiver_account'";
        $result_rcq = mysqli_query($db, $reciever_currency_query);

        $clientid = $_SESSION['ClientId'];
        
        
        if($result_scq && $result_rcq){
            
            $obj_sender = mysqli_fetch_object($result_scq);
            $obj_receiver = mysqli_fetch_object($result_rcq);

            $sender_currency = $obj_sender->Currency;
            $sender_balance = $obj_sender->Balance;
            $receiver_currency = $obj_receiver->Currency;
            $receiver_clientid = $obj_receiver->ClientID;
            $receiver_balance = $obj_receiver->Balance;
            
            if( $sender_currency != $receiver_currency){
                
                $exchange_rate_query = "SELECT Rate FROM `ExchangeRate` WHERE currency1 = '$sender_currency' and currency2 = '$receiver_currency'";
                $result_erq = mysqli_query($db, $exchange_rate_query);

                $exchange_rate = mysqli_fetch_object($result_erq)->Rate;
            }

            $amount_out = -$amount;

            $sender_query = "INSERT Into Transaction (AccountNumber, Amount, ClientID, Type) VALUES ('$sender_account','$amount_out', '$clientid', 'Transfer')";
            $result_st = mysqli_query($db, $sender_query);

            $amount_in = $amount * $exchange_rate;
            sleep(1);

            $reciever_query = "INSERT Into Transaction (AccountNumber, Amount, ClientID, Type) VALUES ('$receiver_account','$amount_in' , '$receiver_clientid', 'Transfer')";
            $result_rt = mysqli_query($db, $reciever_query);
            

            if($result_st && $result_rt){
                $sender_balance = $sender_balance + $amount_out;
                $receiver_balance = $receiver_balance + $amount_in;
                
                $update_sender_balance_query = "Update BankAccount Set Balance = '$sender_balance' Where AccountNumber='$sender_account'";
                $update_receiver_balance_query = "Update BankAccount Set Balance = '$receiver_balance' Where AccountNumber='$receiver_account'";
                
                $r1 = mysqli_query($db, $update_sender_balance_query);
                $r2 = mysqli_query($db, $update_receiver_balance_query);
                
                if($r1 && $r2)
                    header('location: homepage/homepage.php');
            }
            else{
                echo 'UnSuccessful';
            }   
        }
    }
   
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
?>