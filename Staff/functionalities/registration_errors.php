
<?php  
$errors = $_SESSION['errors'];
if (count($errors) > 0) : ?>
<div class="alert alert-danger">
  <strong>Error!</strong> 
	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>