<?php 
session_start();
$_SESSION['randomfile'] = "helloworld.txt";

?>
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
	function addIt()
	{
		$.ajax({
		  type: "POST",
		  url: "addListItem.php",
		  data: { title: document.getElementById('title').value, content: document.getElementById('content').value},
		  success:function(response)
		  {
		  		$('#myForm')[0].reset();
		  		$('#listResult').html(response);
		  		
		  }
		});
	}
	function saveList()
	{
		$.ajax({
		  type: "POST",
		  url: "saveList.php",
		  success:function(response)
		  {
		  		$('#jsonDiv').html(response);
		  		
		  }
		});
	}
	</script>
</head>
<body>
	<h1>List View</h1>
<div id="listResult">
	
</div>
<div id="form">
	<form id="myForm">
		<input type="text" name="title" id="title" />
		<br />
		<textarea name="content" cols="30" rows="20" id="content"></textarea>
		<br />
		<input type="button" value="Add" onclick="addIt();">
	</form>
</div>
<hr>
<input type="button" value="Save" onclick="saveList();">

<div id="jsonDiv">
	<h1>Final Result</h1>
</div>
</body>
<!-- End demo -->

</html>