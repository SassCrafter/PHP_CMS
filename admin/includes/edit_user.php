<?php
	if (isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
		$user = mysqli_fetch_assoc(select_user_by_id($user_id));
		$username = $user['username'];
		$password = $user['password'];
		$firstname = $user['firstname'];
		$lastname = $user['lastname'];
		$email = $user['email'];
		$user_role = $user['user_role'];
		$username = $user['username'];
		$username = $user['username'];

		edit_user($user_id);
	}
?>

<div class="col-md-10 col-lg-6">
	<form action="" method='post' enctype="multipart/form-data">
	<!-- Username -->
	<div class="form-group">
		<label for="username">Username</label>
		<input class='form-control' type="text" id='username' name='username' value='<?php echo $username ?>' required >
	</div>

	<!-- Password -->
	<div class="form-group">
		<label for="password">Password</label>
		
		<input class='form-control' type="password" name='password' id="password" value='<?php echo $password ?>' required>
	</div>


	<!-- Firstname -->
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input class='form-control' type="text" id='firstname' name='firstname' value='<?php echo $firstname ?>' required >
	</div>

	<!-- Lastname -->
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input class='form-control' type="text" id='lastname' name='lastname' value='<?php echo $lastname ?>' required >
	</div>

	<!-- Email -->
	<div class="form-group">
		<label for="email">Email</label>
		<input class='form-control' type="text" id='email' name='email' required  value='<?php echo $email ?>'>
	</div>

	<!-- Image -->
	<!-- <div class="form-group">
		<label for="user_image">User Image</label>
		<input  type="file" id='user_image' name='user_image' >
	</div> -->

	<!-- Role -->
	<div class="form-group">
	<label for="user_role">User Role</label>
	<select name="user_role" id="user_role" class='form-control'>
		<?php display_role_select(True, $user_role) ?>
	</select>
</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='edit_user' value='Edit' >
	</div>
</form>
</div>