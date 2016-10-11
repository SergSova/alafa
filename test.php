<?php
	$conn=mysql_connect("db16.freehost.com.ua", "shans2_alafa", "assmadeus1") or die ('I cannot connect to the database because: ' . mysql_error());
    mysql_select_db ("shans2_alafa");
    $sql = "SELECT * FROM `customers_users` WHERE `email`='miripartnery@mail.ru' ";
    $res = mysql_query($sql);
	var_dump($res);

?>