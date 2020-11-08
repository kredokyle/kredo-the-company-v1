<?php
include_once "../classes/user.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$origin = $_POST['btnRegister'];

$user = new User;
$user->createUser($firstName, $lastName, $username, $password, $origin);