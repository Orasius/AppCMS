<html>
    <head>
        <title>Test</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.8.20/jquery-ui.min.js" type="text/javascript"></script>
<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; }
	#sortable li { border:1px solid black;margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 2em; text-align: center; }
	</style>
	<script>
	function getValues()
	{
		$.ajax({
		  type: "POST",
		  url: "googlelatlong.php",
		  data: { Address: document.getElementById('Address').value},
		  success:function(response)
		  {
		  		$('#myForm')[0].reset();
		  		$('#listResult').html(response);
		  		
		  }
		});
	}
	</script>
</head>
<body>
	<h1>Lat Long Values</h1>
<div id="listResult">
	
</div>
<div id="form">
	<form id="myForm">
		<input type="text" name="Address" id="Address" />
		<br />
		<input type="button" value="Get Long Lat" onclick="getValues();">
	</form>
</div>
</body>
<!-- End demo -->

</html>