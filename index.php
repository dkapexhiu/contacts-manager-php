<?php 
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

?>
<html>
<head>
    <title>Form with database</title>
    <style type="text/css">
.header {
	width: 30%;
	margin: 50px auto 0px;
	color: white;
	background: #5F9EA0;
	text-align: center;
	border: 1px solid #B0C4DE;
	border-bottom: none;
	border-radius: 10px 10px 0px 0px;
	padding: 20px;
}
form, .content {
	width: 30%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 10px 10px;
}
.input-group {
	margin: 10px 0px 10px 0px;
}

.input-group label {
	display: block;
	text-align: center;
	margin: 3px;
}
.input-group input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.btn {
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5F9EA0;
	border: none;
	border-radius: 5px;
}
h2{
    color: #5F9EA0;
}
p{
    color:red;
}
h3{
    color:red;
}
.paragraph{
    color:white !important;
}
    </style>
</head>
<body>
    <center>
    <div>
    <h2>Enter new data to the database<br></h2>
    <h3>
    The server is written in PHP.<br>
    The database is in SQL.
    </h3>
    </div>
    <div class="header"> 
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <p class="paragraph">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>
    </div>
    </center>
<form action="insert.php" method="post">
	<center>
    <div class="input-group">
    <label>Name:<br></label>
    <input type="text" name="name" size="30" required><br><br>
    <label>Email:<br></label>
    <input type="text" name="email" size="30" required><br><br>
    <input class="btn" type="submit" value="Send"><br><br>
    <input class="btn" type="reset" value="Cancel"><br>
    </div>
    <h4><a href="table.php">Go to the table with data instead</a></h4>
	</center>
</form>
<center>
<?php  if (isset($_SESSION['username'])) : ?>
    <p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
<?php endif ?>
</center>
</body>
</html>
