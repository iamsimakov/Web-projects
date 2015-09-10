<html>
<head>
<title>Форма калькулятора</title>
</head>

<body>
<form method="post" action="calculate.php">

<p>Значение 1:
<input type="text" name="a" size=10></p>
<p>Значение 2:
<input type="text" name="b" size=10></p>

<p>Действия:<br>
<input type="radio" name="calc" value="сложить">сложить<br>
<input type="radio" name="calc" value="вычесть">вычесть<br>
<input type="radio" name="calc" value="умножить">умножить<br>
<input type="radio" name="calc" value="разделить">разделить<br>
</p>

<p><input type="submit" name="submit" value="Вычислить"></p>

</form>
<form action="phpinfo.php">
<input type="submit" value="Вывести информацию">
</form>

</body>
</html>