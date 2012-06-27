<?php
namespace application\models;

class ApplicationUser extends DbAbstract implements IModel {
	
	public $id;
	public $user_id;
	public $username;
	public $password;
	public $appname;
	
	protected static $_tableName = "appusers";
	protected static $_dbFields = array ('id', 'user_id', 'username', 'password'
										, 'appname' );
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
	
	public function makeAccount($user_id, $username, $password, $appname) {
		
		$account = new self ();
		$account->user_id = $user_id;
		$account->username = $username;
		$account->password = $password;
		$account->appname = $appname;
		if ($account->save ())
			return true;
		
		return false;
	}
	
	public function __toString() {
		return "Your username for $this->appname is $this->username and your password is $this->password.";
	}
	
	public static function renderForControl() {
		
		$items = self::find_all ();
		$count = self::total();
		$output .= "
					<table class=\"tableControl\">
					<tr><th colspan=\"8\">Total number of Application User records is: $count</th></tr>
				    <tr>
				    <th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Application Name</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Username</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Password</th>
					<th colspan=\"2\" style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Controls</th>
					</tr>";
		if($items) {
			foreach ( $items as $item ) {
				$message = "Are you sure you want to delete account for $item->appname ?";
				$js = "if(confirm('$message')) { return true; } else { return false; }";
				$output .= "<tr>
							<th>$item->appname</th>
							<th>$item->username</th>
							<th>$item->password</th>
							<td><a href=\"" . SITENAME . "/rememberit/applicationuser/edit/$item->id\"><img src=\"" . IMAGES_PATH . "/b_edit.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							<td><a href=\"" . SITENAME . "/rememberit/applicationuser/delete/$item->id\" onclick=\"$js\"><img src=\"" . IMAGES_PATH . "/b_drop.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							</tr>";
			}
		} else {
			$output .= "<th>No Accounts to show.</th>";
		}
		$output .= "<tr><th><a href=\"" . SITENAME . "/rememberit/applicationuser/\">+ Create New Application User</a></th></tr>";
		$output .= "</table><p>&nbsp;</p>";
		
		return $output;
	}
}