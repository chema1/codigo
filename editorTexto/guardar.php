<?php
include 'funciones.php';
include 'conectar.php';

$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$folio=$_POST['folio'];

if(verificarFolio($mysqli,$folio)){
borrarFolio($mysqli,$folio);
registrarUsuario($mysqli,$usuario,$pass);
header('location:index.html');
}
else{
header('location:registrarse.php');
}

?>