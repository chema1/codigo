<?php
/*
session_start();
$nom=$_REQUEST['nombre'];
$u=$_SESSION['us'];
$c=$_SESSION['pw'];
$ar=fopen($nom,"a") or
    die("Problemas en la creacion");
  
  fputs($ar,$_REQUEST['archivo']);
  fputs($ar,"\n");
  fputs($ar,"\n");
  fclose($ar);
  header('location:plantilla.php');
*/
 session_start();
 $nom=$_REQUEST['nombre'];
$u=$_SESSION['us'];
$c=$_SESSION['pw'];
 $ar=fopen("file.txt","a");
 fputs($ar,$_REQUEST['archivo']);
  fputs($ar,"\n");
  fputs($ar,"\n");
 $stream = ftp_connect("localhost");
  $login=ftp_login($stream,$u,$c);
  if($login=='1'){
  $file = ftp_put ($stream, $nom, "file.txt", FTP_ASCII);
  header('location:plantilla.php');
}
else{
echo 'error';
}
fclose($ar);
?>