<?php
include "db.php";
$prof_id = $_GET['prof_id'];
$conn->query("DELETE FROM professors WHERE prof_id=$prof_id");
header("Location: professors.php");
?>