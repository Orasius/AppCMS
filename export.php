<?PHP
session_start();
include "../config.php";
include "../functions/functions.php";

$id = $_GET['id'];

//$DBC->query = "SELECT t1.title AS title,t1.xtype AS xtype, t1.pagedata AS pagedata, t2.title AS pagetype FROM pages AS t1 INNER JOIN pagestype AS t2 ON t1.pagetype = t2.id AND t1.appid = '".$id."' ";

//$result = $DBC->fetchAssos($DBC->execute());
$DBC->query = "SELECT appid,apptitle FROM apps WHERE id='".$id."'";
$appName = $DBC->fetch($DBC->execute());
$result = $DBC->getAppPages($id);
//print_r($result);

$path = "../exported/";
if(!is_dir($path.$appName['appid']))
{
	mkdir($path.$appName['appid'],0777);
	mkdir($path.$appName['appid']."/view/",0777);
	mkdir($path.$appName['appid']."/store/",0777);
	mkdir($path.$appName['appid']."/model/",0777);	
	mkdir($path.$appName['appid']."/controller/",0777);
}

$views  = "";
$models = "";
$controllers = "";
$stores = "";
$vcomma = "";
$mcomma = "";
$scomma = "";
$ccomma = "";
for($i = 0; $i< count($result['title']); $i++)
{
	$myArray['pagetitle'] = $result['title'][$i];
	$myArray['xtype']     = $result['xtype'][$i];
	$myArray['appname']   = str_replace(" ","",$appName['apptitle']);
	$myArray['pagename']  = str_replace(" ", "", $result['title'][$i]);
	$myArray['localfile'] = "name.js";
	//echo $result['title'][$i]."<br />";
	
	$viewTemplateFile = "../templates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".view";
	$storeTemplateFile= "../templates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".store";
	$modelTemplateFile= "../templates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".model";
	$controllerTemplateFile = "../templates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".controller";
	//echo $result['pagetype'][$i];
	switch ($result['pagetype'][$i]) {
		case 'HTML':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$viewTemplate = file_get_contents($viewTemplateFile);
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				//echo nl2br($viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
		case 'Gallery':
		
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				
				$viewTemplate = file_get_contents($viewTemplateFile);
				
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
				break;
		case 'List':
		case 'RSS':
				$dynamicFilesName[] = $myArray['pagename'];
				$listData = html_entity_decode($result['pagedata'][$i]);
				$dynamicFilesData[] = str_replace("\'","'",$listData);
				$viewTemplate = file_get_contents($viewTemplateFile);
				$storeTemplate= file_get_contents($storeTemplateFile);
				$modelTemplate= file_get_contents($modelTemplateFile);
				$controllerTemplate= file_get_contents($controllerTemplateFile);
				
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				
				$storeTemplate = exportTemplateParse($myArray,$storeTemplate);
				file_put_contents($path.$appName['appid']."/store/".ucfirst($myArray['pagename']).".js", $storeTemplate);
				
				$modelTemplate = exportTemplateParse($myArray,$modelTemplate);
				file_put_contents($path.$appName['appid']."/model/".ucfirst($myArray['pagename']).".js", $modelTemplate);
				
				$controllerTemplate = exportTemplateParse($myArray,$controllerTemplate);
				file_put_contents($path.$appName['appid']."/controller/".ucfirst($myArray['pagename']).".js", $controllerTemplate);
				
				
				$views.=$vcomma."'".$myArray['pagename']."'";
				$models.=$mcomma."'".$myArray['pagename']."'";
				$stores.=$scomma."'".$myArray['pagename']."'";
				$controllers.=$ccomma."'".$myArray['pagename']."'";
				$vcomma = ",";
				$mcomma = ",";
				$scomma = ",";
				$ccomma = ",";
				
			break;
		case 'Map':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$pagedata = $result['pagedata'][$i];
				$pageDataArray = explode(",", $pagedata);
				$myArray['latitude'] = $pageDataArray[0];
				$myArray['longitude']= $pageDataArray[1];
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
		case 'Audio':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$myArray['audiourl'] = $result['pagedata'][$i];
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
		case 'Video':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$pagedata = $result['pagedata'][$i];
				$pageDataArray = explode(",", $pagedata);
				$myArray['videourl'] = $pageDataArray[0];
				$myArray['videoimage']= $pageDataArray[1];
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
			
		case 'Navigation':
			
				$dynamicFilesName[] = $myArray['pagename'];
				//$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				
				$customFunctionButton = "
				{
                       xtype: 'button',
                       text: '{buttontitle}',
                       //ui: 'pinky-round',
                       handler: function(){
                       	{customfunction}
                       }     
				}";
				$pushButton = "
				{
					xtype: 'button',
					text: '{buttontitle}',
					//ui: 'pinky-round',
					handler: function(){
						this.up('{xtype}').push({
							xtype: '{navxtype}',
						});
					}
				}";
				
				$pagedata = $result['pagedata'][$i];
				$pageDataArray = json_decode(html_entity_decode($pagedata),TRUE);
				$navigationButtons = $pageDataArray['items'];
				//var_dump($pageDataArray);
					for($j=0;$j<count($navigationButtons);$j++)
					{
						if($navigationButtons[$j]['type'] == 'customfunction')
						{
							$buttons.="Ext.getCmp('".$myArray['pagename']."').add({xtype: 'button',text: '".$navigationButtons[$j]['title']."',ui: 'round',handler: function(){".$navigationButtons[$j]['data']."}});";
						}
						else {
						
							$buttons.="Ext.getCmp('".$myArray['pagename']."').add({xtype: 'button',text: '".$navigationButtons[$j]['title']."',ui: 'round',handler: function(){this.up('".$myArray['xtype']."').push({xtype: '".$navigationButtons[$j]['data']."'})}});";
						}
					}
					//echo $buttons;
				$dynamicFilesData[] = $buttons;
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
				break;
		default:
			echo "<h1>Error</h1>";
			break;
	}
}

