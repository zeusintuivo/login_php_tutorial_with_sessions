<?php
// !php
// developed on [PHP: 5.5.15] XAMPP - Windows 7-32 bit
// register.php
// 2:07:35 PM
// Dec 17, 2014
// zeusintuivo

/**
 */
/**
 * Add a register button
 */
function register_button_html() {
	return '
 <form id="form1" name="form1" method="post" action="class.register.php">
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

echo register_button_html ();