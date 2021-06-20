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



