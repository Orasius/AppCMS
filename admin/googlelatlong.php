<?PHP 
$geoArray = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . urlencode($_POST["Address"]) . "&sensor=false"));

var_dump($geoArray);
?>