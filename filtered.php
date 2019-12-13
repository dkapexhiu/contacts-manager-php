<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns using concat mysql function
    $query = "SELECT * FROM `test` WHERE CONCAT(`id`, `name`, `email`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `test`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $db = mysqli_connect("localhost:3306", "root", "anno2017", "form");
    $filter_Result = mysqli_query($db, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Filtered table</title>
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
	</style>
    </head>
    <body>
        <table style="width: 100%">
            <tr>
            <th style="width: 20%;">ID</th>
		    <th style="width: 20%;">Name</th>
		    <th style="width: 20%;">Email</th>
		    <th style="width: 20%;">Edit</th>
		    <th style="width: 20%;">Delete</th>
            </tr>

            <?php 
            while($row = mysqli_fetch_array($search_result)){
                echo "<tr>";
                echo '<td>'.$row["id"].'</td>';
                echo '<td>'.$row["name"].'</td>';
                echo '<td>'.$row["email"].'</td>';
                echo '<td><a href="edit.php?id='.$row["id"].'">Edit</a></td>';
                echo '<td><a href="delete.php?id='.$row["id"].'">Delete</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
    <a href="table.php">Return back to the table</a>
    </body>
</html>