<?php
// !php
// developed on [PHP: 5.5.15]XAMPP - Windows 7-32 bit
// class.login.php

/**
 * Next, import the classes which we made earlier, and
 * initialize them by declaring an object:
 */
require_once ('class.user.php');
require_once ('class.sessions.php');
$users = new users ();
$sessions = new sessions ();

/**
 * Then, check if the POST array is not empty.
 * So that the
 * codes that we will put inside will only be executed if
 * the POST array has contents:
 */
if (isset ( $_POST ) && ! empty ( $_POST )) {
	
	/**
	 * Inside of that condition, we then assign data
	 * extracted from the POST array to a variable:
	 *
	 * $uname,
	 * $pword,
	 * $pword
	 *
	 * The passwords that are stored in the database
	 * are hashed, so we need to call the md5 function
	 * or whatever function we used to hash the password
	 * before we submit it to any functions.
	 */
	$uname = $_POST ['username'];
	$pword = md5 ( $_POST ['password'] );
	$ip = $_SERVER ['REMOTE_ADDR'];
	
	/**
	 * We then call the check_user() function from the
	 * user class.
	 * And assign the value which has been
	 * returned to the variable $exist:
	 */
	$exist = $users->check_user ( $uname, $pword, $ip );
	
	/**
	 * Next, we call the user_check() function from the
	 * users class and set the returned value to the
	 * variable $active.
	 * There are only 2 possible
	 * values here, 1 and 0. The function will return 1
	 * if the username specified as an argument has an
	 * active value of 1. Otherwise it returns 0.
	 */
	$active = $users->check_active ( $uname );
	
	/**
	 * We then issue another condition, this will
	 * if the value returned by check_user() function is
	 * equal to 1.
	 * And that the check_active() function
	 * returns a value except 1.
	 */
	if (($exist == 1) && ($active != 1)) {
		
		/**
		 * Inside the condition, we call the
		 * create_session() function from the sessions class:
		 *
		 * What this does is to add the current user into
		 * the session array. It stores both the ip and the
		 * username, so that if somebody tried to access the
		 * page in a different computer with the same username.
		 * Then it won’t be able to view the user page since
		 * the user is already logged in somewhere else.
		 */
		$sessions->create_session ( $uname, $ip );
		
		/**
		 * Then we create a cookie, which stores the current
		 * username and ip address in the local machine.
		 * In
		 * case you don’t know, cookies are stored in the
		 * local machine and sessions are stored in the
		 * server. If you are developing and testing it on
		 * the same machine where you are developing then
		 * there’s really not much difference since your
		 * local machine and server is the same. The only
		 * difference is that the cookie might be stored inside
		 * a folder in the browser. And the session is stored
		 * inside a folder in the web server.
		 *
		 * The cookie below will expire after 15 minutes.
		 * Which means, the user will have to log in every 15
		 * minutes. Just change the value that is being added
		 * to the current time if you want it to be longer.
		 */
		setcookie ( "user", $uname, time () + 900 );
		setcookie ( "ip", $ip, time () + 900 );
		
		/**
		 * Then we call the set_last_login() function from the user class:
		 */
		$users->set_last_login ( $uname );
		
		/**
		 * After that, we just call the set_active() function
		 * from the user class.
		 * This will switch the status of
		 * the user to active or 1.
		 */
		$users->set_active ( $uname );
		
		/**
		 * Lastly, just redirect the page to the actual page
		 * that can only be accessed by users who are logged in:
		 */
		header ( 'Location:userpage.php' );
	} else { // end if exit and active
		/**
		 * Redirect to Login Form again 
		 * is the login was not successful 
		 * 
		 */
		header ( 'Location:class.register.php' );
	}
} //end if POST
