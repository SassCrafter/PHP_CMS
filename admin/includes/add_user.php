

<div class="col-md-10 col-lg-6">
	<?php 
	if (isset($_POST['create_user'])) {
		create_user_in_admin();
		$message = "User's been successfully created. <a href='./view_all_users.php'>View all users</a>";
		show_alert($message);
	}
?>
	<form action="" method='post' enctype="multipart/form-data">
	<!-- Username -->
	<div class="form-group">
		<label for="username">Username</label>
		<input class='form-control' type="text" id='username' name='username' required >
	</div>

	<!-- Password -->
	<div class="form-group">
		<label for="password">Password</label>
		
		<input class='form-control' type="password" name='password' id="password" required>
	</div>


	<!-- Firstname -->
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input class='form-control' type="text" id='firstname' name='firstname' required >
	</div>

	<!-- Lastname -->
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input class='form-control' type="text" id='lastname' name='lastname' required >
	</div>

	<!-- Email -->
	<div class="form-group">
		<label for="email">Email</label>
		<input class='form-control' type="text" id='email' name='email' required >
	</div>

	<!-- Image -->
	<div class="form-group">
		<label for="user_image">User Image</label>
		<input  type="file" id='user_image' name='user_image' >
	</div>

	<!-- Role -->
	<div class="form-group">
	<label for="user_role">User Role</label>
	<select name="user_role" id="user_role" class='form-control'>
		<?php display_role_select() ?>
	</select>
	</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='create_user' value='Create' >
	</div>
</form>
</div>