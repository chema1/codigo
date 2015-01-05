<?php
session_start();
include 'funciones.php';
include 'conectar.php';
$u=$_SESSION['us'];
$c=$_SESSION['pw'];
$id=extraerid($mysqli,$u,$c);
$r=paginas($mysqli,$id);
echo "<center>";
echo "<div style='background:#FAFAFA; width:900px;'>";
echo '<center><div style="background:#5882FA; width:900px;widht:100px;"><font color="white"><h1>BIENVENIDO '.$u.'</h1></font></div></center>';
echo $r;
$usuario=$_SESSION['us'];
$clave=$_SESSION['pw'];
$servidor="localhost";
$puerto=21;
$ftp=@ftp_connect($servidor,$puerto,600);
$conec=@ftp_login ($ftp, $usuario, $clave);
if(!$ftp)
die("No se pudo conectar al servidor.");
elseif(!$conec)
die("Conexion rechasada.");
echo '<script>
var sin_selec="#";
var con_selec="#E4E4E4";
function marcar(obj) {
elem=obj.parentNode.parentNode;
elem.style.backgroundColor=(obj.checked) ? con_selec : sin_selec;
}
 
function marcarTodos(obj) {
elem=document.getElementsByName("select[]");
for(i=0;i<elem.length;i++) {
elem[i].checked=obj.checked;
fila=elem[i].parentNode.parentNode;
fila.style.backgroundColor=(obj.checked) ? con_selec : sin_selec;
}
}
</script>
'; // Escibimos una funcion javascript
////////////////////
if(!isset($_GET['c']))
$dir_pr=ftp_pwd($ftp);
else
$dir_pr=$_GET['c'];
////////////////////
if($_POST && $_POST['v']=="e"){
foreach($_POST['select'] as $es_val){// Abrimos el foreach
$ar=@ftp_delete($ftp,$es_val);
if($ar) // Si no es carpeta
echo "Se a eliminado correctamente.<br>";
else// De lo contrario
echo "No se pudo eliminar.<br>";
} // Cerramos el foreach
}
if($_POST && $_POST['v']=="c"){
$dir=$dir_pr.$_POST['dir'];
if (@ftp_mkdir($ftp, $dir)) {
 echo "Se a creado \"$dir\" con exito\n";
} else {
 echo "Hubo un problema al crear $dir\n";
}
}
//********************************************************************************************************
 
///////////////////
$pag=array();
echo "<font color='gray'>Directorio: ".$dir_pr."</font>";
if($dir_pr!="/")
echo "<br><a href='?c=/'>Regresar a raiz</a>";
echo '<form action="" name="selected" method="post"><table width="900" border="0" align="center" cellpadding="2" cellspacing="2">  <tr>
    <td width="445" height="19" bgcolor="#0080FF"><font color="white">Archivo o directorio </font></td>
    <td width="276" bgcolor="#999999"><font color="white">Tama&ntilde;o</font></td>
    <td width="20" bgcolor="#999999"><input type="checkbox" onClick="marcarTodos(this)" name="todos"/></td>
  </tr>
';
$contenidos = ftp_nlist($ftp,$dir_pr);
$i=0;
foreach($contenidos as $cont){
$tamaño=ftp_size($ftp,$dir_pr.$cont);
if($tamaño==-1 && $cont!="." && $cont!="..")
$pag[]="<tr>
    <td><a href='?c=".$dir_pr.$cont."/'>$cont</a></td>
    <td >-</td>
    <td >-</td>
  </tr>
";
elseif($cont!="." && $cont!="..")
$pag[]="<tr>
    <td><font color='gray'>$cont</font></td>
    <td ><font color='#0080FF'>$tamaño bytes</font></td>
    <td > <input type='checkbox' onClick='marcar(this)' name='select[]' value='".$dir_pr.$cont."' /> </td>
  </tr>
";
$i=$i+$tamaño;
}
echo implode('',$pag);
echo '</table>
<hr width="890px" height="2px" bgcolor="gray">
<font color="gray">
<input name="eliminar" type="submit" value="Eliminar seleccion"><input name="v" type="hidden" value="e"></form>';
echo '<form action="" name="selected" method="post"><input name="v" type="hidden" value="c">Crear carpeta:<input name="dir" type="text">
													<input name="crear" type="submit" value="NUEVA CARPETA">
													</form>';
echo '        <form action="" method="POST" enctype="multipart/form-data">
                <input name="v" type="hidden" value="s">
				</form>';	
				echo '<form action="pagina3.php" method="post">
							<font color="gray">Nombre del archivo :</font><input type="text" name="nombre">
							<input type="submit" value="Descargar" bgcolor="gray" color="white" border="2px">
					</form>
				';
echo "Aprox. de todos los archivos: ".$i." bytes</font>";

//echo '<form method="post"><input name="v" type="hidden" value="sa"><input name="salir" value="Salir" type="submit"></form>';
ftp_close($ftp);
echo "</div></center>";
echo '<center><div style="background:#40FF00; width:900px;widht:100px;"><font color="white">Hecho por JManuelCervantes</font></div></center>';

 ?>

