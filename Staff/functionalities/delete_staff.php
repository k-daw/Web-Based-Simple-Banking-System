<?php

session_start();

$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');



$username = "";





if (isset($_POST['delete'])){
    
    $username = $_POST['delete_username'];

    $password = md5($password);
 //DELETE FROM `Staff` WHERE `Staff`.`StaffID` = '12'
    $query = "DELETE FROM Staff WHERE username = '$username'";

                                
    $result = mysqli_query($db, $query);
    if($result)
        echo "Succeeded";
        header('location: ../admin.php');
}
else{
    echo 'Error';
}
?>