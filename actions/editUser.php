<?php
include_once "../classes/user.php";

$userID = $_POST['userID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];

$user = new User;
$user->updateUser($userID, $firstName, $lastName, $username);