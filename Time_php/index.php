<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
    setInterval(updateInfo, 1000);
 
    function updateInfo()
    {
        console.log('ajax');
        $('#content').load('main.php');
    }
</script> 

<html>
<body>
<div id="content"></div>
</body>
</html>