<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Nodal = "localhost";
$database_Nodal = "7ltv";
$username_Nodal = "root";
$password_Nodal = "root";
$Nodal = mysql_pconnect($hostname_Nodal, $username_Nodal, $password_Nodal) or trigger_error(mysql_error(),E_USER_ERROR); 
?>