$globalFiles = "var cfile = [];
";
$globalData = "";
$globalUpdate = "";
for($j=0;$j<count($dynamicFilesName);$j++)
{
	$globalFiles.="cfile[".$j."] = '".$dynamicFilesName[$j]."';
	";
	
	$globalData.="var ".$dynamicFilesName[$j]."Data = '".addcslashes($dynamicFilesData[$j],"\'")."';
	";
	$globalUpdate.= "<input type=\"hidden\" id=\"".$dynamicFilesName[$j]."Update\" value=\"false\" />
	";
	
	
	$checkPageUpdate.="if(newData.items[c].title == '".$dynamicFilesName[$j]."'){
                                    ".$dynamicFilesName[$j]."Data = stripslashes(newData.items[c].data);
                                    //console.log(\"NEW LIST = \" + ".$dynamicFilesName[$j]."Data);
                                    document.getElementById('".$dynamicFilesName[$j]."Update').value = 'true';
                                }
                        ";
                        
}
$indexTemplate = file_get_contents("../templates/index.tpl");
$indexTemplate = str_replace('{globalfiles}',$globalFiles.$globalData,$indexTemplate);
$indexTemplate = str_replace('{appid}',$appName['appid'],$indexTemplate);
$indexTemplate = str_replace('{checkPages}',$checkPageUpdate,$indexTemplate);
$indexTemplate = str_replace('{updatedFiles}',$globalUpdate,$indexTemplate);
file_put_contents($path.$appName['appid']."/index.html", $indexTemplate);

$appTempalte = file_get_contents("../templates/app.tpl");
$appTempalte = str_replace('{views}',$views,$appTempalte);
$appTempalte = str_replace('{models}',$models,$appTempalte);
$appTempalte = str_replace('{controllers}',$controllers,$appTempalte);
$appTempalte = str_replace('{stores}',$stores,$appTempalte);
$appTempalte = str_replace('{appname}',str_replace(" ","",$appName['apptitle']),$appTempalte);
file_put_contents($path.$appName['appid']."/app.js", $appTempalte);

?>