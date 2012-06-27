<?php
namespace application\controllers;
use application\models as Models;

class RememberItController extends ControllerAbstract {
	
	public function DefaultAction() {
		if (isset($_POST['submit'])) { 
		
		  $username = trim($_POST['username']);
		  $password = trim($_POST['password']);
		  
		  $found_user = Models\User::authenticate($username, $password);
			
		  if ($found_user) {
			$_SESSION['loggedIn'] = true;
			$_SESSION['userId'] = $found_user->id;
			if($_SESSION['page']) {
				redirect_to($_SESSION['page']);
			}
		  } else {
		  	flashMessenger ( "error", "Username/password combination incorrect." );
		  }
		  
		} else {
		  $username = "";
		  $password = "";
		}
		if (isset($_POST['activate'])) { 
		
		  $activation = trim($_POST['activation']);
		  $user_id = $_SESSION['userId'];
		  
		  $found_user = Models\User::enableAccout($user_id, $activation);
			
		  if ($found_user) {
		  	$found_user->status = "Active";
		  	$found_user->update();
		  } else {
		  	flashMessenger ( "error", "Activation Failed. Please Make sure that you enter the corrent activation code." );
		  }
		  
		} else {
		  $activation = "";
		}
		$this->render ();
	}
	
	public function LogoutAction() {
		if(getStatus() == "logout") {
			$_SESSION = array();
			session_destroy();
    		redirect_to(SITENAME);
		}
	}
	
	public function WebAction() {
		if (isset ( $_POST ['submit'] )) {
			if (getPost () == 'edit') {
				$account = Models\Website::find_by_id ( getId () );
				if($account->user_id == $_SESSION['userId']) {
					if($account != false) { 
						$account->username = $_POST ['username'];
						$account->password = $_POST ['password'];
						$account->weblink = $_POST ['weblink'];
						
						$formFields = array("username" => "Username",
											"password" => "Password",
											"weblink" => "Website Link"
											);
	
						$errors = validateFormFields("POST", $formFields);
						if ($errors) {
							formFlashMessenger($errors);
						} else {
							if ($account->update ()) {
								flashMessenger ( "success", "Account updated successfully." );
							} else {
								flashMessenger ( "error", "Error updating the account." );
							}
						}
					} else {
						flashMessenger ( "error", "No account to update." );
					}
				}
			} else {
				$user_id = $_SESSION['userId'];
				$username = $_POST ['username'];
				$password = $_POST ['password'];
				$weblink = $_POST ['weblink'];
				
				$formFields = array("username" => "Username",
									"password" => "Password",
									"weblink" => "Website Link"
									);
	
				$errors = validateFormFields("POST", $formFields);
				if ($errors) {
					formFlashMessenger($errors);
				} else {
					$account = new Models\Website ();
					$AccObj = $account->makeAccount ( $user_id, $username, $password, $weblink );
					if ($AccObj) {
						$_SESSION['success'] = true;
						flashMessenger ( "success", "Account created successfully." );
					} else {
						flashMessenger ( "error", "Error creating the account." );
					}
				}
			}
		}
		if (getPost () == 'delete') {
			$account = Models\Website::find_by_id ( getId () );
			if($account->user_id == $_SESSION['userId']) {
				if($account != false) { 
					if ($account->delete ()) {
						flashMessenger ( "success", "Account deleted successfully." );
					} else {
						flashMessenger ( "error", "Error deleting the $account." );
					}
				} else {
					flashMessenger ( "error", "No account to update." );
				}
			}
		}
		$this->render ();
	}
	
	public function ApplicationUserAction() {
		if (isset ( $_POST ['submit'] )) {
			if (getPost () == 'edit') {
				$account = Models\ApplicationUser::find_by_id ( getId () );
				if($account->user_id == $_SESSION['userId']) {
					if($account != false) { 
						$account->username = $_POST ['username'];
						$account->password = $_POST ['password'];
						$account->appname = $_POST ['appname'];
						
						$formFields = array("username" => "Username",
											"password" => "Password",
											"appname" => "Application Name"
											);
	
						$errors = validateFormFields("POST", $formFields);
						if ($errors) {
							formFlashMessenger($errors);
						} else {
							if ($account->update ()) {
								flashMessenger ( "success", "Account updated successfully." );
							} else {
								flashMessenger ( "error", "Error updating the account." );
							}
						}
					} else {
						flashMessenger ( "error", "No account to update." );
					}
				}
			} else {
				$user_id = $_SESSION['userId'];
				$username = $_POST ['username'];
				$password = $_POST ['password'];
				$appname = $_POST ['appname'];
				
				$formFields = array("username" => "Username",
									"password" => "Password",
									"appname" => "Application Name"
									);

				$errors = validateFormFields("POST", $formFields);
				if ($errors) {
					formFlashMessenger($errors);
				} else {
					$account = new Models\ApplicationUser ();
					$AccObj = $account->makeAccount ( $user_id, $username, $password, $appname );
					if ($AccObj) {
						$_SESSION['success'] = true;
						flashMessenger ( "success", "Account created successfully." );
					} else {
						flashMessenger ( "error", "Error creating the account." );
					}
				}
			}
		}
		if (getPost () == 'delete') {
			$account = Models\ApplicationUser::find_by_id ( getId () );
			if($account->user_id == $_SESSION['userId']) {
				if($account != false) {
					if ($account->delete ()) {
						flashMessenger ( "success", "Account deleted successfully." );
					} else {
						flashMessenger ( "error", "Error deleting the $account." );
					}
				} else {
					flashMessenger ( "error", "No account to delete." );
				}
			}
		}
		$this->render ();
	}
	
