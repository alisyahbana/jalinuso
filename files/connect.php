<?php
$username="root";
$password="";
$DBName="master_datawifi";
    mysql_connect("localhost",$username,$password) or die(mysql_error());
    mysql_select_db($DBName) or die(mysql_error());
?>