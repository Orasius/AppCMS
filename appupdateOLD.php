<?PHP
session_start();

include "config.php";
include "functions/functions.php";

$id = $_GET['id'];
$mobileLastUpdate = $_GET['lastupdate'];
//$DBC->query = "SELECT t1.title AS title,t1.xtype AS xtype, t1.pagedata AS pagedata, t2.title AS pagetype FROM pages AS t1 INNER JOIN pagestype AS t2 ON t1.pagetype = t2.id AND t1.appid = '".$id."' ";

//$result = $DBC->fetchAssos($DBC->execute());
$DBC->query = "SELECT id,lastupdate FROM apps WHERE appid='".$id."'";
$appLastUpdate = $DBC->fetch($DBC->execute());

$webLastUpdate = time($appLastUpdate['lastupdate']);
//echo time($appLastUpdate['lastupdate']);

if($webLastUpdate > $mobileLastUpdate)
{
	$DBC->query = "SELECT * FROM pages WHERE appid='".$appLastUpdate['id']."' AND lastupdate >= '".$appLastUpdate['lastupdate']."' ";
	$result = $DBC->execute();
	if($result)
	{
		$updates = '{"items":[';
		$comma = "";
		while( $r = mysqli_fetch_assoc($result))
		{	
                       if($r['pagetype'] == '19')
			{
				$updates.=$comma.'{"title":"'.str_replace(" ","",$r['title']).'","data":"'.str_replace('"','\"',stripslashes($r['pagedata'])).'"}
			';
			}
			elseif($r['pagetype'] == '21')
			{
				$pagedata = $r['pagedata'];
				$pageDataArray = json_decode(html_entity_decode($pagedata),TRUE);
				$navigationButtons = $pageDataArray['items'];
					for($j=0;$j<count($navigationButtons);$j++)
					{
						if($navigationButtons[$j]['type'] == 'customfunction')
						{
							$buttons.="Ext.getCmp('".str_replace(" ","",$r['title'])."Panel').add({xtype: 'button',text: '".$navigationButtons[$j]['title']."',ui: 'round',handler: function(){".$navigationButtons[$j]['data']."}});";
						}
						else {
						
							$buttons.="Ext.getCmp('".str_replace(" ","",$r['title'])."Panel').add({xtype: 'button',text: '".$navigationButtons[$j]['title']."',ui: 'round',handler: function(){this.up('".$r['xtype']."').push({xtype: '".$navigationButtons[$j]['data']."'})}});";
						}
					}
					$updates.=$comma.'{"title":"'.str_replace(" ","",$r['title']).'","data":"'.$buttons.'"}';
			}
			else{
                                $r['pagedata'] = preg_replace('~>\s+<~', '><', html_entity_decode($r['pagedata']));
                                $r['pagedata'] = preg_replace('!\s+!smi', ' ', $r['pagedata']);
                                //echo "<h1>".$r['pagedata']."</h1>";
				$updates.=$comma.'{"title":"'.str_replace(" ","",$r['title']).'","data":"'.stripslashes($r['pagedata']).'"}
			';}
			$comma = ",";
		}	
		$updates.=']}';
		
		echo $updates;
	}	
}
else
{
	echo 'no';  
}
?>