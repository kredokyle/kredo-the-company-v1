<?php
include_once "../classes/user.php";

$user = new User();
$user->deleteUser($_GET['userID']);