<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
$ClientId = $_SESSION['ClientId'];
$fetch_bank_accounts_query = "Select AccountNumber, Type, Currency, Balance from BankAccount where clientid = '$ClientId'";

$result = mysqli_query($db, $fetch_bank_accounts_query);

$data_bank_accounts = array();
$temp_data_transaction = array();
$data_transactions = array();


if ($result->num_rows > 0) {
while($row_bank_account = mysqli_fetch_assoc($result)){
    $data_bank_accounts[] = $row_bank_account;
    $account_number = $row_bank_account["AccountNumber"];
    $fetch_transactions_query = "Select AccountNumber, DateTime, Amount, Type from Transaction Where AccountNumber = '$account_number'";
    $result2 = mysqli_query($db, $fetch_transactions_query);
    if($result2->num_rows >0){
        while($row_transaction = mysqli_fetch_assoc($result2)){
            $temp_data_transaction[] = $row_transaction;
    }
    $data_transactions[] =  $temp_data_transaction;
    $temp_data_transaction = array();
    }
}
echo json_encode(array("Accounts"=>$data_bank_accounts, "Transactions"=>$data_transactions));
#echo json_encode($data_transactions);
}
else 
{
    echo 'Error Fetching Accounts';
}


?>