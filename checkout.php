<?php
header("content-type:text/html;charset=utf-8");

// unset ($_SESSION["name"]);
// session_destroy();
session_start();
session_unset();

header("location:http://localhost/mymessage/index.php");









