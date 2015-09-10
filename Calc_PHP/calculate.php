<?
$a = $_POST["a"];
$b = $_POST["b"];
$calc = $_POST["calc"];
if (($a == "") || ($b == "") || ($calc== "")) {
header ("location:index.php");
exit;
}
if ($calc == "сложить") {
	$result = $a + $b;
	}
	else if ($calc == "вычесть"){
	$result = $a - $b;
	}
	else if ($calc == "умножить"){
	$result = $a * $b;
	}
	else if ($calc == "разделить"){
	$result = $a / $b;
	}
?>
<html>

<head>
<title>Результат вычисления</title>
</head>

<body>
<p>Результат вычисления равен: <? echo "$result"; ?></p>
</body>
</html>



