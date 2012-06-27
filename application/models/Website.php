<?php
namespace application\models;

class Website extends DbAbstract implements IModel {
	
	public $id;
	public $user_id;
	public $username;
	public $password;
	public $weblink;
	
	protected static $_tableName = "websites";
	protected static $_dbFields = array ('id', 'user_id', 'username', 'password', 'weblink' );
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
	
	public function makeAccount($user_id, $username, $password, $weblink) {
		
		$account = new self ();
		$account->user_id = $user_id;
		$account->username = $username;
		$account->password = $password;
		$account->weblink = $weblink;
		if ($account->save ())
			return true;
		
		return false;
	}
	
	public function __toString() {
		return "Your username for $this->weblink is $this->username and your password is $this->password.";
	}
	
	public static function renderForControl() {
		
		$items = self::find_all ();
		$count = self::total();
		$output .= "
					<table class=\"tableControl\">
					<tr><th colspan=\"8\">Total number of Application User records is: $count</th></tr>
				    <tr>
				    <th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Website</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Username</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Password</th>
					<th colspan=\"2\" style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Controls</th>
					</tr>";
		if($items) {
			foreach ( $items as $item ) {
				$message = "Are you sure you want to delete account for $item->weblink ?";
				$js = "if(confirm('$message')) { return true; } else { return false; }";
				$output .= "<tr>
							<th><a style=\"color:#000; text-decoration:underline;\" href=\"$item->weblink\" target=\"_blank\">$item->weblink</a></th>
							<th>$item->username</th>
							<th>$item->password</th>
							<td><a href=\"" . SITENAME . "/rememberit/web/edit/$item->id\"><img src=\"" . IMAGES_PATH . "/b_edit.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							<td><a href=\"" . SITENAME . "/rememberit/web/delete/$item->id\" onclick=\"$js\"><img src=\"" . IMAGES_PATH . "/b_drop.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							</tr>";
			}
		} else {
			$output .= "<th>No Accounts to show.</th>";
		}
		$output .= "<tr><th><a href=\"" . SITENAME . "/rememberit/web/\">+ Create New Website Account</a></th></tr>";
		$output .= "</table><p>&nbsp;</p>";
		return $output;
	}
}