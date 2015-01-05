<?php
session_start();
$u=$_SESSION['us'];
$c=$_SESSION['pw'];
$rpta = "";
//if ($_POST["action"] == "upload") {
	$tmpfile = $_FILES['archivo']['tmp_name'];
	$tmpname = $_FILES['archivo']['name'];
	
	$ftpuser = $u;
	$ftppass = $c;
	$ftppath = "localhost";
	$ftpurl = "ftp://".$ftpuser.":".$ftppass."@".$ftppath;
	
	if ($tmpname != "") {
		$fp = fopen($tmpfile, 'r');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ftpurl.$tmpname);
		curl_setopt($ch, CURLOPT_UPLOAD, 1);
		curl_setopt($ch, CURLOPT_INFILE, $fp);
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($tmpfile));
		curl_exec($ch);
		$error = curl_errno($ch);
		curl_close ($ch);
		if ($error == 0) {
			$rpta = 'Archivo subido correctamente.';
		} else {
			$rpta = 'Error al subir el archivo.';
		}
	} else {
		$rpta = 'Seleccionar un archivo.';
	}
//}
header('location:plantilla.php');
?>