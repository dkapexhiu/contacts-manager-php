<?php

require('server.php');

$rsent = ""; 

//This code runs if the form has been submitted
if (isset($_POST['submit']))
{

// check for valid email address
$email = $_POST['remail'];
$error = array();

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $error[] = 'Please enter a valid email address';
}

// checks if the username is in use
$query = "SELECT email FROM users WHERE email = '$email'";
$check1 = $db->query($query);
$check2 = mysqli_num_rows($check1);

//if the name exists it gives an error
if ($check2 == 0) {
$error[] = 'Sorry, we cannot find your account details please try another email address.';
}

// if no errors then carry on
if (!$error) {
$query = "SELECT username FROM users WHERE email = '$email' ";
$results = $db->query($query);
$r = $results->fetch_assoc();

//create a new random password
$password = substr(md5(uniqid(rand(),1)),3,10);
$pass = md5($password); //encrypted version for database entry

//send email
$to = "$email";
$subject = "Account Details Recovery";
$body = "Hi $r[username], \nYou or someone else have requested your account details. Here is your account information please keep this as you may need this at a later stage. \nYour username is $r[username], \nyour password is $password. \nRegards Site Admin";
$additionalheaders = "From: <daniel.kapexhiu@gmail.com>";
mail($to, $subject, $body, $additionalheaders);

//update database
$sql = "UPDATE users SET password='$pass' WHERE email = '$email'";
$db->query($sql);
$rsent = true;

}// close errors

//show any errors
if (!empty($error))
{
        $i = 0;
        while ($i < count($error)){
        echo "<div class='msg-error'>".$error[$i]."</div>";
        $i ++;}
}// close if empty errors

if ($rsent == true){
    echo "<p>You have been sent an email with your account details to $email</p><br>";
    } else {
    echo "<p>Please enter your e-mail address. You will receive a new password via e-mail.</p><br>";
    }
}
?>

<style>
p {
	display: block;
	text-align: left;
	margin: 3px;
}
#email {
	height: 30px;
	width: 50%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
#btn {
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5F9EA0;
	border: none;
	border-radius: 5px;
}
</style>

<html>
<head>Reset account</head>
<body>
<p>Enter the email in the form and the username and the password will be sent to you by email</p><br>
<form action="" method="post">
<p>Email Address:</p>
<input type="text" id="email" name="remail" size="50" maxlength="255">
<input type="submit" id="btn" name="submit" value="Get New Password">
</form>
<p>Return back to <a href="login.php">Login page</a></p>
</body>
</html>