<?php

class db{

	public $results;
	
	public function mysqlconnect($server, $user, $password){
		$connection = mysql_connect($server, $user, $password);
		if(!connection){
			die("Error Connecting to Server");
			}
		}

	public function mysqlselectdb($database){
		$db = mysql_select_db($database);
		if(!$db){
			die("Error Connecting to Database");
			}	
		}
	
	public function mysqlquery($query){
		$this->results = mysql_query($query);
		if(!$this->results){
			die("Error With Query");
			}
		}
	
	public function mssqlconnect($server, $user, $password){
		$connection = mssql_connect($server, $user, $password);
		if(!$connection){
			die("Error Connecting to Server");
			}
		}
	
	public function mssqlselectdb($database){
		$db = mssql_select_db($database);
		if(!$db){
			die("Error Connecting to Database");
			}
		}	
	
	public function mssqlquery($query){
		$this->results = mssql_query($query);
		if(!$this->results){
			die("Error With Query");
			}
		}
					
	}

class email{

	function send_email($to, $from, $subject, $message, $file, $cc = '', $bcc = ''){
		$file_name = basename($file);
		$content = chunk_split(base64_encode(file_get_contents($file))); 
		$uid = md5(uniqid(time()));
		$from = str_replace(array("\r", "\n"), '', $from); // to prevent email injection
		$header = "From: ".$from."\r\n"
			."Cc: ".$cc."\r\n"
			."Bcc: ".$bcc."\r\n" 
			."MIME-Version: 1.0\r\n"
			."Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n"
			."This is a multi-part message in MIME format.\r\n" 
			."--".$uid."\r\n"
			."Content-type:text/plain; charset=iso-8859-1\r\n"
			."Content-Transfer-Encoding: 7bit\r\n\r\n"
			.$message."\r\n\r\n"
			."--".$uid."\r\n"
			."Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n"
			."Content-Transfer-Encoding: base64\r\n"
			."Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n"
			.$content."\r\n\r\n"
			."--".$uid."--"; 
		return mail($to, $subject, "", $header);
	}

}
	
?>

