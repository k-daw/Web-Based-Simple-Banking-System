<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

$fetch_pending_applications_query = "Select * from OnlineBankingApp where Status='Pending'";
$result = mysqli_query($db, $fetch_pending_applications_query);


$data_onlineapp = array();
$data_client = array();
if ($result->num_rows > 0) {
    
    while($row_app = mysqli_fetch_assoc($result)){
        $data_onlineapp[] = $row_app;
        
        $SupposedClientid = $row_app["SupposedClientId"];
        
        $fetch_client_info_query= "Select * from Client where CLIENTID = '$SupposedClientid'";
        $result_client = mysqli_query($db, $fetch_client_info_query);
        if($result_client->num_rows>0){
            $data_client[] = mysqli_fetch_assoc($result_client);
        }
    }
    $data_to_send=array("OnlineBankingApp"=>$data_onlineapp, "Client"=>$data_client);
    echo json_encode($data_to_send);
}
else 
{
    echo 'Error Fetching Accounts';
}


?>