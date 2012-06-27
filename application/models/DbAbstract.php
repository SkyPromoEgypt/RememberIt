<?php
namespace application\models;
use application\models as Models;

abstract class DbAbstract {
	
	protected static $_tableName;
	protected static $_dbFields;
	protected static $_className;
	
	/**
	 * Get all the Objects of this calss from the databse
	 * @return Resource
	 */
	public static function find_all() {
		$sql  = "SELECT * FROM " . static::$_tableName . " WHERE user_id = ";
		$sql .= $_SESSION['userId'];
		return (static::find_by_sql($sql)) ? static::find_by_sql($sql) : false;
	}
	
	/**
	 * Get the object by its ID in the database.
	 * @param integer $id <p>
	 * @return Object
	 */
	public static function find_by_id( $id = 0 ) {
		$database = new Models\DbInitialize();
		$sql  = "SELECT * FROM " . static::$_tableName . " WHERE id = "; 
		$sql .= $database->escape_value($id) . " LIMIT 1";
		$result_array = static::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	/**
	 * Find the objects by a specific sql query 
	 * @param string $sql
	 * @return ArrayObject
	 */
	public static function find_by_sql( $sql = "" ) {
		$database = new Models\DbInitialize();
		$result_set = $database->query($sql);
		$object_array = array();
		for( $i = 0; $row = $database->fetch_array($result_set); $i++) {
			$object_array[] = static::instantiate($row);
		}
		return !empty($object_array) ? $object_array : false;
	}
	
	/**
	 * Return count of records in the table
	 * @return integer Number of the records in the table (Zero if empty)
	 */
	
	public static function total() {
		return static::find_all() ? count(static::find_all()) : 0;
	}
	
	/**
	 * Instantiate an Object of the Static Class
	 * @param array $record
	 * @return Object
	 */
	
	private static function instantiate($record) {
		
		$object = new static::$_className;

		foreach($record as $attribute => $value) {
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	/**
	 * Checks wither an attribute exists on a class or not
	 * @return boolean 
	 */
	
	private function has_attribute($attribute) {
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
	}
	
	/**
	 * Create an un-sanitized array of the class attributes based on the 
	 * DB attributes and not all of the class attributes
	 * @return array 
	 */
	
	protected function attributes() {
		$attributes = array();
		foreach(static::$_dbFields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	/**
	 * Create an sanitized array of the class attributes based on the 
	 * DB attributes and not all of the class attributes
	 * @return array 
	 */
	
	protected function sanitized_attributes() {
		$database = new Models\DbInitialize();
		$clean_attributes = array();
		foreach($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	
	/**
	 * Saves the object to the database based on the id attribute
	 * @return boolean
	 */
	
	public function save() {
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	/**
	 * Creates an object and save it to the database
	 * @return boolean
	 */
	
	public function create() {
		$database = new Models\DbInitialize();
		$attributes = $this->sanitized_attributes();
		$sql  = "INSERT INTO " . static::$_tableName . " (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Updates the object and save it to the database
	 * @return boolean
	 */
	
	public function update() {
		$database = new Models\DbInitialize();
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $attribute => $value) {
			$attribute_pairs[] = "{$attribute} = '{$value}'";
		}
		$sql  = "UPDATE " . static::$_tableName . " SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id = " . $database->escape_value($this->id);
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
	/**
	 * Deletes the object from the database
	 * @return boolean
	 */
	
	public function delete() {
		$database = new Models\DbInitialize();
		$sql  = "DELETE FROM " . static::$_tableName;
		$sql .= " WHERE id = " . $database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
	/**
	 * Truncates (Empty) a table
	 * @return boolean
	 */
	
	public function truncate() {
		$database = new Models\DbInitialize();
		$sql = "TRUNCATE TABLE " . static::$_tableName;
		return ($database->query($sql)) ? true : false;
	}
}