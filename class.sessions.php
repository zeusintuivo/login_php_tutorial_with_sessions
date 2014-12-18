<?php
// !php
// developed on [PHP: 5.5.15]XAMPP - Windows 7-32 bit
// class.session.php

/**
 * Session class
 *
 * Next, lets create a session class. This will contain all the
 * functions related to manipulating the session array.
 *
 * @author zeusintuivo
 *        
 */
class sessions {
	
	/**
	 * Okay, so what we just did is to declare a new session.
	 * Then assigned an array into it, which contains the
	 * username and the ip address.
	 *
	 * @param string $username        	
	 * @param string $ip        	
	 */
	function create_session($username, $ip) {
		$_SESSION ['log_users'] [] = array (
				'username' => $username,
				'ip' => $ip 
		);
	}
	
	/**
	 * Next, we create another function which checks the session
	 * if it contains the username and the ip address of the
	 * current user.
	 * It loops through the session array and if
	 * it finds a record which matches the username and ip,
	 * it returns 1.
	 *
	 * @param string $username        	
	 * @param string $ip        	
	 * @return number 1 for logged in
	 */
	function check_session($username, $ip) {
		foreach ( $_SESSION ['log_users'] as $lu ) {
			
			if (($lu ['username'] == $username) && ($lu ['ip'] == $ip)) {
				return 1;
			}
		}
	}
	
	/**
	 * Lastly, we create a function which logs the user out of
	 * the system.
	 * This one also loops through the session array,
	 * similar to the check_session() function. But this time,
	 * when it finds the username which is equal to the one
	 * specified as an argument. It unsets it from the session
	 * array. I just used the actual index where the username
	 * and ip is stored, so that those will be both unset,
	 * and the actual index will be unset too. Because if you
	 * just unset the username and ip individually. The index
	 * where they are stored is just emptied but still exist.
	 *
	 * @param string $uname        	
	 */
	function unset_session($uname) {
		foreach ( $_SESSION ['log_users'] as $id => $lu ) {
			
			if ($lu ['username'] == $username) {
				unset ( $_SESSION ['log_users'] [$id] );
			}
		}
	}
}
