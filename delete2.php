
<?php

mysql_connect("localhost", "root", "") or die("problem with connection...");

mysql_select_db("testsite");

$result=mysql_query("DELETE FROM users WHERE id='".$_REQUEST['id']."'");

echo "The user has been deleted succesfully!";

mysql_close();

include('links.php');

?>