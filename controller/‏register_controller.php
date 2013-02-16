
<?php

if(isset($_COOKIE['imonit']))
{
	header('Location: enter.php');
}
else
{
	include("../view/header_view.php");
	include("../view/þþregister_view.php");
	include("../view/footer_view.php");
}
?>