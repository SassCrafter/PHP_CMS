

<div class="col-md-10 col-lg-6">
	<?php
		if (isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];

			edit_post($post_id);


			$get_post_query = "SELECT * FROM posts WHERE post_id = $post_id";
			$get_post_result = mysqli_query($connection, $get_post_query);

			show_query_error($get_post_result);

			$row = mysqli_fetch_assoc($get_post_result);
			$post_title = $row['post_title'];
			$post_category_id = $row['post_category_id'];
			$post_author = $row['post_author'];
			$post_user_id = $row['post_user_id'];
			$post_status = $row['post_status'];
			$post_image = $row['post_image'];
			$post_tags = $row['post_tags'];
			$post_content = $row['post_content'];
			$post_date = $row['post_date'];
		}
	?>
	<form action="" method='post' enctype="multipart/form-data">
	<!-- Title -->
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input class='form-control' value='<?php echo $post_title ?>' type="text" id='post_title' name='post_title' required >
	</div>

	<!-- Category -->

	<div class="form-group">
		<label for="post_category_id">Post Category</label>
		<select name="post_category_id" id="post_category_id" class="form-control">
			<?php
				$fetched_categories = select_all_categories();
				while ($cat_row = mysqli_fetch_assoc($fetched_categories)) {
					$isSelected = '';
					if ($cat_row['cat_id'] == $post_category_id) {
						$isSelected = 'selected';
					}
					echo "<option value='$cat_row[cat_id]' $isSelected>$cat_row[cat_title]</option>";
				}
			?>
		</select>
	</div>


	<!-- Author -->
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input class='form-control' value="<?php echo $post_author ?>" type="text" id='post_author' name='post_author' required >
	</div>

	<!-- User ID -->
	<div class="form-group">
		<label for="post_user_id">User</label>
		
		<select class='form-control' name="post_user_id" id="post_user_id">
			<?php
				$admin_users_result = select_all_admin_users();
				while ($user_row = mysqli_fetch_assoc($admin_users_result)) {
					$active = '';
					if ($user_row[user_id] == $post_user_id) {
						$active = 'selected';
					}
					echo "<option value='$user_row[user_id]' $active>$user_row[username]</option>";
				}
			?>
		</select>
	</div>


	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select name="post_status" id="post_status" class='form-control'>
			<option value="draft" <?php if($post_status === 'draft') echo 'selected' ?>>Draft</option>
			<option value="published" <?php if($post_status === 'published') echo 'selected' ?>>Published</option>
		</select>
	</div>

	<!-- Image -->
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<img width='100' style='display: block; max-height: 100px; margin-bottom: 10px;' src="../images/<?php echo $post_image ?>" alt="<?php echo $post_title?>">
		<input  type="file" id='post_image' name='post_image' >
	</div>

	<!-- Tags -->
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input class='form-control' value="<?php echo $post_tags ?>" type="text" id='post_tags' name='post_tags' required >
	</div>

	<!-- Content -->
	<div class="form-group">
		<label for="froala">Post Content</label>
		<textarea rows='5' class='form-control' type="text" id='froala' name='post_content' required><?php echo $post_content ?></textarea>
	</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='edit_post' value='Edit' >
	</div>
</form>
</div>