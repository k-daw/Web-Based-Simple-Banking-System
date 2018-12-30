<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');


$specific_client_id_2 = isset($_POST['action_confirm'])? $_POST['action_confirm']: '';





if($specific_client_id_2 == 'specific_client_id_2' ){
    $specific_client_id_2 = $_POST['specific_client_id_2'];
    
    $confirm_application_query = "Update OnlineBankingApp Set Status = 'Approved' where SupposedClientId='$specific_client_id_2'";
    $result = mysqli_query($db, $confirm_application_query);
    if($result)
        echo "Succeeded";
}
else{
    if(!$specific_client_id_2)
        echo 'nob';
    echo 'Noob of Noobs';
}
?>