
<?php

$mypic = $_FILES['upload']['name'];
$temp = $_FILES['upload']['tmp_name'];
$type = $_FILES['upload']['type'];


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];


if ($name && $email && $password && $cpassword) {

if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {

    if (strlen($password) > 3) {

			if ($password == $cpassword) {

            mysql_connect("localhost", "root", "") or die("We couldn't connect!");
            mysql_select_db("testsite");

            $username = mysql_query("SELECT name FROM users WHERE name='$name'");
            $count = mysql_num_rows($username);
            $remail = mysql_query("SELECT email FROM users WHERE email='$email'");
            $checkemail = mysql_num_rows($remail);

            if ($checkemail != 0) {

                echo "This email is already registered! Please type another email...";
            } else {


                if ($count != 0) {

                    echo "This name is already registered! Please type another name";
                } else {
					
					if(($type=="image/jpeg") || ($type=="image/jpg") || ($type=="image/bmp")){
						
						
						$dir = "profiles/$name/images/";
						mkdir($dir, 0777, true);
						move_uploaded_file($temp, "profiles/$name/images/$mypic");
						echo "This will be you profile picture!<p><img border='1' width='50' height='50' src='profiles/$name/images/$mypic'><p>";
						$passwordmd5 = md5($password);
						mysql_query("INSERT INTO users(name,email,password) VALUES('$name','$email','$passwordmd5')");
						echo "You have succefully registered!<a href='home.php'>Login now!</a>";
					
					} else {
					
						echo "Please load a valid jpeg, jpg or bmp! And size must be less than 10k!";
					
					}
                }
            }
        } else {
            echo "Your passwords don't match!";
        }
    } else {

        echo "Your password is too short! You need to type a password between 4 and 15 charachters!";
    }
	
	}else{
			echo "Please type a valid email!";
	}
	
} else {
    echo "you have to complete the form!";
}


?>