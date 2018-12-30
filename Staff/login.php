<?php include('server_login.php'); ?>
<!DOCTYPE html>
<!Template Adapted From: https://bootsnipp.com/snippets/featured/register-page>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="main.css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>LOGIN</title>
	</head>
	<body>
    <form method=post action="server_login.php">
  <div class="form-group">
    <?php include('errors.php'); ?>
    <label for="staff_username">Username</label>
    <input type="username" class="form-control" id="staff_username" name=staff_username value=<?php echo $staff_username?> placeholder="Enter Username">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="staff_password" name=staff_password value=<?php echo $staff_password?> placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" name=login id=login>Submit</button>
</form>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	</body>
</html>