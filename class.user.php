<?php
// !php
// developed on [PHP: 5.5.15]XAMPP - Windows 7-32 bit
// class.user.php

// Step #1
// First, you have to import the ez sql
// core files into the user class. Then create an object:
require_once ('../html/ezSQL/shared/ez_sql_core.php');
require_once ('../html/ezSQL/mysql/ez_sql_mysql.php');

$mdb = new ezSQL_mysql ( 'usertest', 'machimba123', 'test', 'localhost' );

// Step #2
/**
 * Then declare the variables, this should match the
 * ones that are on the table that we created earlier *
 *
 * @author zeusintuivo
 *        
 */
class users {
	private $user_id;
	private $username;
	private $password;
	private $reg_ip;
	private $email;
	private $reg_date;
	private $last_login;
	
	// Step #3
	/**
	 * Next, create a function that will check if the user is registered or not.
	 *
	 * This function will be called every time a user will login.
	 *
	 * This function takes up 3 arguments. The username, the password, and
	 * the ip address of the computer from where the page is being accessed.
	 * It then queries the database if it finds a match for all those data.
	 * And returns true if it finds it.
	 * If it finds a record which matches the username, password, and ip.
	 * Then the function returns 1. If not, it returns 0.
	 *
	 * @param string $uname        	
	 * @param string $pword        	
	 * @param string $ip        	
	 * @return number 1 if logged in.
	 */
	function check_user($uname, $pword, $ip) {
		global $mdb;
		$exist = $mdb->query ( "SELECT Username, Password, Registered_IP FROM users
				WHERE Username='$uname' AND Password='$pword' AND Registered_IP='$ip'" );
		return $exist;
	}
	/**
	 *
	 * Next, create a function that will set the last login date for the user:
	 * NOW(), is a mysql function which returns a datetime stamp. Like this one:
	 * 2011-05-12 20:01:07
	 *
	 * @param string $uname
	 */
	function set_last_login($uname) {
		global $mdb;
		$mdb->query ( "UPDATE users SET Last_Login=NOW() WHERE Username='$uname'" );
	}
	
	
	/**
	 * After that, we set the user as active:
	 * Sessions and cookies can�t be shared between browsers and computers 
	 * that�s why we need to do this. Setting the active field into 
	 * 1 
	 * means the user has already been logged in.
	 * 
	 */
	function set_active($uname){
		global $mdb;
		$mdb->query("UPDATE users SET Active=1 WHERE Username='$uname'");
	}
	

	/**
	 * Then we create another function which will be called upon user logout.
	 *
	 * This will switch the active value to 0 for the corresponding user:
	 *
	 * @param string $uname        	
	 */
	function set_inactive($uname) {
		global $mdb;
		$mdb->query ( "UPDATE users SET Active=0 WHERE Username='$uname'" );
	}
	
	/**
	 * Then we create another function which will check if the user is
	 * logged in or not.
	 * This will ensure that the user is logged
	 * in only one place. A sort of security feature.
	 *
	 * @param string $uname        	
	 * @return number 1 if positive query
	 */
	function check_active($uname) {
		global $mdb;
		$active = $mdb->query ( "SELECT Username, Active FROM users WHERE Username='$uname' AND Active=1" );
		return $active;
	}
}