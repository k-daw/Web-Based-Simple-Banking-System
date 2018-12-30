<?php include('server_forgot_password.php'); ?>
<!DOCTYPE HTML>

<html lang="en">
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
        function enableButton2() {
            document.getElementById("password_recovery_submit").disabled = false;
        }
        </script>

        <title>Forgot Password</title>
    </head>
    <body>
    <div class="jumbotron vertical-center">
    <form style= "margin: 0 auto;width:80%" action="server_forgot_password.php"  method="post">
        <!-- <?php include('registration_errors.php'); ?> -->
    <div style = "margin: 0 auto;width:80%" class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control form-control-lg" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $email; ?>" >
        
    </div>
    <div style = "margin: 0 auto;width:80%">
        <button type="submit"  id="password_recovery_submit" class="btn btn-primary" name=password_recovery_submit >Submit</button>
    </div>
    
</form>
    <div>
    </body>
    <button type="submit"href="login.php">daw </button>
</html>
