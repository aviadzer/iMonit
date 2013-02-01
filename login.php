<?php
session_start();

if($_POST){

$_SESSION['name'] = $_POST['name'];
$_SESSION['password'] = md5($_POST['password']);


if($_SESSION['name'] && $_SESSION['password']){

	mysql_connect("localhost", "root", "") or die("problem with connection...");
	mysql_select_db("testsite");

	$query = mysql_query("SELECT * FROM users WHERE name='".$_SESSION['name']."'");
	$numrows = mysql_num_rows($query);

	if($numrows != 0){
	
		while($row = mysql_fetch_assoc($query)){
		
			$dbname = $row['name'];
			$dbpassword = $row['password'];

		}
		if($_SESSION['name']==$dbname){
			if($_SESSION['password']==$dbpassword){
			
				if(($_POST['remember']) == 'on'){
					$expire = time()+86400;
					setcookie('testsite', $_POST['name'], $expire);
				}
				header("location:enter.php");
			
			}else{
				echo "Your password is incorrect!";
			}
		
		}else{
			echo "Your name is incorrect!";
		}
	
	}else{
		echo "This name is not registered!";	
	}
	
}else{
	echo "You have to type a name and password!";
}
}else{

echo "Access denied!";
exit;
}
?>