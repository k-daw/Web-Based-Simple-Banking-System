<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');
$specific_client_id = 'noob';
$specific_client_id = isset($_POST['action'])? $_POST['action']: '';




if($specific_client_id == 'specific_client_id'){
    $specific_client_id = $_POST['specific_client_id'];

    $fetch_pending_applications_query = "Select * from OnlineBankingApp where SupposedClientId='$specific_client_id'";
    $result = mysqli_query($db, $fetch_pending_applications_query);


    $data_specific_app = array();

    if ($result->num_rows > 0) {
        
        while($row_app = mysqli_fetch_assoc($result)){
            $data_specific_app[] = $row_app;
        }
        $data_to_send= array("SpecificApplication"=>$data_specific_app);
        echo json_encode($data_to_send);
    }
    else 
    {
        echo 'Error Fetching Accounts';
    }

}

?>