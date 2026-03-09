<?php
session_start();
session_destroy();                          //بمسح كل بيانات الجلسة 
header("Location: index.php");
?>
