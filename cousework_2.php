<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cousework_2 = "localhost";
$database_cousework_2 = "coursework_2";
$username_cousework_2 = "root";
$password_cousework_2 = "";
$cousework_2 = mysql_pconnect($hostname_cousework_2, $username_cousework_2, $password_cousework_2) or trigger_error(mysql_error(),E_USER_ERROR); 
?>