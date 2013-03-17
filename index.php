<!DOCTYPE html>

<html>

<head>
	<title>Dashboard</title>
</head>

<body>

<?php

	include_once "classes.php";
	
	$database = new db;
	$database->mssqlconnect();
	$database->mssqlselectdb("atlhoops");
	$database->mssqlquery("SELECT *
					       FROM volunteers
						   ORDER BY name");

?>

<script src = "js/bootstrap.js"></script>
<script src = "js/jquery-1.8.3.js"></script>
<script src = "js/jquery-ui-1.9.2.custom.js"></script>

<link rel = "stylesheet" href = "css/bootstrap.css">
<link rel = "stylesheet" href = "bootstrap-responsive">
<link rel = "stylesheet" href = "css/index.css">

<div id = "overflowcontainer">
	<div id = "searchbar">
		<form class = "navbar-search pull-left">
			<input type = "text" class = "input-xlarge search-query" placeholder = "Name" id = "searchphrase">
			<button class = "btn" type = "button" id = "search">Search</button>
		</form>
	</div>
	<div id = "resultsheader">
		<strong>Search Results</strong>
	</div>
	<div id = "results">
		<select multiple = "multiple" class = "input-xlarge" size = 18 id = "selectresults">
		<?php
			while($row = mssql_fetch_array($database->results)){
				echo "<option>".$row["name"]."</option>";
			}
		?>
		</select>
	</div>
	<div id = "add">
		<a class = "btn" href = "#" id = "addclick">Add<i class = "icon-arrow-right"></i></a>
	</div>
	<div id = "addall">
		<a class = "btn" href = "#" id = "addallclick">Add All<i class = "icon-arrow-right"></i></a>
	</div>
	<div id = "remove">
		<a class = "btn" href = "#" id = "removeclick"><i class = "icon-arrow-left"></i>Remove</a>
	</div>
	<div id = "removeall">
		<a class = "btn" href = "#" id = "removeallclick"><i class = "icon-arrow-left"></i>Remove All</a>
	</div>
	<div id = "contactlistheader">
		<strong>Send To</strong>
	</div>
	<div id = "contactlist">
		<select multiple = "multiple" class = "input-xlarge" size = 18 id = "sendto" name = "sendtonames[]">
		</select>
	</div>
	<div id = "messageheader">
		<strong>Message</strong>
	</div>
	<div id = "message">
		<textarea rows = 10 class = "input-xlarge" id = "yourmessage"></textarea>
		<div id = "textoremail">
			<label class = "checkbox input-mini">
				<input type = "checkbox" value = "" id = "text">
				Text
			</label>
			<label class = "checkbox input-mini">
				<input type = "checkbox" value = "" id = "email">
				E-Mail
			</label>
		</div>
		<div id = "submit">
			<button class = "btn" type = "button" id = "submitclick">Send</button>
		</div>
	</div>
</div>

<script>
	
	$(document).ready(function(){
		$("#search").click(function(){
			var name = document.getElementById("searchphrase").value;
			$.post("search.php", {name: name}, function(data){
				$("#results").html(data);
			});
		});
	});
	
	$(document).ready(function(){
		$("#addclick").click(function(){
			var option = document.createElement("option");
			option.text = document.getElementById("selectresults").value;
			document.getElementById("sendto").add(option, null);
		});
	});
	
	$(document).ready(function(){
		$("#addallclick").click(function(){
			var name = document.getElementById("searchphrase").value;
			$.post("addall.php", {name: name}, function(data){
				$("#contactlist").html(data);
			});
		});
	});
	
	$(document).ready(function(){
		$("#removeclick").click(function(){
			var option = document.getElementById("sendto");
			option.remove(option.selectedIndex);
		});
	});	
	
	$(document).ready(function(){
		$("#removeallclick").click(function(){
			var name = document.getElementById("searchphrase").value;
			$.post("removeall.php", {name: name}, function(data){
				$("#contactlist").html(data);
			});
		});
	});
	
	$(document).ready(function(){
		$("#submitclick").click(function(){
			var message = document.getElementById("yourmessage").value;
			var options = new Array();
			var text = document.getElementById("text").checked;
			var email = document.getElementById("email").checked;
			if(text == true && email == false){
				var whattosend = 1;
			}
			else if(email == true && text == false){
				var whattosend = 2;
			}
			else if(email == true && text == true){
				var whattosend = 3;
			}
			$("#sendto > option").each(
				function(i){
					options[i] = $(this).text();
				});
			$.post("send.php", {options: options, message: message, whattosend: whattosend}, function(data){
				alert(data);
			});
		});
	});
	
</script>

</body>

</html>
