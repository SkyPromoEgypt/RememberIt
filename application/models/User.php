<?php
namespace application\models;
use application\models as Models;

class User extends DbAbstract implements IModel {
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $email;
	//public $settings = array("" => "");
	public $activation;
	public $status;
	
	protected static $_tableName = "users";
	protected static $_dbFields = array ('id', 'username', 'password', 'first_name', 'last_name', 'email', 'activation', 'status' );
	protected static $_className = __CLASS__;
	
	public function __call($name, $args) {
		
		$methodPrefix = substr ( $name, 0, 3 );
		$methodProperty = strtolower ( $name [3] ) . substr ( $name, 4 );
		
		switch ($methodPrefix) {
			case "get" :
				return $this->$methodProperty;
				break;
			
			case "set" :
				if (count ( $args ) == 1) {
					$this->$methodProperty = $args [0];
				} else {
					throw new \Exception ( "The Set method supports only 1 argument" );
				}
				break;
			
			default :
				throw new \Exception ( "The method doesn't support this prefix" );
				break;
		}
	}
	
	public function __toString() {
		return "";
	}
	
	public function makeAccount($username, $password, $firstname, $lastname, $email) {
		
		$user 				= new self ();
		$user->username 	= $username;
		$user->password 	= sha1($password);
		$user->first_name 	= $firstname;
		$user->last_name 	= $lastname;
		$user->email 		= $email;
		$user->activation	= md5(time());
		
		if ($user->save ())
			return true;
		
		return false;
	}
	
	public static function enableAccout($user_id, $activation) {
		$database = new Models\DbInitialize();
		$sql = "SELECT * FROM " . self::$_tableName . " ";
		$sql .= "WHERE id = '{$user_id}' ";
		$sql .= "AND activation = '{$activation}' ";
		$sql .= "LIMIT 1";
		$found_user = self::find_by_sql ( $sql );
		return ! empty ( $found_user ) ? array_shift ( $found_user ) : false;
	}
	
	public function full_name() {
		if (isset ( $this->first_name ) && isset ( $this->last_name )) {
			return $this->first_name . " " . $this->last_name;
		} else {
			return "";
		}
	}
	
	public static function authenticate($username = "", $password = "") {
		$database = new Models\DbInitialize();
		$username = $database->escape_value ( $username );
		$password = $database->escape_value ( sha1($password) );
		$sql = "SELECT * FROM " . self::$_tableName . " ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		$found_user = self::find_by_sql ( $sql );
		return ! empty ( $found_user ) ? array_shift ( $found_user ) : false;
	}
	
	public static function user_exists($username = "") {
		$database = new Models\DbInitialize();
		$username = $database->escape_value ( $username );
		$sql = "SELECT * FROM " . self::$_tableName . " ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "LIMIT 1";
		$found_user = self::find_by_sql ( $sql );
		return ! empty ( $found_user ) ? array_shift ( $found_user ) : false;
	}
	
	public static function renderForControl() {
		return true;
	}
}