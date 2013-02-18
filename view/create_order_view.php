
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
</head>
<body>
 

 


<!-- Login form -->
<div id="centered">
<form method='post' action='../controller/home_controller.php'>

<!--  Login table -->
<table border='1' width='25%'>
<p>Date: <input type="text" id="datepicker" /></p>
<tr><td>Email: </td><td><input type='text' name='email'/></td></tr><br />
<tr><td>Password: </td><td><input type='password' name='password'/></td></tr><br />
<tr><td>Remember me?: </td><td><input type='checkbox' name='remember'/></td></tr><br />
</table>
<p><input type='submit' value='login' /><p>
</form>

</div>
</body>