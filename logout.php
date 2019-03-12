<?php include 'db.php';

if(isset($_SESSION['is_loggedin'])) {
	unset($_SESSION['is_loggedin']);
	unset($_SESSION['user_logged_id']);
	_set_alert('s', 'You are now <b>logged out</b>');
	_redirect('login.php');
} else {
	_redirect('login.php');
}
