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
	var order;
	$(function() {
		$( "#sortable" ).sortable({
			update:function(){
				order = $(this).sortable('toArray');
				document.getElementById('orderText').value = order;
				//alert(order);
			}
		});
		$( "#sortable" ).disableSelection();
	});
	
	function getOrder()
	{
		alert(order);	
	}
	</script>
</head>
<body>

<ul id="sortable">
	<li id="item1">Item 1</li>
	<li id="item2">Item 2</li>
	<li id="item3">Item 3</li>
	<li id="item4">Item 4</li>
	<li id="item5">Item 5</li>
	<li id="item6">Item 6</li>
	<li id="item7">Item 7</li>
</ul>
<div style="position:absolute;top:200px;">
	
	<br />
<hr>
<input type="button" value="checkOrder" onclick="getOrder();" />

<input type="text" name="order" size="50" id="orderText" />
</div>
</body>
<!-- End demo -->

</html>