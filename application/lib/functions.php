<?php

/**
 * This function reformats that URL and extracts the
 * controllerName and the actinName out of it for later use.
 * @param Boolean $action
 * @return string $uri[x];
 */
function formatUri($action = false) {
	$uri = strtolower ( $_SERVER ['REQUEST_URI'] );
	$uri = str_replace ( SITENAME, "", $uri );
	$uri = explode ( "/", $uri );
	if ($action) {
		return $uri [2];
	} else {
		return $uri [1];
	}
}

function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function getStatus() {
	$uri = strtolower ( $_SERVER ['REQUEST_URI'] );
	$uri = str_replace ( SITENAME, "", $uri );
	$uri = explode ( "/", $uri );
	return $uri [2];
}

function getPost() {
	$uri = strtolower ( $_SERVER ['REQUEST_URI'] );
	$uri = str_replace ( SITENAME, "", $uri );
	$uri = explode ( "/", $uri );
	return $uri [3];
}

function getId() {
	$uri = strtolower ( $_SERVER ['REQUEST_URI'] );
	$uri = str_replace ( SITENAME, "", $uri );
	$uri = explode ( "/", $uri );
	return $uri [4];
}

function getCategory() {
	$uri = strtolower ( $_SERVER ['REQUEST_URI'] );
	$uri = str_replace ( SITENAME, "", $uri );
	$uri = explode ( "/", $uri );
	return $uri [3];
}

function __autoload($className) {
	require_once $className . ".php";
}

function pre($array) {
	echo "<pre>";
	print_r ( $array );
	echo "</pre>";
}

function flashMessenger($status, $message) {
	
	$_SESSION ['output'] = "";
	
	switch ($status) {
		case "error" :
			$_SESSION ['output'] = "<p class=\"error\">" . $message . "</p>";
			break;
		case "success" :
			$_SESSION ['output'] = "<p class=\"success\">" . $message . "</p>";
			break;
		case "msg" :
			$_SESSION ['output'] = "<p class=\"msg\">" . $message . "</p>";
			break;
	}
}

function formFlashMessenger($errors) {
	$_SESSION ['errors'] = $errors;
}

function output_message() {
	$output = (!empty($_SESSION['output']))? $_SESSION['output'] : "";
	unset($_SESSION['output']);
	return $output;
}

function output_form_errors() {
	$errors = (!empty($_SESSION['errors']))? $_SESSION['errors'] : "";
	if(!empty($errors)) {
		foreach ($errors as $error) {
			echo "<p class=\"error\">" . $error . "</p>";
		}
	}
	unset($_SESSION['errors']);
}

function checkValidity() {
	if (!$_SESSION['loggedIn']) {
		$_SESSION['page'] = $_SERVER['REQUEST_URI'];
		redirect_to(SITENAME);
	} else {
		$user = \application\models\User::find_by_id($_SESSION['userId']);
		if($user->status != "Active") {
			 redirect_to(SITENAME);
		}
	}
}

function validateFormFields($formMethod, $formFields) {
	
	$errors = array();
	
	if(is_array($formFields)) {
		foreach ($formFields as $inputName => $label) {
			if($formMethod == "POST") {
				if(empty($_POST[$inputName])) {
					$errors[] = "Please fill in the " . $label;
				}
			} else {
				if(empty($_GET[$inputName])) {
					$errors[] = "Please fill in the " . $label;
				}
			}
		}
	}
	return !empty($errors) ? $errors : false;
}

function includeAjaxViews() {
	if(is_dir(AJAX_DIVS_PATH)){
		$handle = opendir(AJAX_DIVS_PATH);
		if($handle) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if ($file != "." && $file != "..") {
					include_once(AJAX_DIVS_PATH.DS.$file);
				}
			}
		}
	}
}