<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

$fetch_transactions_query = "Select * from Transaction";

$result = mysqli_query($db, $fetch_transactions_query);

$data_transactions = array();


if ($result->num_rows > 0) {
    
    while($row_transaction = mysqli_fetch_assoc($result)){
        $data_transactions[] = $row_transaction;
    }
    echo json_encode(array("Transactions"=>$data_transactions));
}
else 
{
    echo 'Error Fetching Accounts';
}


?>