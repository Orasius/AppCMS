<html>
	<head>
		<title>Hello</title>
		<style>
			body{
				margin:30px;
				background-color:#F3f1fa;
			}
			.grid{
				width:900px;
				border:1px solid black;
				background-color:#c3c3c3;
			}
			.theader{
				background-color:#bebebe;
				color:#ffffff;
				font-size:17px;
				font-weight:bold;
				text-align:center;
				border:1px;
			}
			
			.hiddenDiv
			{
				display:none;
			}
			.showDiv
			{
				display:block;
			}
			
			#sortable { list-style-type: none; margin: 0; padding: 0; }
			#sortable li { border:1px solid black;margin: 3px 3px 3px 0; padding: 1px; float: left; width: 160px; height: 280px; font-size: 2em; text-align: center; }

			#vertical_sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
			#vertical_sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
			#vertical_sortable li span { position: absolute; margin-left: -1.3em; }
			
			.modalOverlay {
			    position: fixed;
			    width: 100%;
			    height: 100%;
			    top: 0px;
			    left: 0px;
			    background-color: rgba(0,0,0,0.3); /* black semi-transparent */
			    text-align:center;
			}
		</style>

		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.8.20/jquery-ui.min.js" type="text/javascript"></script>


		<script lagnuage="javascript">
		//************************************************************
		// These functions are for handling the Add Page 
		// To choose the page related elements
		//************************************************************
			var soso = 'no';
			function getPageElements(element)
			{
				//alert(element.options[element.selectedIndex].text);
				//if(element.options[element.selectedIndex].text !='List')
					document.getElementById('extra').innerHTML = document.getElementById(element.options[element.selectedIndex].text).innerHTML;
					document.getElementById('pagetypetitle').value = element.options[element.selectedIndex].text;
				//else
				//	document.getElementById('List').className="showDiv";
					//document.getElementById('extralist').innerHTML = document.getElementById(element.options[element.selectedIndex].text).innerHTML;	
				//document.getElementById(element.options[element.selectedIndex].text).className = 'showDiv';
				//document.getElementById('rss');
				//alert(element.options[element.selectedIndex].text);
				if(element.options[element.selectedIndex].text == 'HTML' || element.options[element.selectedIndex].text == 'List')
					loadHTML(element.options[element.selectedIndex].text);
			}
			
			function getPageElementsString(element)
			{
				//alert(element.options[element.selectedIndex].text);
				//if(element.options[element.selectedIndex].text !='List')
					document.getElementById('extra').innerHTML = document.getElementById(element).innerHTML;
					//document.getElementById('pagetypetitle').value = element.options[element.selectedIndex].text;
				//else
				//	document.getElementById('List').className="showDiv";
					//document.getElementById('extralist').innerHTML = document.getElementById(element.options[element.selectedIndex].text).innerHTML;	
				//document.getElementById(element.options[element.selectedIndex].text).className = 'showDiv';
				//document.getElementById('rss');
				//alert(element.options[element.selectedIndex].text);
				if(element == 'HTML' || element == 'List')
					loadHTML(element);
			}
		//***********************************************************************//
		// This function is to reload the nicEditor for Textarea                 //
		// as the text area is dynamically loaded and need to be initiated again //
		//***********************************************************************//	
			function loadHTML(element)
			{
				//alert('And Now ...'+element);
				new nicEditor().panelInstance(element+'content');
			}
		
			function loadAllTextAreas()
			{
				bkLib.onDomLoaded(nicEditors.allTextAreas);
			}
		
		//**************************************************************
		// These functions are for handling adding List Items
		//**************************************************************
		
			function addIt()
			{
				var nicE = new nicEditors.findEditor('Listcontent');
				question = nicE.getContent();
				
				//alert(question);
				$.ajax({
				  type: "POST",
				  url: "addListItem.php",
				  data: { title: document.getElementById('listtitle').value, content: question},
				  success:function(response)
				  {
				  		//$('#listForm')[0].reset();
				  		document.getElementById('listtitle').value = null;
				  		nicE.setContent(null);
						
				  		$('#listResult').html(response);
				  },
				  error:function(response)
				  {
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
			
			function showNavItem(element)
			{
				elementName = element.options[element.selectedIndex].value;
				if(elementName == 'page')
				{
					document.getElementById(elementName + "HiddenDiv").className = 'showDiv';
					document.getElementById("customfunctionHiddenDiv").className = 'hiddenDiv';
				}
				else
				{
					document.getElementById("pageHiddenDiv").className = 'hiddenDiv';
					document.getElementById("customfunctionHiddenDiv").className = 'showDiv';
				}
				
			}
			
			function addButton()
			{
				//alert(question);
				//alert(document.getElementById('buttonType').options[document.getElementById('buttonType').selectedIndex].value);
				//alert(document.getElementById('apppages').options[document.getElementById('apppages').selectedIndex].value);
				//alert('\n'+document.getElementById('buttontitle').value);
				$.ajax({
				  type: "POST",
				  url: "addButton.php",
				  data: { title: document.getElementById('buttontitle').value, buttonType: document.getElementById('buttonType').options[document.getElementById('buttonType').selectedIndex].value,pageid: document.getElementById('apppages').options[document.getElementById('apppages').selectedIndex].value,customfunction:document.getElementById('customFunction').value},
				  success:function(response)
				  {
				  		//$('#navigationForm')[1].reset();
				  		//document.getElementById('listtitle').value = null;
						
				  		$('#navigationResult').html(response);
				  },
				  error:function(response)
				  {
				  	$('#navigationResult').html(response);
				  }
				});
			}
			
			var order;
			$(function() {
				$("#sortable").sortable({
					update:function(){
						order = $(this).sortable('toArray');
						document.getElementById('orderText').value = order;
						//alert(order);
					}
				});
				$("#sortable").disableSelection();
			});
			
			$(function() {
				$("#vertical_sortable").sortable({
					update:function(){
						navorder = $(this).sortable('toArray');
						document.getElementById('navOrder').value = navorder;
						//alert(navorder);
					}
				});
				$("#vertical_sortable").disableSelection();
			});
			
			function deleteGallery(id)
			{
				//alert(order);
				//document.getElementById(id).className = 'hiddenDiv';
				var str = document.getElementById('orderText').value;
				var n = str.replace(id,'');
				//alert(n);
				//alert(id);
				remove(id);
				document.getElementById('orderText').value = n;
				
				
				//alert(document.getElementById(id).name);
			}
			
			function remove(id)
			{
			    return (elem=document.getElementById(id)).parentNode.removeChild(elem);
			}
			
			
			function editNavItem(id)
			{
				document.getElementById('div'+id).className = 'modalOverlay';
			}
			
			function hideNavItem(id)
			{
				//document.getElementById('editArea').innerHTML = document.getElementById('div'+id).innerHTML;
				document.getElementById('title'+id).innerHTML = document.getElementById('editTitle'+id).value;
				document.getElementById('div'+id).className = 'hiddenDiv';
			}
			
			function updateCS(id)
			{
				alert(document.getElementById('custom'+id).value);
			}
		</script>		
		</head>
	<body>
	<h1>Page Template</h1>