<?PHP
session_start();

include "config.php";
include "functions/functions.php";

$body='<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Download Statistics</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px; "></div>
                    	</div>
                    </div>
                </div>';

$body.="<script language='javascript'>
	var line1 = [['2012-04-23',2],['2012-04-24',1],['2012-04-25',1],['2012-04-26',3],['2012-04-27',2],['2012-04-30',9],['2012-05-01',8],['2012-05-02',1],['2012-05-03',1],['2012-05-08',1]];
    var line2 = [['2012-04-27',2],['2012-04-28',12],['2012-04-29',7],['2012-04-30',43],['2012-05-01',25],['2012-05-02',6],['2012-05-03',1],['2012-05-04',1],['2012-05-07',1],['2012-05-08',1],['2012-05-10',2]];
  var plot1 = $.jqplot('mws-line-chart', [line1,line2], {
      title:'Application Download Statistics',
      
      series:[
      			{color:'#11ff11',label:'Android'},
      			{color:'#4901ff',label:'iPhone'}	
      		],
      legend: {
            show: true
        },
      axes:{
        xaxis:{
          label: 'Time Line',
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%b&nbsp;%#d'
          } 
        },
        yaxis:{
          label:'Downloads',
          min:0,
          tickOptions:{
            formatString:'%i'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: false
      }
  });
  </script>";
                
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Chart - Stats';
$themeValues['content'] = $body;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
//var_dump($_SESSION['appLinks']);
themeIt($themeValues);


?>