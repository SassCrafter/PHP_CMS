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

	function check_if_has_question_mark($str) {
		return strpos($str, '?') !== false;
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
		$post_query = "SELECT * FROM posts ORDER BY post_date DESC";
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

	function select_post_title_by_id($id) {
		global $connection;
		$select_post_query = "SELECT post_title FROM posts WHERE post_id = $id";
		$select_post_result = mysqli_query($connection, $select_post_query);

		show_query_error($select_post_result);
		return $select_post_result;
	}

	function select_post_by_category_id($cat_id) {
		global $connection;
		$select_post_query = "SELECT * FROM posts WHERE post_category_id = '$cat_id'AND post_status = 'published'";
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

	function select_all_posts_by_author($author) {
		global $connection;
		$query = "SELECT * FROM posts WHERE post_author = '$author' ORDER BY DATE(post_date) DESC";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
	}


	function select_posts_per_page($search_query = NULL) {
		global $connection;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = '';
		}

		if ($page === '' || $page == 1) {
			$page_num = 0;
		} else {
			$page_num = ($page * 5) - 5;
		}

		if (!$search_query) {
			$query = "SELECT * FROM posts WHERE post_status = 'published'";
		} else {
			$query = $search_query;
		}

		$query .=  " ORDER BY post_date DESC LIMIT $page_num, 5";
		// $query .= " ";
		echo $query;
		$result = mysqli_query($connection, $query);

		show_query_error($result);

		return $result;
	}

	function select_posts_per_page_by_category($cat_id) {
		$query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status = 'published'";
		return select_posts_per_page($query);
	}

	function select_posts_per_page_by_author($author) {
		$query = "SELECT * FROM posts WHERE post_author = '$author' AND post_status = 'published'";
		return select_posts_per_page($query);
	}


	function prepare_page_posts($quantity) {
		if (isset($_GET['page'])) {
    		$page_num = $_GET['page'];
    	} else {
    		$page_num = 1;
    	}
    	$posts_num = $quantity;
    	$page_count = ceil($posts_num / 5);
    	return ['page_num' => $page_num, 'posts_num' => $posts_num, 'page_count' => $page_count];
	}

	function posts_quantity($source = '', $val = NULL) {		
		
		switch ($source) {

			case 'by_category':
			$result = select_post_by_category_id($val);
			break;

			case 'by_author':
			$result = select_all_posts_by_author($val);
			break;

			default:
			$result = select_all_posts_by_status();
			break;
		}

		

		return mysqli_num_rows($result);
	}


	function create_post() {
		global $connection;
		if (isset($_POST['publish_post'])) {
			$post_title = escape_string($_POST['post_title']);
			$post_category_id = escape_string($_POST['post_category_id']);
			$post_author = escape_string($_POST['post_author']);
			$post_user_id = escape_string($_POST['post_user_id']);
			$post_status = escape_string($_POST['post_status']);

			$post_image = $_FILES['post_image']['name'];
			$post_image_temp = $_FILES['post_image']['tmp_name'];

			$post_tags = escape_string($_POST['post_tags']);
			$post_content = escape_string($_POST['post_content']);
			$post_date = date('d-m-y');
			$post_comment_count = 0;

			// Move uploaded image
			move_uploaded_file($post_image_temp, "../images/$post_image");

			$create_post_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_user_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_category_id, '$post_title', '$post_author', $post_user_id, now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

			$create_post_result = mysqli_query($connection, $create_post_query);

			show_query_error($create_post_result);
			$get_post_query = "SELECT post_id FROM posts WHERE post_title = '$post_title' AND post_category_id = $post_category_id AND post_author = '$post_author' AND post_tags = '$post_tags'";
			$get_post_result = mysqli_query($connection, $get_post_query);
			show_query_error($get_post_result);

			$id = mysqli_fetch_assoc($get_post_result)['post_id'];


			$message = "Post's been successfully created.<a href='../post.php?post_id=$id'>View post</a> <a href='./view_all_posts.php'>View all posts</a>";
			show_alert($message);
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
			$post_user_id = escape_string($_POST['post_user_id']);
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
			$edit_post_query .= "post_user_id = $post_user_id, ";
			$edit_post_query .= "post_status = '$post_status', ";
			$edit_post_query .= "post_tags = '$post_tags', ";
			$edit_post_query .= "post_content = '$post_content', ";
			$edit_post_query .= "post_image = '$post_image' ";
			$edit_post_query .= "WHERE post_id = $id";

			$edit_post_result = mysqli_query($connection, $edit_post_query);

			show_query_error($edit_post_result);

			// header("Location: view_all_posts.php");
			$message = "Post's been successfully updated.<a href='../post.php?post_id=$id'>View post</a> or <a href='./view_all_posts.php'>View all posts</a>";
			show_alert($message);
		}
	}

	


	// Post Views

	function increment_post_views_count($id) {
		global $connection;
		$query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $id";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
	}

	function reset_post_views_count() {
		global $connection;
		if (isset($_GET['reset_id'])) {
			$id = $_GET['reset_id'];
			$query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $id";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
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

	function select_comments_for_post($post_id) {
		global $connection;
		$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ORDER BY comment_id DESC";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
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

	function count_comments_for_post($post_id) {
		global $connection;
		$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return mysqli_num_rows($result);
	}

	function create_comment($post_id) {
		global $connection;
		if (isset($_POST['submit_comment'])) {
			$comment_post_id = $post_id;
			$author = escape_string($_POST['comment_author']);
			$email = escape_string($_POST['comment_email']);
			$content = escape_string($_POST['comment_content']);

			if (!empty($author) && !empty($email) && !empty($content)) {
				$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
				$query .= "VALUES ($comment_post_id, '$author', '$email', '$content', 'unapproved', now())";

				$result = mysqli_query($connection, $query);

				show_query_error($result);

				increase_comment_count($comment_post_id);
			} else {
				$msg = "Fields can't be empty. Please fill all the fields below!";
				show_alert($msg, 'danger');
			}
		}
	}

	function delete_comment($header_url = 'view_all_comments.php') {
		global $connection;
		if (isset($_GET['delete_id'])) {
			$delete_id = $_GET['delete_id'];
			$delete_query = "DELETE FROM comments WHERE comment_id = $delete_id";

			$delete_result = mysqli_query($connection, $delete_query);

			show_query_error($delete_result);

			header("Location: $header_url");
		}
	}

	function approve_comment($header_url = 'view_all_comments.php') {
		global $connection;
		if (isset($_GET['approve'])) {
			$comment_id = $_GET['approve'];
			$query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
			header("Location: $header_url");
		}
	}

	function unapprove_comment($header_url = 'view_all_comments.php') {
		global $connection;
		if (isset($_GET['unapprove'])) {
			$comment_id = $_GET['unapprove'];
			$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
			header("Location: $header_url");
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



	// Users

	function select_all_users($where = NULL) {
		global $connection;
		$query = "SELECT * FROM users";
		if ($where) {
			$query .= $where;
		}
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
	}

	function select_all_admin_users() {
		return select_all_users(" WHERE user_role = 'admin'");
	}

	function select_user_by_id($id) {
		global $connection;
		$query = "SELECT * FROM users WHERE user_id = $id";
		$result = mysqli_query($connection, $query);

		show_query_error($result);
		return $result;
	}

	function create_user($default_role = True) {
		global $connection;
		$username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $firstname = escape_string($_POST['firstname']);
		$lastname = escape_string($_POST['lastname']);
		$user_role = $default_role ? 'admin' : $_POST['user_role'];

        // Encryption
        // $salt = get_rand_salt();
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        $query = "INSERT INTO users (username, password, firstname, lastname, email, user_role) VALUES ('$username', '$encrypted_password', '$firstname', '$lastname', '$email', '$user_role')";
        $result = mysqli_query($connection, $query);

        show_query_error($result);


	}

	function create_user_in_admin() {
		global $connection;
		
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			// $user_image = $_POST['user_image'];
			$user_role = $_POST['user_role'];

			$query = "INSERT INTO users (username, password, firstname, lastname, email, user_role) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$user_role')";
			$result = mysqli_query($connection, $query);

			show_query_error($result);
			// header("Location: view_all_users.php");
	}

	function delete_user() {
		global $connection;
		if (isset($_GET['delete_id'])) {
			$delete_id = $_GET['delete_id'];
			$delete_query = "DELETE FROM users WHERE user_id = $delete_id";

			$delete_result = mysqli_query($connection, $delete_query);

			show_query_error($delete_result);

			header("Location: view_all_users.php");
		}
	}

	


	function display_role_select($show_selected = False, $active_role = '') {
		global $connection;
		$roles_query = "SELECT user_role FROM users";
		$roles_result = mysqli_query($connection, $roles_query);
		show_query_error($roles_result);

		$roles = [];

		$rows = mysqli_fetch_all($roles_result, MYSQLI_ASSOC);
		// print_r($rows);

		foreach($rows as $row) {
			if (!in_array($row['user_role'], $roles)) {
				$roles[] = $row['user_role'];
			}
		}
		if($show_selected) {
			echo "<option value='$active_role' selected>$active_role</option>";
		}
		foreach($roles as $role) {
			echo "<option value='$role'>$role</option>";
		}
	}


	function edit_user($id) {
		global $connection;
		if (isset($_POST['edit_user'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
			$email = $_POST['email'];
			$user_role = $_POST['user_role'];

			// Encryption
        	$encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
			
			$query = "UPDATE users SET ";
			$query .= "username = '$username', ";
			$query .= "password = '$encrypted_password', ";
			$query .= "firstname = '$firstname', ";
			$query .= "lastname = '$lastname', ";
			$query .= "email = '$email', ";
			$query .= "user_role = '$user_role' ";
			$query .= "WHERE user_id = $id";

			$result = mysqli_query($connection, $query);

			show_query_error($result);
			header("Location: view_all_users.php");

		}
	}


	// Login

	function select_user_username_password($username, $password) {
		global $connection;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$user_role = $_POST['user_role'];
	}


	// Profile

	function edit_profile($id) {
		global $connection;
		if (isset($_POST['edit_profile'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
			$email = $_POST['email'];
			
			$query = "UPDATE users SET ";
			$query .= "username = '$username', ";
			$query .= "password = '$password', ";
			$query .= "firstname = '$firstname', ";
			$query .= "lastname = '$lastname', ";
			$query .= "email = '$email' ";
			$query .= "WHERE user_id = $id";

			$result = mysqli_query($connection, $query);

			show_query_error($result);
		}
	}

	function create_user_session_obj($user) {
		$new_user = $user;
		$new_user['db_username'] = $_POST['username'];
		$new_user['db_password'] = $_POST['password'];
		$new_user['db_firstname'] = $_POST['firstname'];
		$new_user['db_email'] = $_POST['email'];
		$new_user['db_lastname'] = $_POST['lastname'];
		return $new_user;

	}

	function update_user_session() {
		global $connection;
		
		$user = create_user_session_obj($_SESSION['user']);
		$_SESSION['user'] = $user;
		print_r($_SESSION);
		// print_r($user);
	}


	// Alerts

	function show_alert($message, $type = 'success') {
		echo "  
			<div class='alert alert-$type' role='alert'>
			  $message
			</div>
		";
	}

	function check_form_fields_empty() {
		return count(array_filter($_POST)) != count($_POST);
	}

	// Password encryption
	function get_rand_salt() {
		global $connection;
		$query = "SELECT rand_salt FROM users";
		$result = mysqli_query($connection, $query);

		show_query_error($result);

		return mysqli_fetch_assoc($result)['rand_salt'];

	}


	// Users online

	function users_online() {

		if (isset($_GET['usersonline'])) {
			session_start();
			include_once '../../includes/db.php';
			$session = session_id();
		    $time = time();
		    $timeout_in_sec = 60;
		    $timeout = $time - $timeout_in_sec;

		    $query = "SELECT * FROM users_online WHERE session = '$session'";
		    $send_query = mysqli_query($connection, $query);
		    $count = mysqli_num_rows($send_query);

		    if ($count == NULL) {
		        mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");
		    } else {
		        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
		    }

		    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $timeout");
		    echo mysqli_num_rows($users_online_query);
		}
	}

	users_online();