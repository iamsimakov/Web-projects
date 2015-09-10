<style type="text/css">
table {
    table-layout: fixed;
   width:3000;
}
td {
    word-wrap:break-word;
	width:150;
}
</style>
  
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
<script type="text/javascript" >
var en_txtar = 0;
$(function()	{
	$('td').click(function(e)	{
		//ловим элемент, по которому кликнули
		var t = e.target || e.srcElement;		
		//получаем название тега
		var elm_name = t.tagName.toLowerCase();
		//alert(elm_name);
		//если это textarea - ничего не делаем		
		if (elm_name == "textarea") { return false; }
		
		if (elm_name != "td"){
			if (en_txtar == 1) $('#area1').blur();
		}
		if (elm_name == "td"){
			if (en_txtar == 1) $('#area1').blur();
			en_txtar = 1;
			var val = $(this).html();		
			var code = "<textarea id='area1' name='area1' cols=17 rows=3 wrap=virtual></textarea>";
			$('#area1').focus();
			$('#area1').val(val);
			$(this).empty().append(code);
			
			$('#area1').focus($('#area1').val(val));
			$('#area1').blur(
				function()	{			
					var val = $(this).val();					
					var pos = val.indexOf("  ");
					for (var count = 0; pos != -1; count++){
					val = val.replace(/  /g," ");
					pos = val.indexOf("  ");
					}
					if ((val == "") || (val == " ")) {val="."};
					$(this).parent().empty().html(val);
					en_txtar = 0;
				}
			);		
		}		
	});
});

</script>
<script type="text/javascript" >
$(window).keydown(function(event){
	//ловим событие нажатия клавиши
	if(event.keyCode == 27) {	//если это Enter
		$('#area1').blur();	//снимаем фокус с поля ввода
	}
});
</script>

<script type="text/javascript" >
function send()
{
$('#area1').blur();
var data = $('#edited').html();
 $.ajax({
 type: "POST",
 url: "savedoc.php",
 data: "data="+data,
 success: function(html) {
 $("#edited").append(html);
}
});
alert("Записано");
}
</script>


<html>
<body>

<input type="button" value="Сохранить" id="x" class="button5" onclick="send()" value="Отправить">

<div id="edited">
<?
 require 'table.php';
?>
</div>

 
</body>
</html>