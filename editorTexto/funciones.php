<?php
function validar($mysqli, $u, $p)
{
	$e=$mysqli->prepare("call validar(?,?)");
	$e->bind_param('ss',$u,$p);
	$e->execute();
	$e->bind_result($n);
	$e->fetch();
	if($n>0)
	{
		return true;
	}
	else
	{
		return false;
	}
	$e->close();
}
//****************************************************************************
function verificarFolio($mysqli,$folio){
$e=$mysqli->prepare("call fol(?)");
$e->bind_param('s',$folio);
$e->execute();
$e->bind_result($n);
$e->fetch();
if($n>0)
	{
		return true;
	}
	else
	{
		return false;
	}
	$e->close();
}

function borrarFolio($mysqli,$folio){
$e=$mysqli->prepare("Call borrarFolio(?)");
	$e->bind_param('s',$folio);
	$e->execute();
	$e->close();
}

function registrarUsuario($mysqli,$usuario,$pass){
$e=$mysqli->prepare("Call altaUsuario(?,?)");
	$e->bind_param('ss',$usuario,$pass);
	$e->execute();
	$e->close();
}
//**************************************************************************
function extraerid($mysqli,$u,$c)
{
	$e=$mysqli->prepare("Call extraerid(?,?)");
        $e->bind_param('ss',$u,$c);
        $e->execute();
        $e->bind_result($id);
        $e->fetch();
        $e->close();
        return $id;

}
function paginas($mysqli,$x)
{
	$e=$mysqli->prepare("Call mostrar(?)");
	$e->bind_param('i',$x);
	$e->execute();
	$e->bind_result($idp,$pagina);
	$e->fetch();
	$e->close();
	return $pagina;
 
}
function ftp($u,$p){
$stream=ftp_connect("localhost");
$login=ftp_login($stream,$u,$p);
if($login=='1'){
	$directory=ftp_pwd($stream);
	//echo $directory;
	//$newdir=ftp_mkdir($stream,"prueba");
	$list=ftp_nlist($stream,"/");
	echo '<table border="0px" width="880px"> ';
	for($i=0;$i<count($list);$i++){
		echo "<tr><td color='gray' bgcolor='#E6E6E6' onMouseOver=\"this.style.background='white'\" 
onMouseOut=\"this.style.background='#E6E6E6'\"><a href='#'>".$list[$i]."</a></td><tr>";
	}
	echo '</table>';
}
else{
	echo "error";
}
}

?>
