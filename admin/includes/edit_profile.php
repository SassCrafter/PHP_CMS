<?php
	extract($_SESSION['user']);
	edit_profile($db_user_id);
	if (isset($_POST['edit_profile'])) {
		update_user_session();
		header('Location: ./profile.php');
	}
?>

<div class="col-md-10 col-lg-6">
	<form action="" method='post' enctype="multipart/form-data">

	<!-- Username -->
	<div class="form-group">
		<label for="username">Username</label>
		<input class='form-control' type="text" id='username' name='username' value='<?php echo $db_username ?>' required >
	</div>

	<!-- Password -->
	<div class="form-group">
		<label for="password">Password</label>
		
		<input class='form-control' type="password" name='password' id="password" value='<?php echo $db_password ?>' required>
	</div>


	<!-- Firstname -->
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input class='form-control' type="text" id='firstname' name='firstname' value='<?php echo $db_firstname ?>' required >
	</div>

	<!-- Lastname -->
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input class='form-control' type="text" id='lastname' name='lastname' value='<?php echo $db_lastname ?>' required >
	</div>

	<!-- Email -->
	<div class="form-group">
		<label for="email">Email</label>
		<input class='form-control' type="text" id='email' name='email' required  value='<?php echo $db_email ?>'>
	</div>

	<!-- Image -->
	<!-- <div class="form-group">
		<label for="user_image">User Image</label>
		<input  type="file" id='user_image' name='user_image' >
	</div> -->

	

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='edit_profile' value='Edit' >
	</div>
</form>
</div>