<?php

session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');

$action = 'noob';
$action = isset($_POST['action'])? $_POST['action']: '';

$username = "";
$password = "";
$staffid = "";

echo 'boov';


if (isset($_POST['create_admin'])){
    
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];
    $staffid = $_POST['admin_staffid'];
    echo $staffid;
    $password = md5($password);

    $query = "Insert Into Staff (ChangePass,isAdmin,PasswordHash, StaffID, Username ) Values  (1,1,'$password' ,'$staffid', '$username')";

                                
    $result = mysqli_query($db, $query);
    if($result)
        echo "Succeeded";
        header('location: ../admin.php');
}
else{
    echo 'Error';
}
?>