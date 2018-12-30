<?php

session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');



$username = "";
$isAdmin = 0;



if (isset($_POST['change_password'])){
    
    $username = $_POST['change_pass_username'];
    $password = $_POST['new_password'];

    $password = md5($password);
 
    $query = "Update Staff Set PasswordHash='$password' WHERE username = '$username'";
    $result = mysqli_query($db, $query);
    if($result)
        
        $check_admin= "Select isAdmin from Staff where username='$username'";
        $result = mysqli_query($db, $check_admin);
        $obj = mysqli_fetch_assoc($result);
        $isAdmin = $obj["isAdmin"];
        if (!$isAdmin){
            echo "Succeeded";
            $query = "Update Staff Set ChangePass=1 WHERE username = '$username'";
            $result = mysqli_query($db, $query);
            header('location: ../admin.php');
        }
}
else{
    echo 'Error';
}
?>