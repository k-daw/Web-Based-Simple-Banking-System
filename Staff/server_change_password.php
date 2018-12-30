<?php
session_start();
$teller_id = "";

$change_password = "";
$confirm_change_password = "";
$errors = array();


$db = mysqli_connect('localhost', 'root', '', 'BANK_DATABASE');


if(isset($_POST['change_password_button'])){

        $change_password = mysqli_real_escape_string($db, $_POST['change_password']);
        $confirm_change_password = mysqli_real_escape_string($db, $_POST['confirm_change_password']);
        $teller_id= $_SESSION['teller'];
        

        if ($change_password != $confirm_change_password){
            array_push($errors, "The two passwords do not match");
        }

        if (count($errors) == 0) {
            $change_password = md5($change_password);
            $clientid = $_SESSION['ClientId'];
            $update_password_query = "Update Staff Set PasswordHash = '$change_password' where StaffId = '$teller_id'";
            $result_update_password = mysqli_query($db, $update_password_query);
            $update_status_query = "Update Staff Set ChangePass = 0 where StaffId = '$teller_id'";
            $result_update_status = mysqli_query($db, $update_status_query);
            if($result_update_password && $result_update_status){
                header("location: teller.php");

            }
            else
                array_push($errors, "System Error");
        }

    }

    ?>