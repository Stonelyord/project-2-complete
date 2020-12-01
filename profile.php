<?php

session_start();
include_once("config.php");

echo "Welcome " .$_SESSION['email'];

echo "<a href='logout.php'> Logout, <a/>";



echo "<a href='login1.html'> Reset <a/>";