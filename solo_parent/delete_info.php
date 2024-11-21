<?php

include "data_connect.php";

$id = $_GET['id'];

$sql = "DELETE FROM `solo_parent` WHERE id = $id ";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: index_form.php?=Data Deleted Successfully");
}
else{
    echo" Failed " . mysqli_error($conn);
}



?>