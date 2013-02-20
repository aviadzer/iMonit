<?php
//***********************************
//**   USER CLASS
//***********************************

class user {
	// declare variables
	var $email;			// the user's email (string)
	var $logged_in;		// is the user logged in (true/false)
	var $last_error;	// string containing last error
	var $remember;		// remmeber through cookie
	
	function user($user_name='guest') { // constructor
		// initialize variables --> new user defaults to 'guest'
		$this->email=$user_name;
		$this->logged_in=false;
	}
	
	function userExists() { // check if the user exists
		// query the database
		$query=mysql_query("SELECT * FROM users WHERE email = '".mysql_real_escape_string($this->email)."'");
		if($row=mysql_fetch_object($query)) {
			return true;
		} else {
			$this->last_error='email does not exist!';
			return false;
		}
	}
	
	function login() { // attempt to login user
		if($this->userExists()) { // check if user exists
			// check if password was sent via JS hash			
			$password=md5($_POST['password']);

			// query the database
			$query=mysql_query("SELECT * FROM users WHERE email = '".mysql_real_escape_string($this->email)."' AND password = '".mysql_real_escape_string($password)."'");
			
			if($row=mysql_fetch_object($query)) {
				// log the user in
				$this->logged_in=true;
				
				// set cookie for next time 
				if($this->remember == 'on'){
					$expire = time()+86400;
					setcookie('testsite', $_POST['email'], $expire);
				}
				// TODO: header("location:enter.php");
				return true;
				
			} else {
				$this->last_error='Password incorrect!';
				
				return false;
			}
		}
		return false;
	}
	
	function validateEmail($str) {
		return preg_match('/^([A-Z0-9._%-]+)@([A-Z0-9.-]+)\.([A-Z]{2,6})$/i',$str);
	}
}