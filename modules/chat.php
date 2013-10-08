<?php
	$ftp_connect = ftp_connect($ftp_host) or die("Couldn't connect to ".  $ftp_host); 
	$login_result = ftp_login($ftp_connect, $ftp_username, $ftp_password);

	$year = date("Y");
	$month = date("m");
	$day = date("d");

	$filename_log = "/". $path ."/BeLog/Be_".$year."-".$month."-".$day.".log";
	$filename_chat = "/". $path ."/Chat/Chat_".$year."-".$month."-".$day.".log";
	$log_array = file("ftp://". $ftp_username .":". $ftp_password ."@". $ftp_host . $filename_log);
	$chat_array = file("ftp://". $ftp_username .":". $ftp_password ."@". $ftp_host . $filename_chat);

	if($chat_view == 'logs'){
		$array = $log_array;
	} elseif ($chat_view == 'chat'){
		$array = $chat_array;
	}

	$array = array_reverse($array);
	foreach ($array as $messages) {
		if (strpos($messages,'Rcon')) {
			echo '<font color="red"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'RCon')) {
			echo '<font color="red"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'BattlEye')) {
			echo '<font color="red"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'Player')) {
			echo '<font color="grey"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'Verified GUID')) {
			echo '<font color="red"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'Side')) {
			echo '<font color="#00FFFF"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'Group')) {
			echo '<font color="#ffd88d"><b>'. $messages .'</b></font><br>';
		} elseif (strpos($messages,'Direct')) {
			echo '<font color="#FFF"><b>'. $messages .'</b></font><br>';
		} else {
			echo $messages . '<br>';
		}
	}
?>