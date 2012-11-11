<?PHP
include "config.php";

$DBC->query = "SELECT appleid,androidid FROM apps WHERE id='10'";
$r = $DBC->fetch();
//var_dump($r);
//$r = mysqli_fetch_assoc($result);

$thisMonth = date("m");
$thisYear  = date("Y");
$thisDay   = date("d");
foreach($r AS $key => $value)
{
	$host = "https://api.appfigures.com/v1.1/sales/products+dates/".$thisYear."-".$thisMonth."-01/".$thisYear."-".$thisMonth."-".$thisDay."/?data_source=daily&products=".$value;
	echo "<h1>".$host."</h1>";
	$process = curl_init($host);
	curl_setopt($process, CURLOPT_USERPWD, 'oras@shloud.com:oro1981');
	curl_setopt($process, CURLOPT_TIMEOUT, 30);
	curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);

	$return = curl_exec($process);
	curl_close($process);
	$returnArray = json_decode($return,true);
	foreach($returnArray[$value] AS $key=>$value)
	{
		echo "Date:".$key." Downloads:";
		foreach($value AS $key2=>$value2)
		{
			if($key2 == "downloads")
				echo $value2."<br />";
		}
	}
	//var_dump($return);
	echo "<hr>";
}

/*
$host = "https://api.appfigures.com/v1.1/";
$host = "https://api.appfigures.com/v1.1/users/oras@shloud.com/products";
//$host = "https://api.appfigures.com/v1.1/sales/products+dates/2012-04-01/2012-05-30/?data_source=daily&products=436215";
$process = curl_init($host);
//curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));
//curl_setopt($process, CURLOPT_HEADER, 1);
curl_setopt($process, CURLOPT_USERPWD, 'oras@shloud.com:oro1981');
curl_setopt($process, CURLOPT_TIMEOUT, 30);
//curl_setopt($process, CURLOPT_POST, 1);
//curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
//curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);

$return = curl_exec($process);

print_r($return);
*/
/*
$data = '{
  "436215": {
    "2012-04-27": {
      "downloads": 2,
      "updates": 0,
      "returns": 0,
      "net_downloads": 2,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-04-27"
    },
    "2012-04-28": {
      "downloads": 12,
      "updates": 0,
      "returns": 0,
      "net_downloads": 12,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-04-28"
    },
    "2012-04-29": {
      "downloads": 7,
      "updates": 0,
      "returns": 0,
      "net_downloads": 7,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-04-29"
    },
    "2012-04-30": {
      "downloads": 43,
      "updates": 0,
      "returns": 0,
      "net_downloads": 43,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-04-30"
    },
    "2012-05-01": {
      "downloads": 25,
      "updates": 0,
      "returns": 0,
      "net_downloads": 25,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-01"
    },
    "2012-05-02": {
      "downloads": 6,
      "updates": 0,
      "returns": 0,
      "net_downloads": 6,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-02"
    },
    "2012-05-03": {
      "downloads": 1,
      "updates": 0,
      "returns": 0,
      "net_downloads": 1,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-03"
    },
    "2012-05-04": {
      "downloads": 1,
      "updates": 0,
      "returns": 0,
      "net_downloads": 1,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-04"
    },
    "2012-05-07": {
      "downloads": 1,
      "updates": 0,
      "returns": 0,
      "net_downloads": 1,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-07"
    },
    "2012-05-08": {
      "downloads": 1,
      "updates": 0,
      "returns": 0,
      "net_downloads": 1,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-08"
    },
    "2012-05-10": {
      "downloads": 2,
      "updates": 0,
      "returns": 0,
      "net_downloads": 2,
      "promos": 0,
      "revenue": "0.00",
      "gift_redemptions": 0,
      "product": {
        "id": 436215,
        "ref_no": "521367454",
        "external_account_id": 35097,
        "store_id": 0,
        "store_name": "apple",
        "added_timestamp": "2012-05-02T00:00:00",
        "name": "Multimodal",
        "icon": "http://a2.mzstatic.com/us/r1000/097/Purple/v4/bc/43/6a/bc436a3b-b544-b129-37c2-7510110af5b5/fjicQuC6lEefOIA5UOMskg-temp-upload.waowcpid.png",
        "active": true,
        "hidden": false,
        "sku": "21042012",
        "in_apps": [],
        "product_type": "app",
        "addons": []
      },
      "date": "2012-05-10"
    }
  }
}';

$dataArray = json_decode($data,true);

$comma = "";
foreach($dataArray['436215'] AS $key=>$value)
{
	//echo $key."=>".$value."<br />";
	$myArray.=$comma."['".$key."',";
	foreach($value AS $key2=>$value2)
	{
		if($key2 == 'downloads')
			$myArray.= $value2."]";
		//echo $key2."=>".$value2."<br />";
	}
	$comma=",";
}
echo $myArray;
*/
?>