<?php
session_start();

if(isset($_POST['submit'])){

$mypic = $_FILES['newupload']['name'];
$temp = $_FILES['newupload']['tmp_name'];
$type = $_FILES['newupload']['type'];

$id = $_REQUEST['id'];
$newname = $_REQUEST['newname'];
$newemail = $_REQUEST['newemail'];
$newpassword = $_REQUEST['newpassword'];

if($newname && $newemail && $newpassword){

if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $newemail)){
		
		if(strlen($newpassword)>4){
		
				mysql_connect("localhost", "root", "") or die("Problems with connection!");
				mysql_select_db("testsite");

				mysql_query("UPDATE users SET name='$newname', email='$newemail' WHERE id='$id'");
				$md5 = md5($newpassword);
				mysql_query("UPDATE users SET password='$md5' WHERE id='$id'");
			
			if(($type=="image/jpeg") || ($type=="image/jpg") || ($type=="image/bmp")){
			
				$dir = "profiles/".$_SESSION['name']."/images";
				$files = 0;
				$handle = opendir($dir);
				
					while(($file = readdir($handle)) != FALSE){
					
						if($file!="."&&$file!=".."&&$file!="Thumbs.db"){
							unlink($dir."/".$file);
							$files++;
						}
					
					}
					
					closedir($handle);
					sleep(1);
					rename("profiles/".$_SESSION['name']."", "profiles/$newname");
					move_uploaded_file($temp, "profiles/$newname/images/$mypic");
					
					echo "You values have been updated succesfully!";
					header("Refresh:2; url=logout.php");
			
			}else{
			
				echo "The picture has to be a jpeg, jpg o bmp file and have less than 10kb!";
			
			}

}else{

	echo "The password needs to be larger than 4 characters!";
}

}else{

echo "Please type a valid email!";

}

}else{

echo "Please complete the form!";

}

}else{

	echo "Access not allowed!";
	
}

?>