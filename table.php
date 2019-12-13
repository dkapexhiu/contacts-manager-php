
<html>
<head>
	<title>Table</title>
	<style type="text/css">
	table {
	border-collapse: collapse;
	color: blue;
	font-family: monospace;
	font-size: 25px;
	text-align: left;
	}

	th {
	background-color: #588c7e;
	color: white;
	width: 100%;
	}

	tr:nth-child(even){
	background-color: #f2f2f2;
	}
	#filter-input{
	width:50%;
	}
	#button{
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5F9EA0;
	border: none;
	border-radius: 5px;
	}
	h2{
	color: blue;
	}
	</style>
</head>
<body>
<h2>This is the table with all the results from the database</h2>
<form action="filtered.php" method="post">
<input id="filter-input" type="text" name="valueToSearch" placeholder="Enter the value to search"><br><br>
<input id="button" type="submit" name="search" value="Filter"><br><br>
</form>
<table style="width: 100%">
	<tr>
		<th style="width: 20%;">ID</th>
		<th style="width: 20%;">Name</th>
		<th style="width: 20%;">Email</th>
		<th style="width: 20%;">Edit</th>
		<th style="width: 20%;">Delete</th>
	</tr>

	<?php require('server.php') ?> 

	<?php 
	
	if($db->connect_error){
		die("Connection failed:".$db->connect_error);
	}

	$sql = "SELECT id, name, email FROM test";
	$result = $db->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "<tr>";
			echo '<td>'.$row["id"].'</td>';
			echo '<td>'.$row["name"].'</td>';
			echo '<td>'.$row["email"].'</td>';
			echo '<td><a href="edit.php?id='.$row["id"].'">Edit</a></td>';
			echo '<td><a href="delete.php?id='.$row["id"].'">Delete</a></td>';
			echo "</tr>";
		}
		echo "</table>";
	}else{
		echo "No results";
	}
	$db->close();
	
	?>

<h4><a href="index.php">Insert a new record instead</a></h4>
</body>
</html>