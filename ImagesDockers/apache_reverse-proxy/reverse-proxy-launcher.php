<?php 
	echo "try to get ip address\n";
	#$tab = array(); 
	#$static_app_name = explode(' ', exec("docker ps -f ancestor=testip |  cut -d "/" -f2 | cut -c 6-40 | tail -n +2"));
	$static_app_name = shell_exec("docker ps -q -f ancestor=testip");
	#echo "$static_app_name";
	$tab = explode("\n", $static_app_name);

	foreach ($tab as $name) {
		echo "$name";
		$static_ip = exec("docker inspect " . $name . " | grep IPAddress | grep -E \b([0-9]{1,3}.){3}[0-9]{1,3}\b");
		echo "$static_ip\n";
	}

	#exec("docker ps -f ancestor=testip |  cut -d "/" -f2 | cut -c 6-40 | tail -n +2", $tab );
	#$static_app_name = exec("docker ps -f ancestor=testip |  cut -d "/" -f2");
	#$static_app_name = exec("docker ps -f ancestor=testip |  cut -d "/" -f2 | cut -c 6-40");
	#$static_app_name = exec("docker ps -f ancestor=testip |  cut -d "/" -f2 | cut -c 6-40 | tail -n +2");
	#| grep -E '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b'
?>