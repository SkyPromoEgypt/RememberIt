<?php

// Setting error reporting
error_reporting ( E_ALL & ~ E_STRICT & ~ E_NOTICE & ~ E_DEPRECATED );

# Application Global Constants and Paths #
defined ( 'DS' ) ? null : define ( 'DS', DIRECTORY_SEPARATOR );
defined ( 'APPLICATION_PATH' ) ? null : define ( 'APPLICATION_PATH', realpath ( "../" ) );
defined ( 'CONTROLLERS_PATH' ) ? null : define ( 'CONTROLLERS_PATH', APPLICATION_PATH . DS . "application" . DS . "controllers" );
defined ( 'MODELS_PATH' ) ? null : define ( 'MODELS_PATH', APPLICATION_PATH . DS . "application" . DS . "models" );
defined ( 'LIBRARY_PATH' ) ? null : define ( 'LIBRARY_PATH', APPLICATION_PATH . DS . "application" . DS . "lib" );
defined ( 'LAYOUT_PATH' ) ? null : define ( 'LAYOUT_PATH', APPLICATION_PATH . DS . "application" . DS . "layout" );
defined ( 'AJAX_DIVS_PATH' ) ? null : define ( 'AJAX_DIVS_PATH', APPLICATION_PATH . DS . "application" . DS . "views" . DS . "ajaxdivs" );
defined ( 'SITENAME' ) ? null : define ( 'SITENAME', "http://" . $_SERVER ['HTTP_HOST'] );

defined ( 'CSS_PATH' ) ? null : define ( 'CSS_PATH', SITENAME . "/css" );
defined ( 'JAVASCRIPT_PATH' ) ? null : define ( 'JAVASCRIPT_PATH', SITENAME . "/javascript" );
defined ( 'IMAGES_PATH' ) ? null : define ( 'IMAGES_PATH', SITENAME . "/images" );

# Database Configuration #
defined ( 'DB_SERVER' ) ? null : define ( "DB_SERVER", "localhost" );
defined ( 'DB_NAME' ) ? null : define ( "DB_NAME", "mydir" );
defined ( 'DB_USER' ) ? null : define ( "DB_USER", "firefox" );
defined ( 'DB_PASS' ) ? null : define ( "DB_PASS", "meriemk" );

// Autoload functions files
if (is_dir ( LIBRARY_PATH )) {
	$handle = opendir ( LIBRARY_PATH );
	if ($handle) {
		while ( false !== ($file = readdir ( $handle )) ) {
			if ($file != "." && $file != ".." && $file != "application.php") {
				require_once (LIBRARY_PATH . DS . $file);
			}
		}
	}
}

// Setting include path
$paths = array (get_include_path (), APPLICATION_PATH, LIBRARY_PATH, CONTROLLERS_PATH, MODELS_PATH );
set_include_path ( implode ( PATH_SEPARATOR, $paths ) );

// Intializing Session Object
session_start ();
if (! $_SESSION ['loggedIn']) {
	$_SESSION ['loggedIn'] = false;
}

// Routing to the appropriate Controller and View
$controllerName = formatUri () ? formatUri () : "rememberit";
$actionName = formatUri ( true ) ? formatUri ( true ) : "default";

use application\controllers as Controllers;

switch ($controllerName) {
	case "" :
	case "rememberit" :
		$controller = new Controllers\RememberItController ( $controllerName, $actionName );
		break;
}