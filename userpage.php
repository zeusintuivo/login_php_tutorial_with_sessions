<?php
// !php
// developed on [PHP: 5.5.15] XAMPP - Windows 7-32 bit
// userpage.php
// 12:44:07 PM
// Dec 17, 2014
// zeusintuivo

/**
 * Userpage
 *
 * Next, create another php file. Name it to userpage.php
 * or anything similar.
 * Import the session class again, then declare
 * an object of it:
 */
require_once ('class.sessions.php');
$sessions = new sessions ();

/**
 * Then check if the cookie that we set upon log in exists.
 * Then if those
 * values exist, it assigns them to a variable:
 */
if (isset ( $_COOKIE ) && ! empty ( $_COOKIE ['user'] ) && ($_COOKIE ['ip'])) {
	$username = $_COOKIE ['user'];
	$ip = $_COOKIE ['ip'];
} /**
 * If it doesn�t exist, then just put an else statement
 * which will redirect the page into the login page:
 */
else {
	header ( 'Location:login.php' );
}

/**
 * Then we call the check_session() function from
 * the sessions class.
 * And assign the returned value
 * into the $active variable:
 */
$active = $sessions->check_session ( $username, $ip );

/**
 * Create another condition which checks if the
 * $active has a value of 1:
 * 1 Means logged in
 */
if ($active == 1) {
	/**
	 * First, let�s do the usual thing, greeting 
	 * the user who is logged in:
	 */
	echo 'userpage';
	echo '<hr/>';
	echo 'Hi! '. $username;
	
	/**
	 * Then create a link which logouts the user:
	 */
	echo '<a href="userpage.php?logout=1&user='.$username.'">Logout</a>';
	
	/**
	 * The code below is then executed if the user clicks on the logout link:
	 * 
	 * On the 2nd line, we just call the unset_session() function inside the 
	 * sessions class. We just assigned the username fetched from 
	 * the $_COOKIE[�user�] variable.
	 * 3rd and 4th line, we unset the user and ip cookie. 
	 *    That is by setting the cookie expiration date in a time in the past. 
	 *    I couldn�t think of a number so I just put 999999.
	 * 5th line, we just switch back the value of the active field for the 
	 *    corresponding user. This means that the user is already logged out 
	 *    or inactive.
	 *    
	 * 6th line, we just redirect to the login.php
	 */
	if(!empty($_GET['logout'])){
		$sessions->unset_session($username);
		setcookie("user", "", time()-9999999);
		setcookie("ip", "", time()-9999999);
	
		$users->set_inactive($username);
		header('Location:login.php');
	}
	
	/** 
	 * Conclusion
	 * That�s it for this tutorial. The codes above are not in any way 
	 * optimized or is the best way to do things. I will suggest that 
	 * you don�t only use the ip address , username and password to 
	 * authenticate the user. You might as well generate a unique string 
	 * of characters and place it in the session as well.
	 * 
	 * FROM http://kyokasuigetsu25.wordpress.com/2011/05/12/php-login-system-for-multiple-users/
	 */
}

/**
 * Everything that is not supposed to be accessed by 
 * users who are not logged in goes inside of the 
 * condition below.
 * != 1 Means NOT LOGGED in
 *  
 */
if ($active != 1) {

}