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

$DBC->query = "SELECT id FROM pages WHERE appid='".$appLastUpdate['id']."' AND UNIX_TIMESTAMP(lastupdate) >".$mobileLastUpdate ;

$checkUpdate = $DBC->execute();

//$webLastUpdate = strtotime($appLastUpdate['lastupdate']);

//echo "Web Time = ".$webLastUpdate." [".$appLastUpdate['lastupdate']."] - Mobile Last Update = ".$mobileLastUpdate."<hr>";

//if($webLastUpdate > $mobileLastUpdate)
if($checkUpdate->num_rows > 0)
{
	$DBC->query = "SELECT * FROM pages WHERE appid='".$appLastUpdate['id']."' ";
	$result = $DBC->execute();
	if($result)
	{
		$updates = '{"entries":[';
                $updates.= '{"title":"lastUpdate","data":"'.time().'"}';
		$comma = ",";
		while( $r = mysqli_fetch_assoc($result))
		{	
                       if($r['pagetype'] == '19')
			{
                                //$listData = htmlspecialchars_decode($r['pagedata']);
                                //$listData  = $r['pagedata'];
                                 $validText = html_entity_decode($r['pagedata']);
                                $validText = htmlspecialchars_decode($validText);
                                $validText = preg_replace('!\s+!smi', ' ',$validText);
        
				$updates.=$comma.'{"title":"'.str_replace(" ","",$r['title']).'","data":"'.str_replace('"','\"',stripslashes($validText)).'"}
			';
			}
			elseif($r['pagetype'] == '21')
			{
				$pagedata = $r['pagedata'];
				$pageDataArray = json_decode(html_entity_decode($pagedata),TRUE);
				$navigationButtons = $pageDataArray['items'];
                                        $sep = "";
                                        $buttons = "";
					for($j=0;$j<count($navigationButtons);$j++)
					{
						if($navigationButtons[$j]['type'] == 'customfunction')
						{
							$buttons.=$sep.$navigationButtons[$j]['title'].",customfunction,".$navigationButtons[$j]['data'];
						}
						else {
						
							$buttons.=$sep.$navigationButtons[$j]['title'].",page,".$navigationButtons[$j]['data'];
						}
                                              $sep = "|";
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