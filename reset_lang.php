<?php
session_start();

unset($_SESSION['lang']);

header("Location: welcome.php");
exit();