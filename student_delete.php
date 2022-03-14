<?php 
require"student_management.php";
deleteStudent($_POST["student_id"]);
header("location:index.php");
?>