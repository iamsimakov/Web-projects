<style type="text/css">
table {
	border-collapse: collapse;
    table-layout: fixed;
    background: #f0fff0; /* Цвет фона */
    /* width: 400px;  /*    Ширина блока */
    word-wrap: break-word;   /* Перенос слов */ 
    }
.down{
	/* word-wrap: break-word;*/
	/* width: 100;*/
	background: #f0f0f0;
}
</style>

<html>
	<head>
		<title>Перезвон</title>
	</head>
	<body>
		<a href=formadd.html>Добавить запись</a><br>
	</body>
</html>

<?php
date_default_timezone_set('Europe/Moscow');
$mon = date('F');

//создаем БД, если ее не существует
$connection = new mysqli("localhost","root","mysql");
$query = "create database if not exists Perezvon";
$result = $connection->query($query);

//подключаемся к БД 
$connection = new mysqli("localhost","root","mysql","Perezvon");
//$query = "create table if not exists $mon (day VARCHAR(8), time VARCHAR(8), description VARCHAR(150))";
//$result = $connection->query($query);

//$query = "SET NAMES 'utf8'";
//$result = $connection->query($query);

$query = "SELECT * FROM $mon WHERE 1 order by day, time";
$result = $connection->query($query);

if ($result == "") echo "Пустая БД";
else {
// 1 echo '<table class="down" border=1px name="table"  cellspacing="0" cellpadding="5"><tbody>';
$a = 0;
$array = array();  //массив в котором содержится вся таблица
while($row = mysqli_fetch_array($result))
{
	// 2 echo "<tr>";
	
	//echo "Число: ".$row['day']."<br>";
	//echo "Время: ".$row['time']."<br>";
	//echo "Описание: ".$row['description']."<br>";
	
	// 3 echo "<td>".$row['day']."</td>";
	// 4 echo "<td>".$row['time']."</td>";
	// 5 echo "<td>".$row['description']."</td>";
	// 6 echo "</tr>";
		$array[$a] = array(	0 => (int)$row['day'],
							1 => $row['time'],
							2 => $row['description']);
							//2 => preg_replace("/,.+/i", "", $row['description']));

	
		$a++;
}
//  7 echo "</tbody></table>";

$a = 0;
$mas_day = array(); //массив в который будем писать дни без повторов
for ($i = 0; $i < count($array); $i++){
	for ($j = $i+1; $j < count($array); $j++){
		if ($array[$i][0] == $array[$j][0]) break;
		if ($j == count($array)-1){
			$mas_day[$a] = $array[$i][0];
			$a++;
		}
	}
	if ($i == count($array)-1) $mas_day[$a] = $array[$i][0];
}
sort($mas_day); // сортировка

$a = 0;
$mas_time = array(); //массив в который будем писать ВРЕМЯ без повторов
for ($i = 0; $i < count($array); $i++){
	for ($j = $i+1; $j < count($array); $j++){
		if ($array[$i][1] == $array[$j][1]) break;
		if ($j == count($array)-1){
			$mas_time[$a] = $array[$i][1];
			$a++;
		}
	}
	if ($i == count($array)-1) $mas_time[$a] = $array[$i][1];
}

//так как mas_time содержит текст то в этом цикле туда добавляется INT эквивалент времени
//было "23-0 ч" стало (0)"23-0 ч" (1)23 чтобы легче искать  
for ($i = 0; $i < count($mas_time); $i++){
	$mas_time[$i] = array(	0 => $mas_time[$i],
							1 => (int)(substr($mas_time[$i], 0, strpos($mas_time[$i], "-")+1))
							);
}
//упорядочиваем mas_time по возрастанию
for ($i = 0; $i < count($mas_time); $i++){
	for ($j = $i+1; $j < count($mas_time); $j++){
		if ($mas_time[$i][1] > $mas_time[$j][1]){
			$a = $mas_time[$i][1];
			$b = $mas_time[$i][0];
			$mas_time[$i][1] = $mas_time[$j][1];
			$mas_time[$i][0] = $mas_time[$j][0];
			$mas_time[$j][1] = $a;
			$mas_time[$j][0] = $b;
		}
	}
}

$a = (count($mas_day)+1)*80;

echo '<table  border = "1px" width = '.$a.' name="table2"  cellspacing="0" cellpadding="5"><tbody><tr><td class="down"></td>';
//цикл выводит первую строку чисел месяца в порядке возрастания
for ($j = 0; $j < count($mas_day); $j++){
	echo "<td class='down'>".$mas_day[$j]."</td>";
}
echo "</tr>";

foreach ($mas_time as $cur_time){
	echo "<tr><td class='down'>".$cur_time[0]."</td>";
	foreach ($mas_day as $cur_day){
		echo "<td>";
		for ($i = 0; $i<count($array); $i++){
			if ($array[$i][0] == $cur_day && $array[$i][1] == $cur_time[0]) 
				echo $array[$i][2]."<br>";
		}
		
		echo "</td>";
	}
	echo "</tr>";
}

echo "</tbody></table>";
}
?>