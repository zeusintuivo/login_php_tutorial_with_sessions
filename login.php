<?php
// !php
// developed on [PHP: 5.5.15]XAMPP - Windows 7-32 bit
// login.php


/**
 * Building the login form
 * Create a new php file,
 * then paste this code:
 */
function login_form_html() {
	return '
 <form id="form1" name="form1" method="post" action="class.login.php">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" />
  <br />
  <label for="password">Password:</label>
  <input type="text" name="password" id="password" />
  <br />
  <input type="submit" name="login" id="login" value="login" />
<br />
</form>';
}


echo login_form_html ();
