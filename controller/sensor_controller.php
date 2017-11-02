<?php	
$loc  = filter_input(INPUT_GET, "loc");
$loc = "a";
function route($url)
{
	$wclient = curl_init($url);
	curl_setopt($wclient, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($wclient);
	$result = json_decode($response);
	$sensor_data = $result->data;	
	//print_r($sensor_data);
	return $sensor_data;	
}
	
/* connect to web api to collect data */
if (!empty($loc) && $loc == "a")
{
	$url = "http://localhost:8090/model/webapi.php?qry=$loc";
	$data = route($url);
	
	include_once("../view/sensor_view.php");
	
	$cdata = '{
					  "cols": [
							{"id":"","label":"sensors","pattern":"","type":"string"},
							{"id":"","label":"Proportions","pattern":"","type":"number"}
						  ],
					  "rows": [
							{"c":[{"v":"1","f":null},{"v":5,"f":null}]},
							{"c":[{"v":"2","f":null},{"v":3,"f":null}]},
							{"c":[{"v":"3","f":null},{"v":5,"f":null}]},
							{"c":[{"v":"4","f":null},{"v":7,"f":null}]}
						  ]
					}';
	include_once("../view/chart_view.php");
	
}



?>