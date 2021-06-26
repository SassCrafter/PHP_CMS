<?php
include_once './db.php';
include_once '../admin/includes/functions.php';
session_start();

if (isset($_POST['login'])) {
	$username = escape_string($_POST['login_username']);
	$password = escape_string($_POST['login_password']);


	$query = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);

	show_query_error($result);
	$user = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$user['db_user_id'] = $row['user_id'];
		$user['db_username'] = $row['username'];
		$user['db_password'] = $row['password'];
		$user['db_firstname'] = $row['firstname'];
		$user['db_email'] = $row['email'];
		$user['db_lastname'] = $row['lastname'];
		$user['db_user_role'] = $row['user_role'];

		// $password = crypt($password,$user['db_password']);


	}

	if (password_verify($password, $user['db_password'])) {
		$_SESSION['user'] = $user;

		if ($user['db_user_role'] === 'admin') {
			header("Location: ../admin/index.php");
		}
		header("Location: ../index.php");
	} else {
		header("Location: ../index.php");	
		// echo password_verify($password, $row['password'])

		
	}
}