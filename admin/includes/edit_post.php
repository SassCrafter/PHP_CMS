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
		$post_status = $row['post_status'];
		$post_image = $row['post_image'];
		$post_tags = $row['post_tags'];
		$post_content = $row['post_content'];
		$post_date = $row['post_date'];
	}
	
	
?>

<div class="col-md-10 col-lg-6">
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


	<?php include_once './includes/edit_post_status.php' ?>

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
		<label for="post_content">Post Content</label>
		<textarea rows='5' class='form-control' type="text" id='post_content' name='post_content' required><?php echo $post_content ?></textarea>
	</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='edit_post' value='Edit' >
	</div>
</form>
</div>