<?php

$User='root';
$password='';
$database='lmdatabase';

$link = new mysqli('localhost', $User, $password, $database) or die("Unable to Connect");
//This should make a connection to the database, with the help of Ken Swartwout at 
//https://www.youtube.com/watch?v=ueWpNe0PG34&t=140s&ab_channel=KenSwartwout
?>
