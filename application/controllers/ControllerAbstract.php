<?php

namespace application\controllers;

// Remember that abstract classes cannot be instantiated 
// and that any abstracted methods must be implemented 
// in case of inherietance by the child class
 
abstract class ControllerAbstract implements IController {
	
	/**
	 * 
	 * Controller Name dispatched from the application URL
	 * @var string
	 */
	
	protected $controller;
	
	/**
	 * 
	 * Action Name dispatched from the application URL
	 * @var string
	 */
	
	protected $action;
	
	
	/**
	 * Class constructor 
	 * Instantiate the object by setting the controller name
	 * and the action name
	 * @param string $controller
	 * @param string $action
	 */
	
	public function __construct($controller = "Index", $action = "default") {
		$this->controller = $controller;
		$this->action = $action;
	}
	
	/**
	 * Builds the path to the view folder based on the controller name and the namespace
	 * @return View Path
	 */
	
	public function getViewFolder(){
		return str_replace('\\', '/', APPLICATION_PATH) . '/' . str_replace('\\', '/', __NAMESPACE__) . '/../views/' . $this->controller;
	}
	
	/**
	 * The dispatcher method. Dispatched the controller name and 
	 * the action name form the application URL
	 * @throws Exception if the method is not implemented
	 */
	
	public function dispatch() {
		$method = $this->action . "Action";
		if(method_exists($this, $method)) {
			$this->$method();
		} else {
			redirect_to(SITENAME);
			throw new \Exception("You have to implement a method called" . $method);
		}
	}
	
	/**
	 * Render the view file based on its controller
	 */
	
	public function render() {
		include_once $this->getViewFolder() . '/' . $this->action . '.php';
	}
}