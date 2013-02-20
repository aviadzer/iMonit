<?php

//require_once('../lib/main.php');

session_start(); // start the session

// include some stuff....
include('db.inc.php');	// database connection
include('../model/user.php');		// user class definition

// initialize some variables....
$error_messages=array();
$login_ok=false;

// check for serialized user object in the session
if(isset($_SESSION['suo'])) {
	$user=unserialize($_SESSION['suo']);
} else {
	// new user object
	$user=new user();
}

// Validate and handle user input
if(count($_POST)>0) { 								// someone is trying to login or register
	if($_POST['email']!='') { 						// someone is trying to login
		$user->email=$_POST['email']; 				// set username
		$user->remember=$_POST['email'];			// remember me?
		if(!$user->login()) { 						// attempt a login
			$error_messages[]=$user->last_error;
		}
		else {
			$_SESSION['suo']=serialize($user);				// store the user object in the session
			$login_ok=true;
			//$redirect = header( "Location: view/settings.php" ); // Login successful --> redirect to seeting page
			//echo $redirect;
		}
	} 
}

if($login_ok == false) {
?>

<!-- User NOT Logged IN -->


<!-- Login form -->
<div id="">
<!--  Login table 
<table border='1' width='25%'>
<tr><td>Email: </td><td><input type='text' name='email'/></td></tr><br />
<tr><td>Password: </td><td><input type='password' name='password'/></td></tr><br />
<tr><td>Remember me?: </td><td><input type='checkbox' name='remember'/></td></tr><br />

</table>
<p><input type='submit' value='login' /><p>
-->
<form method='post' action='../controller/home_controller.php'>
		<div data-role="page" id="page1">
            <div data-role="content">
                <input type="submit" data-theme="a" value="Login" />
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput2">
                            User Name
                        </label>
                        <input name="email" id="textinput2" placeholder="" value="" type="email" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput1">
                            Password
                        </label>
                        <input name="password" id="textinput1" placeholder="" value="" type="password" />
                    </fieldset>
                </div>
				<div id="checkboxes1" data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-type="vertical">
                        <legend>
                            Remember me?
                        </legend>
                        <input id="checkbox1" name="remember" type="checkbox" />
                        <label for="checkbox1">                          
                        </label>
                    </fieldset>
                </div>
				<a data-role="button" data-theme="a" href="../view/register_form.php">
				Register
				</a>
            </div>
        </div>
</form>
<?php 

	// output login error messages if there are any
	$error = '';
	foreach($error_messages as $error_message) {
		$error .= $error_message . ' ';
	}
	
	echo $error; 
?>

<!-- Link to Register file
<a href='../view/register_form.php'>Register?</a>
-->
<!-- User Logged IN -->
<?php
}
else {
?>
<form action="../controller/settings_controller.php" data-ajax="false">
            <div data-role="page" id="page2">
			<h2>
                Welcome <?php $user->email ?> <br>
				You have succefully Login!...Go to <a href='../controller/settings_controller.php'>Settings Page</a>";
            </h2>
			</div>
        </form>
//echo "Welcome: ", $user->email, "\n";
//echo "You have succefully Login!...Go to <a href='../controller/settings_controller.php'>Settings Page</a>";
<?php
}
?>

</div>
</html>