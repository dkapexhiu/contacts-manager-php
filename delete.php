<?php include('server.php') ?>

<?php

// check if the 'id' variable is set in URL, and check that it is valid

if (isset($_GET['id']) && is_numeric($_GET['id'])){

// get id value

$id = $_GET['id'];

// delete the entry

$sql = "DELETE FROM test WHERE id=$id";

if($db->query($sql)){
    header("location: table.php");
}else{
    echo "Error: ".$sql."<br>".$conn->error;
}
$db->close();

}else{

header("Location: table.php");

}

?>