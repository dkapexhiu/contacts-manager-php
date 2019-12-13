<?php include('server.php') ?>

<?php

function renderForm($id, $name, $email, $error) {

?>

<html>

<head>

<title>Edit</title>

<style type="text/css">
	 input[type=submit] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
	}

	input[type=text] {
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid green;
    border-radius: 4px;
	}
</style>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '') {

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>

<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div style="text-align: center;">

<p>ID:<?php echo $id; ?></p>

Name:<br>
<input type="text" name="name" value="<?php echo $name; ?>"/><br/>

Email:<br>
<input type="text" name="email" value="<?php echo $email; ?>"/><br/>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}

// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit'])) {

// confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id'])) {

// get form data, making sure it is valid
	$id = $_POST['id'];
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$email = mysqli_real_escape_string($db, $_POST['email']);

// check that firstname/lastname fields are both filled in
	if ($name == '' || $email == ''){

// generate error message
		$error = 'ERROR: Please fill in all required fields!';

//error, display form
		renderForm($id, $name, $email, $error);
	}else{

// save the data to the database
		$sql = "UPDATE test SET name='$name', email='$email' WHERE id='$id'";
		if($db->query($sql)){
                header("location: table.php");
            }else{
                echo "Error: ".$sql."<br>".$db->error;
           	}
        $db->close();
	}
 }else{

// if the 'id' isn't valid, display an error
 echo 'Error!';

}

}else{

// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){

// query db
		$id = $_GET['id'];
		$sql = "SELECT * FROM test WHERE id=$id";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

// check that the 'id' matches up with a row in the databse
		if($row){

// get data from db
			$name = $row['name'];
			$email = $row['email'];

// show form
			renderForm($id, $name, $email, '');
		}else{
			echo "No results!";
		}
	}else{
		echo 'Error!';
	}
}

?>