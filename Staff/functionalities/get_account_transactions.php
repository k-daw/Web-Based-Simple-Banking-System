<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
$specific_account_number= 'noob';
$specific_account_number = isset($_POST['action'])? $_POST['action']: '';




if($specific_account_number == 'specific_client_id'){
    $specific_account_number = $_POST['specific_client_id'];

    $fetch_transactions_query = "Select * from Transaction where AccountNumber='$specific_account_number'";
    $result = mysqli_query($db, $fetch_transactions_query);

    $data_specific_app = array();

    if ($result->num_rows > 0) {
        
        while($row_app = mysqli_fetch_assoc($result)){
            $data_specific_app[] = $row_app;
        }
        $data_to_send= array("Transactions"=>$data_specific_app);
        echo json_encode($data_to_send);
    }
    else 
    {
        echo 'Error Fetching Accounts';
    }

}

?>