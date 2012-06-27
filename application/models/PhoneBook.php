<?php
namespace application\models;
use application\models\User;

class PhoneBook extends DbAbstract implements IModel {
	
	/**
	 * Object ID
	 * @var integer
	 */
	
	public $id;
	
	/**
	 * The User ID
	 * @var integer
	 */
	
	public $user_id;
	
	/**
	 * User First Name
	 * @var string
	 */
	
	public $firstname;
	
	/**
	 * User Last Name
	 * @var string
	 */
	
	public $lastname;
	
	/**
	 * User Telephone Number
	 * @var integer
	 */
	
	public $telephone;
	
	/**
	 * User Mobile Number
	 * @var integer
	 */
	
	public $mobile;
	
	/**
	 * User Work Number
	 * @var integer
	 */
	
	public $work;
	
	/**
	 * User Pager Number
	 * @var integer
	 */
	
	public $pager;
	
	/**
	 * User Email Address
	 * @var string
	 */
	
	public $email;
	
	/**
	 * The Class Database Table Name
	 * @var string
	 */
	
	protected static $_tableName = "phonebook";
	
	/**
	 * This property is used to be called in the abstract class
	 * to define the class properties that is used to save records
	 * to the database
	 * @var array
	 */
	
	protected static $_dbFields = array ('id', 'user_id', 'firstname', 'lastname', 'telephone', 'mobile', 'work', 'pager', 'email');
	
	/**
	 * Class Name to be called statically using late static binding 
	 * in the abstract class
	 * @var __CLASS__
	 */
	
	protected static $_className = __CLASS__;
	
	
	/**
	 * __call magic method
	 * @return Method if exists
	 * @throws Exception (if the set method supports only 1 parameter)
	 * @throws Exception (if the method doesn't support the prefix)
	 */
	
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
	
	/**
	 * Creates a PhoneBook object 
	 * @param string $user_id
	 * @param string $firstname
	 * @param string $lastname
	 * @param string $telephone
	 * @param string $mobile
	 * @param string $work
	 * @param string $pager
	 * @param string $email
	 * @return boolean
	 */
	
	public static function makeAccount($user_id, $firstname, $lastname, $telephone, $mobile, $work, $pager, $email) {
		
		$account = new self ();
		$account->user_id = $user_id;
		$account->firstname = $firstname;
		$account->lastname = $lastname;
		$account->telephone = $telephone;
		$account->mobile = $mobile;
		$account->work = $work;
		$account->pager = $pager;
		$account->email = $email;
		if ($account->save ())
			return true;
		
		return false;
	}
	
	
	/**
	 * __toString Magic method
	 * @return string User Object
	 */
	
	public function __toString() {
		return "$this->firstname $this->lastname phone number is $this->phonebook.";
	}
	
	
	/**
	 * Control The PhoneBook Records
	 * This function renders a table of all the phone book 
	 * records with edit and delete controls
	 * @return string
	 */
	
	public static function renderForControl() {
		
		$items = self::find_all ();
		$count = self::total();
		$output .= "
					<table class=\"tableControl\">
					<tr><th colspan=\"8\">Total number of Telephone records is: $count</th></tr>
				    <tr>
				    <th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Name</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Phone Number</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Mobile Number</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Work Number</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Pager Number</th>
					<th style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Email Address</th>
					<th colspan=\"2\" style=\"background-color:#9A9A9A; color:FFF; text-shadow: 1px 1px 1px rgb(0,0,0); font-weight:bold;\">Controls</th>
					</tr>";
		if($items) {
			foreach ( $items as $item ) {
				$message = "Are you sure you want to delete account for $item->firstname $item->lastname ?";
				$js = "if(confirm('$message')) { return true; } else { return false; }";
				$output .= "<tr>
							<th>$item->firstname $item->lastname</th>
							<th>$item->telephone</th>
							<th>$item->mobile</th>
							<th>$item->work</th>
							<th>$item->pager</th>
							<th>$item->email</th>
							<td><a href=\"" . SITENAME . "/rememberit/phonebook/edit/$item->id\"><img src=\"" . IMAGES_PATH . "/b_edit.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							<td><a href=\"" . SITENAME . "/rememberit/phonebook/delete/$item->id\" onclick=\"$js\"><img src=\"" . IMAGES_PATH . "/b_drop.png\" align=\"top\" width=\"16\" height=\"16\" /></a></td>
							</tr>";
			}
		} else {
			$output .= "<th colspan=\"2\">No Phone Book entries to show.</th>";
		}
		$output .= "<tr><th><a href=\"" . SITENAME . "/rememberit/phonebook/\">+ Create New Phone Account</a></th></tr>";
		$output .= "</table><p>&nbsp;</p>";
		return $output;
	}
}