	public function PhoneBookAction() {
		if (isset ( $_POST ['submit'] )) {
			if (getPost () == 'edit') {
				$account = Models\PhoneBook::find_by_id ( getId () );
				if($account->user_id == $_SESSION['userId']) {
					if($account != false) { 
						$account->firstname = $_POST ['firstname'];
						$account->lastname = $_POST ['lastname'];
						$account->telephone = $_POST ['telephone'];
						$account->mobile = $_POST ['mobile'];
						$account->work = $_POST ['work'];
						$account->pager = $_POST ['pager'];
						$account->email = $_POST ['email'];
						
						$formFields = array("firstname" => "First Name",
											"lastname" => "Last Name",
											"telephone" => "Telephone Number",
											"mobile" => "Mobile Number",
											"email" => "Email Address"
											);
	
						$errors = validateFormFields("POST", $formFields);
						if ($errors) {
							formFlashMessenger($errors);
						} else {
							if ($account->update ()) {
								flashMessenger ( "success", "Account updated successfully." );
							} else {
								flashMessenger ( "error", "Error updating the account." );
							}
						}
					} else {
						flashMessenger ( "error", "No Account to update." );
					}
				}
			} else {
				$user_id = $_SESSION['userId'];
				$firstname = $_POST ['firstname'];
				$lastname = $_POST ['lastname'];
				$telephone = $_POST ['telephone'];
				$mobile = $_POST ['mobile'];
				$work = $_POST ['work'];
				$pager = $_POST ['pager'];
				$email = $_POST ['email'];
				
				$formFields = array("firstname" => "First Name",
									"lastname" => "Last Name",
									"telephone" => "Telephone Number",
									"mobile" => "Mobile Number",
									"email" => "Email Address"
									);

				$errors = validateFormFields("POST", $formFields);
				if ($errors) {
					formFlashMessenger($errors);
				} else {
					$account = new Models\PhoneBook ();
					$AccObj = $account->makeAccount ($user_id, $firstname, $lastname, $telephone, $mobile, $work, $pager, $email);
					if ($AccObj) {
						$_SESSION['success'] = true;
						flashMessenger ( "success", "Account created successfully." );
					} else {
						flashMessenger ( "error", "Error creating the account." );
					}
				}
			}
		}
		if (getPost () == 'delete') {
			$account = Models\PhoneBook::find_by_id ( getId () );
			if($account->user_id == $_SESSION['userId']) {
				if($account != false) {
					if ($account->delete ()) {
						flashMessenger ( "success", "Account deleted successfully." );
					} else {
						flashMessenger ( "error", "Error deleting the $account." );
					}
				} else {
					flashMessenger ( "error", "No account to delete." );
				}
			}
		}
		$this->render ();
	}
	
	public function RegisterAction() {
		if($_SESSION['loggedIn']) {
			redirect_to(SITENAME);
		}
		if (isset ( $_POST ['submit'] )) {
			if(isset($_POST['agree'])) {
				$firstname = $_POST ['firstname'];
				$lastname = $_POST ['lastname'];
				$username = $_POST ['username'];
				$password = $_POST ['password'];
				$cpassword = $_POST ['cpassword'];
				$email = $_POST ['email'];
				
				$formFields = array("firstname" => "First Name",
						"lastname" => "Last Name",
						"username" => "Username",
						"password" => "Password",
						"cpassword" => "Confirm Password",
						"email" => "Email"
						);
	
				$errors = validateFormFields("POST", $formFields);
				
				if($errors) {
					formFlashMessenger ($errors);
				} else {
					if(Models\User::user_exists($username)) {
						flashMessenger ( "error", "Username already exists." );
					} else if ($password != $cpassword) {
						flashMessenger ( "error", "Passwords doesn't match." );
					} else {
						$user = new Models\User ();
						$userObj = $user->makeAccount($username, $password, $firstname, $lastname, $email);
						if ($userObj) {
							flashMessenger ( "success", "Account created successfully. An activation code has been sent tou your email. Please copy the activation code, login to <a href=\"" . SITENAME . "\">RememberIt</a> and activate your account to be able to use our Services." );
							$_SESSION['registered'] = true;
							redirect_to(SITENAME."/rememberit/thankyou");
						} else {
							flashMessenger ( "error", "Error creating the account." );
						}
					}
				}
			} else {
				flashMessenger ( "error", "Please accept our trerms and conditions." );
			}
		}
		$this->render ();
	}
	
	public function ThankYouAction() {
		if(!$_SESSION['registered'] || $_SESSION['loggedIn']) {
			redirect_to(SITENAME);
		} else {
			$_SESSION['registered'] = false;
			$this->render ();
		}
		
	}
	
	public function ActivateAction() {
		if($_SESSION['loggedIn']) {
			redirect_to(SITENAME);
		}
		$this->render ();
	}
	
	public function SettingsAction() {
		$this->render ();
	}
}