<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
$specific_account_number = 'noob';
$specific_account_number = isset($_POST['action'])? $_POST['action']: '';




if($specific_account_number == 'specific_account_number'){
    $specific_account_number = $_POST['specific_account_number'];

    $fetch_accounts_query = "Select * from BankAccount where AccountNumber='$specific_account_number'";
    $result = mysqli_query($db, $fetch_accounts_query);


    $data_specific_app = array();

    if ($result->num_rows > 0) {
        
        while($row_app = mysqli_fetch_assoc($result)){
            $data_specific_app[] = $row_app;
        }
        $data_to_send= array("Accounts"=>$data_specific_app);
        echo json_encode($data_to_send);
    }
    else 
    {
        echo 'Error Fetching Accounts';
    }

}

?>