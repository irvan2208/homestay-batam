<?php
session_start();
require("../../../block/koneksi.php");
//error_reporting (E_ALL ^ E_NOTICE);
if (isset($_SESSION['logtoken'])) {
	if ($_POST['logtoken'] == $_SESSION['logtoken']){
		$username = $_POST['usernm'];
	    $password = $_POST['pass'];
	    $user_id = 0;
	    $status = "";

	    $stmt = $db->prepare("SELECT username, password FROM hbt_admin WHERE username=? AND password=? LIMIT 1");
	    $stmt->bind_param('ss', $username, $password);
	    $stmt->execute();
	    $stmt->bind_result($username, $password);
	    $stmt->store_result();
	    if($stmt->num_rows == 1){
            if($stmt->fetch()) //fetching the contents of the row
            {
               $_SESSION['Logged'] = 1;
               $_SESSION['username'] = $username;
               header('Location: '.$base_url.'4dmhb');
               //exit();echo "asd";
            }
        }
	    else {
	        echo "INVALID USERNAME/PASSWORD Combination!";
	        writeLog('LoginTried');
	    }
	    $stmt->close();
	}else{
		writeLog('Formtokenlogin');
	}
}else{
	writeLog('Formtokenlogin');
}

function writeLog($where) {

	$ip = $_SERVER["REMOTE_ADDR"]; // Get the IP from superglobal
	//$browser = $_SERVER['HTTP_USER_AGENT']; // Get the IP from superglobal
	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
	$date = date("d M Y H:i:s");
	
	// create a logging message with php heredoc syntax
	$logging = <<<LOG
		\n
		<< Start of Message >>
		There was a hacking attempt on your form. \n 
		Date Time of Attack: {$date}
		IP-Adress: {$ip} \n
		Host of Attacker: {$host}
		Point of Attack: {$where}
		<< End of Message >>
LOG;
        
        // open log file
		if($handle = fopen('breachlog.log', 'a')) {
		
			fputs($handle, $logging);  // write the Data to file
			fclose($handle);           // close the file
			
		}
}
?>
