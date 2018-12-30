<?php

session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

$action = 'noob';
$action = isset($_POST['action'])? $_POST['action']: '';

$username = "";
$password = "";
$staffid = "";

echo 'boov';


if (isset($_POST['create_teller'])){
    
    $username = $_POST['teller_username'];
    $password = $_POST['teller_password'];
    $staffid = $_POST['staffid'];
    echo $staffid;
    $password = md5($password);

    $query = "Insert Into Staff (ChangePass,isAdmin,PasswordHash, StaffID, Username ) Values  (0,1,'$password' ,'$staffid', '$username')";

                                
    $result = mysqli_query($db, $query);
    if($result)
        echo "Succeeded";
        header('location: ../admin.php');
}
else{
    echo 'Error';
}
?>