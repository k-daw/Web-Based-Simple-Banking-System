<?php
    session_start();
    $teller = "";

    $db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
    if(isset($_POST['confirm_deposit'])){
            
            $sender_account = mysqli_real_escape_string($db, $_POST['accountnumber']);
            
            $amount = mysqli_real_escape_string($db, $_POST['amount']);
            
            $get_client_id_query = "Select ClientId from BankAccount where AccountNumber='$sender_account'";
            $result = mysqli_query($db,$get_client_id_query);

            if($result){
                $obj = mysqli_fetch_assoc($result);
                $clientid = $obj["ClientId"];


                $teller = $_SESSION['teller'];

                $sender_query = "INSERT Into Transaction (AccountNumber, Amount, ClientID, Teller, Type) VALUES ('$sender_account','$amount', '$clientid','$teller', 'Deposit')";
                
                $result_st = mysqli_query($db, $sender_query);
                echo $clientid;
                if($result_st){
                    $sender_balance = $sender_balance + $amount;   
                    echo $amount;
                    $update_sender_balance_query = "Update BankAccount Set Balance = '$sender_balance' Where AccountNumber='$sender_account'";
                    $r1 = mysqli_query($db, $update_sender_balance_query);

                    if($r1)
                        header("location: ../teller.php");
                }

            }
        }
        if(isset($_POST['confirm_withdraw'])){
            
            $sender_account = mysqli_real_escape_string($db, $_POST['accountnumber']);
            
            $amount = mysqli_real_escape_string($db, $_POST['amount']);
            
            $get_client_id_query = "Select ClientId from BankAccount where AccountNumber='$sender_account'";
            $result = mysqli_query($db,$get_client_id_query);
            
            if($result){
                $obj = mysqli_fetch_assoc($result);
                $clientid = $obj["ClientId"];
            
                $teller = $_SESSION['teller'];

                $sender_query = "INSERT Into Transaction (AccountNumber, Amount, ClientID, Teller, Type) VALUES ('$sender_account','$amount', '$clientid','$teller', 'Withdraw')";
                
                $result_st = mysqli_query($db, $sender_query);
                
                if($result_st){
                    $sender_balance = $sender_balance - $amount;   
                    $update_sender_balance_query = "Update BankAccount Set Balance = '$sender_balance' Where AccountNumber='$sender_account'";
                    $r1 = mysqli_query($db, $update_sender_balance_query);
                    if($r1)
                        header("location: ../teller.php");
                }
            }
        }

    ?>