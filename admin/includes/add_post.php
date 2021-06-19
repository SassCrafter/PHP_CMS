<?php
	
	if (isset($_POST['publish_post'])) {
		$post_title = escape_string($_POST['post_title']);
		$post_category_id = escape_string($_POST['post_category_id']);
		$post_author = escape_string($_POST['post_author']);
		$post_status = escape_string($_POST['post_status']);

		$post_image = $_FILES['post_image']['name'];
		$post_image_temp = $_FILES['post_image']['tmp_name'];

		$post_tags = escape_string($_POST['post_tags']);
		$post_content = escape_string($_POST['post_content']);
		$post_date = date('d-m-y');
		$post_comment_count = 4;

		// Move uploaded image
		move_uploaded_file($post_image_temp, "../images/$post_image");

		$create_post_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

		$create_post_result = mysqli_query($connection, $create_post_query);

		show_query_error($create_post_result);
	}
	
?>

<div class="col-md-10 col-lg-6">
	<form action="" method='post' enctype="multipart/form-data">
	<!-- Title -->
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input class='form-control' type="text" id='post_title' name='post_title' required >
	</div>

	<!-- Category ID -->
	<div class="form-group">
		<label for="post_category_id">Post ID</label>
		<input class='form-control' type="text" id='post_category_id' name='post_category_id' required >
	</div>


	<!-- Author -->
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input class='form-control' type="text" id='post_author' name='post_author' required >
	</div>

	<!-- Status -->
	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input class='form-control' type="text" id='post_status' name='post_status' required >
	</div>

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
		<label for="post_content">Post Content</label>
		<textarea rows='5' class='form-control' type="text" id='post_content' name='post_content' required></textarea>
	</div>

	<!-- Submit -->
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name='publish_post' value='Publish' >
	</div>
</form>
</div>