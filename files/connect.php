<?php
$username="bimbelon_indtlco";
$password="jalinusoindotelco";
$DBName="bimbelon_jalinuso";
    mysql_connect("localhost",$username,$password) or die(mysql_error());
    mysql_select_db($DBName) or die(mysql_error());
?>