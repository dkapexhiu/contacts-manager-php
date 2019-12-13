<?php include('server.php') ?>

<?php 
$name = FILTER_INPUT(INPUT_POST, 'name');
$email = FILTER_INPUT(INPUT_POST, 'email');

if(!empty($name)){
    if(!empty($email)){
    
        $db = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()){
            die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }else{
            $sql = "INSERT INTO test(name, email) values('$name','$email')";
            if($db->query($sql)){
                header("location: table.php");
            }else{
                echo "Error: ".$sql."<br>".$conn->error;
            }
            $db->close();
        }
    }else{
        echo "Email should not be empty!";
        die();
    }
}else{
    echo "Name should not be empty!";
    die();
}
?>