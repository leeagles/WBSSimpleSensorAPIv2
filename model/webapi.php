<?php
   header("Content-Type:application/json");
   $qry = filter_input(INPUT_GET, 'qry');
   if (!empty($qry) && $qry == "a")
   {
		include_once("../dblib/db_lib.inc");
		$sensordb = new sensor_db();
		$data = $sensordb->get_sensor_data();
		
		if (empty($data))
			deliver_response(200, "data not found", NULL);
		else
		   deliver_response(200, "data found", $data);
   }
   else
   {
	   // send error message to client
	   deliver_response(400, "Invalid request", NULL);
   }

   function deliver_response($status, $status_message, $data)
   {
	  header("HTTP/1.1 $status $status_message");
	  $response['status'] = $status;
	  $response['status_message'] = $status_message;
	  $response['data'] = $data;
	  
	  $json_response = json_encode( $response );
	  echo $json_response;  
   }
?>