<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{title}</title>
<style>
			body{
				margin:0px;
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

			#vertical_sortable { list-style-type: none; margin: 0; padding: 0; }
			#vertical_sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
			#vertical_sortable li span { position: absolute; margin-left: -1.3em; }
			
			.modalOverlay {
			    position: fixed;
			    width: 100%;
			    height: 100%;
			    top: 0px;
			    left: 0px;
			    background-color: rgba(0,0,0,0.7); /* black semi-transparent */
			    text-align:center;
			    padding-top:100px;
			}
			
			
			.navButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #cae3fc;
	-webkit-box-shadow:inset 0px 1px 0px 0px #cae3fc;
	box-shadow:inset 0px 1px 0px 0px #cae3fc;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #4197ee) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #4197ee 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#4197ee');
	background-color:#79bbff;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	border:1px solid #469df5;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:18px;
	font-weight:bold;
	padding:6px 40px;
	text-decoration:none;
	text-shadow:1px 1px 0px #287ace;
	width:150px;
	text-align:center;
}.navButton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4197ee), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #4197ee 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#4197ee', endColorstr='#79bbff');
	background-color:#4197ee;
}.navButton:active {
	position:relative;
	top:1px;
}
		</style>
		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Apple iOS and Android stuff (do not remove) -->
<meta name="apple-mobile-web-app-capable" content="no" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="{base}css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/fluid.css" media="screen" />

<link rel="stylesheet" type="text/css" href="{base}css/mws.style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/icons/16x16.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/icons/24x24.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}css/icons/32x32.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="{base}css/mws.theme.css" media="screen" />


<!-- Demo and Plugin Stylesheets -->
<link rel="stylesheet" type="text/css" href="{base}css/demo.css" media="screen" />

<link rel="stylesheet" type="text/css" href="{base}plugins/colorpicker/colorpicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/imgareaselect/css/imgareaselect-default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/fullcalendar/fullcalendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/fullcalendar/fullcalendar.print.css" media="print" />
<link rel="stylesheet" type="text/css" href="{base}plugins/chosen/chosen.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/prettyphoto/css/prettyPhoto.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/tipsy/tipsy.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/sourcerer/Sourcerer-1.2.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/jgrowl/jquery.jgrowl.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}plugins/spinner/ui.spinner.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{base}jui/css/jquery.ui.all.css" media="screen" />


<!-- JavaScript Plugins -->
<script type="text/javascript" src="{base}js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="{base}js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="{base}js/jquery.placeholder.js"></script>
<script type="text/javascript" src="{base}js/jquery.fileinput.js"></script>


<!-- jQuery-UI Dependent Scripts -->
<script type="text/javascript" src="{base}jui/js/jquery-ui.js"></script>
<script type="text/javascript" src="{base}jui/js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="{base}jui/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="{base}plugins/spinner/ui.spinner.min.js"></script>


<!-- Plugin Scripts -->
<script type="text/javascript" src="{base}plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="{base}plugins/duallistbox/jquery.dualListBox-1.3.min.js"></script>
<script type="text/javascript" src="{base}plugins/jgrowl/jquery.jgrowl-min.js"></script>
<script type="text/javascript" src="{base}plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="{base}plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{base}plugins/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="{base}plugins/prettyphoto/js/jquery.prettyPhoto.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{base}plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="{base}plugins/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="{base}plugins/flot/jquery.flot.stack.min.js"></script>
<script type="text/javascript" src="{base}plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="{base}plugins/colorpicker/colorpicker-min.js"></script>
<script type="text/javascript" src="{base}plugins/tipsy/jquery.tipsy-min.js"></script>
<script type="text/javascript" src="{base}plugins/sourcerer/Sourcerer-1.2-min.js"></script>
<script type="text/javascript" src="{base}plugins/smartwizard/js/jquery.smartWizard-2.0.js"></script>
<script type="text/javascript" src="{base}plugins/validate/jquery.validate-min.js"></script>


<!-- Core Script -->
<script type="text/javascript" src="{base}js/core/mws.js"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
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
				document.getElementById('div'+id).className = 'hiddenDiv';
				document.getElementById('title'+id).innerHTML = document.getElementById('editTitle'+id).value;
			}
			
			function updateCS(id)
			{
				alert(document.getElementById('custom'+id).value);
			}
			
			function toggleItem(id)
			{
				//alert(id);
			 	if(document.getElementById(id).className == 'hiddenDiv')
			 		document.getElementById(id).className = 'showDiv';
			 	else
			 		document.getElementById(id).className = 'hiddenDiv';
			}
		</script>		
</head>

<body>


<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<h1 style="color:#ffffff;">LOGO</h1>
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
        	<!-- Notifications -->
        	<div id="mws-user-notif" class="mws-dropdown-menu">
            	<a href="#" class="mws-i-24 i-alert-2 mws-dropdown-trigger">Notifications</a>
                
                <!-- Unread notification count -->
                <span class="mws-dropdown-notif">2</span>
                
                <!-- Notifications dropdown -->
                <div class="mws-dropdown-box">
                	<div class="mws-dropdown-content">
                        <ul class="mws-notifications">
                        	<li class="read">
                            	<a href="#">
                                    <span class="message">
                                        Message 1
                                    </span>
                                    <span class="time">
                                        Date 1
                                    </span>
                                </a>
                            </li>
                        	<li class="read">
                            	<a href="#">
                                    <span class="message">
                                       	Message 2
                                    </span>
                                    <span class="time">
                                        Date 2
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
	                        <a href="#">View All Notifications</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Messages -->
            <div id="mws-user-message" class="mws-dropdown-menu">
            	<a href="#" class="mws-i-24 i-message mws-dropdown-trigger">Messages</a>
                
                <!-- Unred messages count -->
                <span class="mws-dropdown-notif">3</span>
                
                <!-- Messages dropdown -->
                <div class="mws-dropdown-box">
                	<div class="mws-dropdown-content">
                        <ul class="mws-messages">
                        	<li class="read">
                            	<a href="#">
                                    <span class="sender">Sender</span>
                                    <span class="message">
                                       	Message Brief
                                    </span>
                                    <span class="time">
                                        Date 1
                                    </span>
                                </a>
                            </li>
                        	<li class="read">
                            	<a href="#">
                                    <span class="sender">Sender 2</span>
                                    <span class="message">
                                        Brief 2
                                    </span>
                                    <span class="time">
                                       Date 2
                                    </span>
                                </a>
                            </li>
                        	<li class="unread">
                            	<a href="#">
                                    <span class="sender">Sender 3</span>
                                    <span class="message">
                                        Unread Message
                                    </span>
                                    <span class="time">
                                        Date 3
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
	                        <a href="#">View All Messages</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<!--
            	<div id="mws-user-photo">
                	 <img src="example/profile.jpg" alt="User Photo" />
                </div>
                -->
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {firstname}{lastname}
                    </div>
                    <ul>
                    	<li><a href="#">Profile</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
