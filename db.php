<?php
session_start();

function _redirect($to) {
    header("location: {$to}");
    exit;
}

function _get($index) {
	return trim($_GET[$index]);
}

function _post($index) {
	return trim($_POST[$index]);
}

function is_post($index ='') {
	if($index == '' && $_POST) {
		return true;
	} elseif($index != '' && isset($_POST[$index])) {
		return true;
	}

	return false;
}

function is_get($index ='') {
	if($index == '' && $_GET) {
		return true;
	} elseif($index != '' && isset($_GET[$index])) {
		return true;
	}

	return false;
}


function _set_flash_message($index, $message) {
	return $_SESSION[$index] = $message;
}

function _get_flash_message($index) {
	if(isset($_SESSION[$index])) {
		echo $_SESSION[$index];
		unset($_SESSION[$index]);
	}
	return false;
}

function _set_alert($type, $message) {
	if($type == 's') {
		_set_flash_message('notice', "<div class='alert alert-success'>{$message}</div>");
	} elseif($type == 'e') {
		_set_flash_message('notice', "<div class='alert alert-danger'>{$message}</div>");
	}
}

// Define db constants
define('DB_NAME', 'user_reg');
define('DB_USER', 'root');
define('DB_PASSWORD', '85253346');
define('DB_HOST', 'localhost');

// Instantiate mysqli class
$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if($con->error) {
	die('Connection error: ' . $con->error);
}

function find_many($table, $where_clause = null, $orderby = "", $limit = ""){
		global $db;
	 	$q = "SELECT * FROM $table $where_clause $orderby $limit";

	 	$result = mysqli_query($db, $q);

	 	$arrs = array();

	 	while($arr = mysqli_fetch_array($result)){

	 		$arrs[] = $arr;
	 	}

	 	// Convert array to object
	 	$json_arrs = json_encode($arrs);
	 	return json_decode($json_arrs);
	 }

	 function find_one($table, $where_clause=null,  $orderby=null, $limit=null) {
	 	global $db;
	 	if(is_array($where_clause)) {
	 		$query = find_many($table, "where {$where_clause[0]} = '{$where_clause[1]}'", $orderby, $limit);
	 	} else {
	 		$query = find_many($table, $where_clause, $orderby, $limit);
	 	}
	 	$q = '';
	 	foreach($query as $q);
	 	return $q;
	 }