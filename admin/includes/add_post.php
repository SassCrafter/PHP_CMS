

<div class="col-md-10 col-lg-6">
	<?php
	
	create_post();
	
?>
	<form action="" method='post' enctype="multipart/form-data">
	<!-- Title -->
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input class='form-control' type="text" id='post_title' name='post_title' required >
	</div>

	<!-- Category ID -->
	<div class="form-group">
		<label for="post_category_id">Post Category</label>
		
		<select class='form-control' name="post_category_id" id="post_category_id">
			<?php
				$categories_result = select_all_categories();
				while ($cat_row = mysqli_fetch_assoc($categories_result)) {
					echo "<option value='$cat_row[cat_id]' >$cat_row[cat_title]</option>";
				}
			?>
		</select>
	</div>


	<!-- Author -->
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input class='form-control' type="text" id='post_author' name='post_author' required >
	</div>

	<!-- User ID -->
	<div class="form-group">
		<label for="post_user_id">User</label>
		
		<select class='form-control' name="post_user_id" id="post_user_id">
			<?php
				$admin_users_result = select_all_admin_users();
				while ($user_row = mysqli_fetch_assoc($admin_users_result)) {
					$active = '';
					if ($user_row[user_id] == $_SESSION['user']['db_user_id']) {
						$active = 'selected';
					}
					echo "<option value='$user_row[user_id]' $active>$user_row[username]</option>";
				}
			?>
		</select>
	</div>

	<!-- Status -->
	<?php include_once './includes/edit_post_status.php' ?>

	<!-- Image -->
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input  type="file" id='post_image' name='post_image' >
	</div>

	<!-- Tags -->
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input class='form-control' type="text" id='post_tags' name='post_tags' required >
	</div>

	<!-- Content -->
	<div class="form-group">
		<label for="froala">Post Content</label>
		<textarea rows='5' class='form-control' type="text" id='froala' name='post_content' required></textarea>
	</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='publish_post' value='Publish' >
	</div>
</form>
</div>