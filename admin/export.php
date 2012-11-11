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
$pathAndroid = "../exported/android/";
if(!is_dir($path.$appName['appid']))
{
	mkdir($path.$appName['appid'],0777);
	mkdir($path.$appName['appid']."/view/",0777);
	mkdir($path.$appName['appid']."/store/",0777);
	mkdir($path.$appName['appid']."/model/",0777);	
	mkdir($path.$appName['appid']."/controller/",0777);
        
        mkdir($pathAndroid.$appName['appid'],0777);
	mkdir($pathAndroid.$appName['appid']."/view/",0777);
	mkdir($pathAndroid.$appName['appid']."/store/",0777);
	mkdir($pathAndroid.$appName['appid']."/model/",0777);	
	mkdir($pathAndroid.$appName['appid']."/controller/",0777);
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
        
        $viewTemplateFile2 = "../androidtemplates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".view";
	$storeTemplateFile2= "../androidtemplates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".store";
	$modelTemplateFile2= "../androidtemplates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".model";
	$controllerTemplateFile2 = "../androidtemplates/".strtolower($result['pagetype'][$i])."/".strtolower($result['pagetype'][$i]).".controller";
        
	//echo $result['pagetype'][$i];
	switch ($result['pagetype'][$i]) {
		case 'HTML':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$viewTemplate = file_get_contents($viewTemplateFile);
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
                                
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                                // Android 
                               file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
				//echo nl2br($viewTemplate);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
		case 'Gallery':
		
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				
				$viewTemplate = file_get_contents($viewTemplateFile);
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
				
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                               // Android 
                               file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
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
				
                                
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
				$storeTemplate2= file_get_contents($storeTemplateFile2);
				$modelTemplate2= file_get_contents($modelTemplateFile2);
				$controllerTemplate2= file_get_contents($controllerTemplateFile2);
                                
                                
				//echo $viewTemplate;
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
				//Android
                                file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
                                
                                
				$storeTemplate = exportTemplateParse($myArray,$storeTemplate);
                                $storeTemplate2 = exportTemplateParse($myArray,$storeTemplate2);
				file_put_contents($path.$appName['appid']."/store/".ucfirst($myArray['pagename']).".js", $storeTemplate);
				//Android
                               file_put_contents($pathAndroid.$appName['appid']."/store/".ucfirst($myArray['pagename']).".js", $storeTemplate2);
                                
				$modelTemplate = exportTemplateParse($myArray,$modelTemplate);
                                $modelTemplate2 = exportTemplateParse($myArray,$modelTemplate2);
				file_put_contents($path.$appName['appid']."/model/".ucfirst($myArray['pagename']).".js", $modelTemplate);
				//Android
                               file_put_contents($pathAndroid.$appName['appid']."/model/".ucfirst($myArray['pagename']).".js", $modelTemplate2);
                                
                                
				$controllerTemplate = exportTemplateParse($myArray,$controllerTemplate);
                                $controllerTemplate2 = exportTemplateParse($myArray,$controllerTemplate2);
				file_put_contents($path.$appName['appid']."/controller/".ucfirst($myArray['pagename']).".js", $controllerTemplate);
				//Android
                               file_put_contents($pathAndroid.$appName['appid']."/controller/".ucfirst($myArray['pagename']).".js", $controllerTemplate2);
                                
				
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
                                
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
				
                                
                                
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                                
                                file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
                                
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
		case 'Audio':
				$dynamicFilesName[] = $myArray['pagename'];
				$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				$myArray['audiourl'] = $result['pagedata'][$i];
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
                                
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
                                
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                                
                                file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
                                
                                
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
                                
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
                                
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                                
                                file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
				$views.=$vcomma."'".$myArray['pagename']."'";
				$vcomma = ",";
			break;
			
		case 'Navigation':
			
				$dynamicFilesName[] = $myArray['pagename'];
				//$dynamicFilesData[] = html_entity_decode($result['pagedata'][$i]);
				
				
				$pagedata = $result['pagedata'][$i];
				$pageDataArray = json_decode(html_entity_decode($pagedata),TRUE);
				$navigationButtons = $pageDataArray['items'];
				//var_dump($pageDataArray);
                                        $buttons = "";
                                        $comma = "";
					for($j=0;$j<count($navigationButtons);$j++)
					{
						if($navigationButtons[$j]['type'] == 'customfunction')
						{
							$buttons.=$comma.$navigationButtons[$j]['title'].",customfunction,".$navigationButtons[$j]['data'];
						}
						else {
						
							$buttons.=$comma.$navigationButtons[$j]['title'].",page,".$navigationButtons[$j]['data'];
						}
                                                $comma = "|";
					}
					//echo $buttons;
				$dynamicFilesData[] = $buttons;
				$viewTemplate = file_get_contents($viewTemplateFile);
				$viewTemplate = exportTemplateParse($myArray,$viewTemplate);
                                
                                $viewTemplate2 = file_get_contents($viewTemplateFile2);
                                $viewTemplate2 = exportTemplateParse($myArray,$viewTemplate2);
                                
				file_put_contents($path.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate);
                                
                                file_put_contents($pathAndroid.$appName['appid']."/view/".ucfirst($myArray['pagename']).".js", $viewTemplate2);
                                
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
        $cfileCounter = $j+1;
	$globalFiles.="cfile[".$cfileCounter."] = '".$dynamicFilesName[$j]."';
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
        
        $checkPageUpdateAndroid.="document.getElementById('".$dynamicFilesName[$j]."Update').value = 'true';
                                ";
                        
}
$indexTemplate = file_get_contents("../templates/index.tpl");
$indexTemplate = str_replace('{globalfiles}',$globalFiles.$globalData,$indexTemplate);
$indexTemplate = str_replace('{appid}',$appName['appid'],$indexTemplate);
$indexTemplate = str_replace('{checkPages}',$checkPageUpdate,$indexTemplate);
$indexTemplate = str_replace('{updatedFiles}',$globalUpdate,$indexTemplate);
file_put_contents($path.$appName['appid']."/index.html", $indexTemplate);

//ANDROID 
$globalFilesAsJSON = file_get_contents('http://www.appc.ms/cms/androidupdate.php?id='.$appName['appid'].'&lastupdate=0');
//echo '<h1>http://www.appc.ms/cms/androidupdate.php?id='.$appName['appid'].'&lastupdate=0</h1>';
$indexTemplate2 = file_get_contents("../androidtemplates/index.tpl");
$indexTemplate2 = str_replace('{globalfiles}',str_replace("'","\'",$globalFilesAsJSON),$indexTemplate2);
$indexTemplate2 = str_replace('{appid}',$appName['appid'],$indexTemplate2);
$indexTemplate2 = str_replace('{checkPages}',$checkPageUpdateAndroid,$indexTemplate2);
$indexTemplate2 = str_replace('{updatedFiles}',$globalUpdate,$indexTemplate2);

file_put_contents($pathAndroid.$appName['appid']."/index.html", $indexTemplate2);



$appTempalte = file_get_contents("../templates/app.tpl");
$appTempalte = str_replace('{views}',$views,$appTempalte);
$appTempalte = str_replace('{models}',$models,$appTempalte);
$appTempalte = str_replace('{controllers}',$controllers,$appTempalte);
$appTempalte = str_replace('{stores}',$stores,$appTempalte);
$appTempalte = str_replace('{appname}',str_replace(" ","",$appName['apptitle']),$appTempalte);
file_put_contents($path.$appName['appid']."/app.js", $appTempalte);

//ANDROID
$appTempalte2 = file_get_contents("../androidtemplates/app.tpl");
$appTempalte2 = str_replace('{views}',$views,$appTempalte2);
$appTempalte2 = str_replace('{models}',$models,$appTempalte2);
$appTempalte2 = str_replace('{controllers}',$controllers,$appTempalte2);
$appTempalte2 = str_replace('{stores}',$stores,$appTempalte2);
$appTempalte2 = str_replace('{appname}',str_replace(" ","",$appName['apptitle']),$appTempalte2);
file_put_contents($pathAndroid.$appName['appid']."/app.js", $appTempalte2);e

?>