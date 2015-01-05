<?php
session_start();
include 'conectar.php';
include 'funciones.php';
$usuario=$_POST['u'];
$clave=$_POST['p'];
$captcha=$_POST['c'];
if(validar($mysqli,$usuario,$clave) && $captcha==$_SESSION['captcha'])
{
	    $_SESSION['us']=$usuario;
        $_SESSION['pw']=$clave;
        header('Location: ./plantilla.php');
}
else
{
	echo 'Error de Usuario...';
}
?>

<!-- crear aplicacion de escritorio en java para agregar folios  eliminar y guardar-->
<!-- crear tabla folio donde se guardaran los folio, una vez usados debe eliminar el folio-->
<!-- crear pagina web para ver los folios con un servicio web en java-->