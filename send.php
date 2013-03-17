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
	$database->mssqlquery("TRUNCATE TABLE recipients");
	
	$addrecipients = "INSERT INTO recipients (row_number, name, email, phone) ";
	$options = $_POST["options"];
	$count = 1;
	foreach($options as $x){
		$database->mssqlquery("SELECT * 
							   FROM volunteers
							   WHERE name = '$x'");
		while($row = mssql_fetch_array($database->results)){
			$name = $row["name"];
			$email = $row["email"];
			$phone = $row["phone"];
			if($count == 1){
				$addrecipients = $addrecipients."VALUES ($count, '$name', '$email', '$phone')";
			}
			else{
				$addrecipients = $addrecipients.", ('$count', '$name', '$email', '$phone')";
			}
			$count = $count + 1;
		}
	}
	$database->mssqlquery($addrecipients);
	$database->mssqlquery("TRUNCATE TABLE message");
	$database->mssqlquery("INSERT INTO message (text)
						   VALUES ('".$_POST["message"]."')");
	if($_POST["whattosend"] == 1){
		$database->mssqlquery("exec dbo.sendtext");
	}
	elseif($_POST["whattosend"] == 2){
		$database->mssqlquery("exec dbo.sendemail");
	}
	elseif($_POST["whattosend"] == 3){
		$database->mssqlquery("exec dbo.sendemail");
		$database->mssqlquery("exec dbo.sendtext");
	}	
	
?>

</body>

</html>