<?php
$mysql_user="andes";
$mysql_pass="andes";
$mysql_server="localhost";
$link = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
if (!$link) {
    die('Tidak terhubung dengan data base: ' . mysql_error());
}
mysql_select_db('andes');
