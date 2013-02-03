<?php
session_start();

if($_POST){

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = md5($_POST['password']);


if($_SESSION['email'] && $_SESSION['password']){

	mysql_connect("localhost", "root", "") or die("problem with connection...");
	mysql_select_db("testsite");

	$query = mysql_query("SELECT * FROM users WHERE email='".$_SESSION['email']."'");
	$numrows = mysql_num_rows($query);

	if($numrows != 0){
	
		while($row = mysql_fetch_assoc($query)){
		
			$dbname = $row['email'];
			$dbpassword = $row['password'];

		}
		if($_SESSION['email']==$dbname){
			if($_SESSION['password']==$dbpassword){
			
				if(($_POST['remember']) == 'on'){
					$expire = time()+86400;
					setcookie('testsite', $_POST['email'], $expire);
				}
				header("location:enter.php");
			
			}else{
				echo "Your password is incorrect!";
			}
		
		}else{
			echo "Your email is incorrect!";
		}
	
	}else{
		echo "This email is not registered!";	
	}
	
}else{
	echo "You have to type a email and password!";
}
}else{

echo "Access denied!";
exit;
}
?>