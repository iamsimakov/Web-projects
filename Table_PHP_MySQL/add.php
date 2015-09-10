<?php
$a = $_POST["need_day"];
$b = $_POST["need_time"];
$c = $_POST["description"];

date_default_timezone_set('Europe/Moscow');
$mon = date('F');

$connection = new mysqli("localhost","root","mysql");
$query = "create database if not exists Perezvon";
$result = $connection->query($query);

$connection = new mysqli("localhost","root","mysql","Perezvon");
$query = "create table if not exists $mon (day VARCHAR(8), time VARCHAR(8), description VARCHAR(150), primary key(description(10)))";
$result = $connection->query($query);

//mysql_query("SET NAMES 'cp1251'")
//$query = "SET NAMES 'utf8'";

$text = preg_replace("|[\s]+|i","",$c);
if ($text != "") {
	$query = "insert $mon(day, time, description) values('$a', '$b', '$c')";
	$result = $connection->query($query);
	header('Refresh: 1; URL=index.php');
	echo "<br>".'Данные записаны вы будете перенаправлены на начальную страницу';
	exit;
}
else 
	{
		header('Refresh: 2; URL=formadd.html');
		echo "<br>".'Данные не обнаружены вы будете перенаправлены на страницу добавления записи';
	}

?>