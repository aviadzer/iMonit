
<?php

	mysql_connect("localhost", "root", "") or die("Problems...");
	mysql_select_db("testsite");

	$per_page = 6;
	$pages_query = mysql_query("SELECT COUNT('id') FROM users");
	$pages = ceil(mysql_result($pages_query, 0) / $per_page);
	
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_page;
	
	$query = mysql_query("SELECT name FROM users LIMIT $start, $per_page");
	
	while($query_row = mysql_fetch_assoc($query)){
		echo '<p>', $query_row['name'] ,'</p>';
	}
	
	$prev = $page - 1;
	$next = $page + 1;
	
	if(!($page<=1)){
		echo "<a href='pagination.php?page=$prev'>Prev</a> ";
	}

	if($pages>=1 && $page<=$pages){
	
		for($x=1;$x<=$pages;$x++){
			echo ($x == $page) ? '<strong><a href="?page='.$x.'">'.$x.'</a></strong> ' : '<a href="?page='.$x.'">'.$x.'</a> ';
		
		}
	
	}
	
	if(!($page>=$pages)){
		echo "<a href='pagination.php?page=$next'>Next</a>";
	}
	
	
?>