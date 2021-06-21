<?php

	function show_query_error($result) {
		global $connection;
		if (!$result) {
			die("Query Failed! " . mysqli_error($connection));
		}
	}

	function escape_string($str) {
		global $connection;
		return mysqli_real_escape_string($connection, $str);
	}


	function shorten_string($str, $len) {
		$result = $str;
        if (iconv_strlen($str) > $len) {
            $result = substr($str, 0, $len - 3) . '...';
        }
        return $result;
	}

	// Categories

	function select_all_categories() {
		global $connection;
		$cat_query = 'SELECT * FROM categories';
        $categories = mysqli_query($connection, $cat_query);

        show_query_error($categories);
        return $categories;
	}

	function select_category_by_id($id) {
		global $connection;
		$select_cat_query = "SELECT * FROM categories WHERE cat_id = $id";
		$select_cat_result = mysqli_query($connection, $select_cat_query);

		show_query_error($select_cat_result);

		return $select_cat_result;
	}

	function create_category() {
		global $connection;
		if (isset($_POST['submit'])) {
            $category_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
            
            if ($category_title == '' || empty($category_title)) {
                echo "<h4 class='text-danger'>Field cannot be empty!</h4>";
            } else {
                $insert_category_query = "INSERT INTO categories (cat_title) VALUES ('$category_title')";
                $result = mysqli_query($connection, $insert_category_query);

                if(!$result) {
                    die("Failed to create category" . mysqli_error($connection));
                }
            }
        }
	}


	function delete_category() {
		global $connection;
		if (isset($_GET['delete'])) {
	        $delete_id = $_GET['delete'];
	        $delete_query = "DELETE FROM categories WHERE cat_id = $delete_id";
	        $delete_result = mysqli_query($connection, $delete_query);

	        show_query_error($delete_result);

	        header("Location: categories.php");
	    }
	}



	// Posts
	function select_all_posts() {
		global $connection;
		$post_query = "SELECT * FROM posts";
        $posts_result = mysqli_query($connection, $post_query);

        show_query_error($posts_result);

        return $posts_result;


	}

	function select_post_by_id($id) {
		global $connection;
		$select_post_query = "SELECT * FROM posts WHERE post_id = $id";
		$select_post_result = mysqli_query($connection, $select_post_query);

		show_query_error($select_post_result);
		return $select_post_result;
	}

	function select_post_by_category_id($cat_id) {
		global $connection;
		$select_post_query = "SELECT * FROM posts WHERE post_category_id = $cat_id";
		$select_post_result = mysqli_query($connection, $select_post_query);

		show_query_error($select_post_result);
		return $select_post_result;
	}

	function select_all_posts_by_status($status = 'published') {
		global $connection;
		$query = "SELECT * FROM posts WHERE post_status = '$status' ORDER BY DATE(post_date) DESC";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
	}

	function create_post() {
		global $connection;
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
			$post_comment_count = 0;

			// Move uploaded image
			move_uploaded_file($post_image_temp, "../images/$post_image");

			$create_post_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

			$create_post_result = mysqli_query($connection, $create_post_query);

			show_query_error($create_post_result);
		}
	}


	function delete_post() {
		global $connection;
		if (isset($_GET['delete_id'])) {
			$delete_id = $_GET['delete_id'];
			$delete_query = "DELETE FROM posts WHERE post_id = $delete_id";

			$delete_result = mysqli_query($connection, $delete_query);

			show_query_error($delete_result);

			header("Location: view_all_posts.php");
		}
	}

	function edit_post($id) {
		global $connection;
		if (isset($_POST['edit_post'])) {
			$post_title = escape_string($_POST['post_title']);
			$post_category_id = escape_string($_POST['post_category_id']);
			$post_author = escape_string($_POST['post_author']);
			$post_status = escape_string($_POST['post_status']);

			$post_image = $_FILES['post_image']['name'];
			$post_image_temp = $_FILES['post_image']['tmp_name'];

			// Move uploaded image
			move_uploaded_file($post_image_temp, "../images/$post_image");

			if (empty($post_image)) {
				$fetch_image_query = "SELECT * FROM posts WHERE post_id = $id";
				$fetch_image_result = mysqli_query($connection, $fetch_image_query);
				show_query_error($fetch_image_result);
				while ($row = mysqli_fetch_array($fetch_image_result)) {
					$post_image = $row['post_image'];
				}
				
			}

			$post_tags = escape_string($_POST['post_tags']);
			$post_content = escape_string($_POST['post_content']);
			$post_date = date('d-m-y');
			$post_comment_count = 4;


			$edit_post_query = "UPDATE posts SET ";
			$edit_post_query .= "post_title = '$post_title', ";
			$edit_post_query .= "post_category_id = '$post_category_id', ";
			$edit_post_query .= "post_date = now(), ";
			$edit_post_query .= "post_author = '$post_author', ";
			$edit_post_query .= "post_status = '$post_status', ";
			$edit_post_query .= "post_tags = '$post_tags', ";
			$edit_post_query .= "post_content = '$post_content', ";
			$edit_post_query .= "post_image = '$post_image' ";
			$edit_post_query .= "WHERE post_id = $id";

			$edit_post_result = mysqli_query($connection, $edit_post_query);

			show_query_error($edit_post_result);

			header("Location: view_all_posts.php");
		}
	}



	// Comments

	function select_all_comments() {
		global $connection;
		$comments_query = "SELECT * FROM comments";
		$comments_result = mysqli_query($connection, $comments_query);

		show_query_error($comments_result);
		return $comments_result;
	}

	function select_all_comments_desc() {
		global $connection;
		$comments_query = "SELECT * FROM comments ORDER BY comment_id DESC";
		$comments_result = mysqli_query($connection, $comments_query);

		show_query_error($comments_result);
		return $comments_result;
	}

	function increase_comment_count($post_id) {
		global $connection;
		$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
	}

	function create_comment($post_id) {
		global $connection;
		if (isset($_POST['submit_comment'])) {
			$comment_post_id = $post_id;
			$author = $_POST['comment_author'];
			$email = $_POST['comment_email'];
			$content = $_POST['comment_content'];

			$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
			$query .= "VALUES ($comment_post_id, '$author', '$email', '$content', 'unapproved', now())";

			$result = mysqli_query($connection, $query);

			show_query_error($result);

			increase_comment_count($comment_post_id);
		}
	}

	function delete_comment() {
		global $connection;
		if (isset($_GET['delete_id'])) {
			$delete_id = $_GET['delete_id'];
			$delete_query = "DELETE FROM comments WHERE comment_id = $delete_id";

			$delete_result = mysqli_query($connection, $delete_query);

			show_query_error($delete_result);

			header("Location: view_all_comments.php");
		}
	}

	function approve_comment() {
		global $connection;
		if (isset($_GET['approve'])) {
			$comment_id = $_GET['approve'];
			$query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
			header("Location: view_all_comments.php");
		}
	}

	function unapprove_comment() {
		global $connection;
		if (isset($_GET['unapprove'])) {
			$comment_id = $_GET['unapprove'];
			$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
			header("Location: view_all_comments.php");
		}
	}

	function select_comments_by_post_and_approved($post_id) {
		global $connection;
		$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
		$query .= "AND comment_status = 'approved' ";
		$query .= "ORDER BY comment_id DESC";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
	}