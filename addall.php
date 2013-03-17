<html>

<body>

<script src = "js/jquery-1.8.3.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/jquery-ui-1.9.2.custom.js"></script>
<link rel = "stylesheet" href = "css/bootstrap.css">

<?php

	include_once "classes.php";
	
	$database = new db;
	$database->mssqlconnect();
	$database->mssqlselectdb("atlhoops");
	$database->mssqlquery("SELECT *
						   FROM volunteers
						   WHERE name LIKE '%".$_POST['name']."%'
						   ORDER BY name");
	
	echo "<select multiple = 'multiple' class = 'input-xlarge' size = 18 id = 'sendto'>";
	while($row = mssql_fetch_array($database->results)){
		echo "<option>".$row["name"]."</option>";
	}
	echo "</select>";

?>

</body>

</html>