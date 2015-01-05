<?php
session_start();
$nom=$_REQUEST['nombre'];
$u=$_SESSION['us'];
$c=$_SESSION['pw'];
 $stream = ftp_connect("localhost");
  $login=ftp_login($stream,$u,$c);
  if($login=='1'){
  $file = ftp_get($stream, "./file.txt","/".$nom,FTP_ASCII);
  echo '<script>alert("descargado correctamente");</script>';
  header('location:plantilla.php');
  // 
}
else{
echo 'error';
}
?>