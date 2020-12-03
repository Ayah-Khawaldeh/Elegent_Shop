<?php
include('includs/connection.php');

$query = "delete from user where user_id = {$_GET['id']}";

mysqli_query($conn, $query);

header("location:manage_user.php");

?>