<?php 
	$DOCKER_IMAGE_STATIC_SHARED="static_shared";
	$DOCKER_IMAGE_EXPRESS="express";
	$DOCKER_IMAGE_REVERSE_PROXY="reverse-proxy";
	$DOCKER_ARG_VARIABLE="-e";
	$STATIC_APP="STATIC_APP";
	$DYNAMIC_APP="DYNAMIC_APP";
	$STATIC_APP_PORT=":80";
	$DYNAMIC_APP_PORT=":3000";

	echo "try to get ip address\n";

	$static_app_name = shell_exec("docker ps -q -f ancestor=". $DOCKER_IMAGE_STATIC_SHARED);

	$tab = explode("\n", $static_app_name);

	$array_static_ip = array();
	$array_dynamic_ip = array();
	foreach ($tab as $name) {
		if(strlen($name) > 1){
			$static_ip = exec("docker inspect " . $name . " | grep IPAddress | cut -d \":\" -f2 | cut -d \"\"\" -f2");
			$array_static_ip[] = $static_ip;
		}
	}

	$dynamic_app_name = shell_exec("docker ps -q -f ancestor=" . $DOCKER_IMAGE_EXPRESS);
	#echo "$static_app_name";
	$tab = explode("\n", $dynamic_app_name);

	foreach ($tab as $name) {
		if(strlen($name)>1){
			$dynamic_ip = exec("docker inspect " . $name . " | grep IPAddress | cut -d \":\" -f2 | cut -d \"\"\" -f2");
			$array_dynamic_ip[] = $dynamic_ip;
		}
	}
	$index = 0;
	#$argument = "";
	foreach($array_static_ip as $name){
			#echo "$name\n";
			$argument = $argument . "" . $DOCKER_ARG_VARIABLE . " " . $STATIC_APP . "" . $index . "=" . $name . "" . $STATIC_APP_PORT . " ";
			$index++;
	}
	foreach($array_dynamic_ip as $name){
			#echo "$name\n";
			$argument = $argument . "" . $DOCKER_ARG_VARIABLE . " " . $DYNAMIC_APP . "" . $index . "=" . $name . "" . $DYNAMIC_APP_PORT . " ";
			$index++;
	}
	echo "$argument";

	exec("docker run -d -p 8080:80 " . $argument . " reverse-proxy");

?>