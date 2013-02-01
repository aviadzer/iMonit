
<html>
<head>
</head>

<body>
<h2>Register Form</h2>
<form ENCTYPE="multipart/form-data" method="post" action="insert.php">
<table border="0" width="60%">
<tr><td width="10%">Name: </td><td><input type="text" name="name" maxlength="15"/></td></tr><br />
<tr><td width="10%">Email: </td><td><input type="text" name="email" maxlength="30"/></td></tr><br />
<tr><td width="10%">Password: </td><td><input type="password" name="password" maxlength="15"/></td></tr><br />
<tr><td width="10%">Confirm Password: </td><td><input type="password" name="cpassword" maxlength="15"/></td></tr>
<input type="hidden" name="MAX_FILE_SIZE" value="10000">
</table>
<p>

Choose your picture:<input type="file" name="upload"><p>
<input type="submit" name="submit" value="register" /><br />
</form>

</body>
</html>