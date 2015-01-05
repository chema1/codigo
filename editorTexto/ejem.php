<?php
$usuario="chema";
$clave="chema";
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
'; 

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
/*
if($_POST && $_POST['v']=="s"){      
$local_file = $dir_pr.$_FILES['txt_file']['tmp_name'];
$destination_file = $dir_pr.basename($_FILES['txt_file']['name']);  
$upload = ftp_put($ftp, $destination_file, $local_file, FTP_BINARY); 
if($upload)
echo "Se a subido correctamente.";
else
echo "No se pudo subir correctamente.";
}
*/
 
///////////////////
$pag=array();
echo "Directorio: ".$dir_pr;
if($dir_pr!="/")
echo "<br><a href='?c=/'>Ir al principio</a>";
echo '<form action="" name="selected" method="post"><table width="761" border="0" align="center" cellpadding="2" cellspacing="2">  <tr>
    <td width="445" height="19" bgcolor="#999999"><strong>Archivo o directorio </strong></td>
    <td width="276" bgcolor="#999999"><strong>Tama&ntilde;o</strong></td>
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
    <td>$cont</td>
    <td >$tamaño bytes</td>
    <td > <input type='checkbox' onClick='marcar(this)' name='select[]' value='".$dir_pr.$cont."' /> </td>
  </tr>
";
$i=$i+$tamaño;
}
echo implode('',$pag);
echo '</table><input name="eliminar" type="submit" value="Eliminar selecionados"><input name="v" type="hidden" value="e"></form>';
echo '<form action="" name="selected" method="post"><input name="v" type="hidden" value="c">Crear directorio nuevo:<br><input name="dir" type="text"><input name="crear" type="submit" value="Crear nuevo directorio"></form>';
echo '        <form action="" method="POST" enctype="multipart/form-data">
                <input name="v" type="hidden" value="s">
           
        </form>';
echo "Tamaño aprox. de todos los archivos: ".$i." bytes";
echo '<form method="post"><input name="v" type="hidden" value="sa"><input name="salir" value="Salir" type="submit"></form>';
ftp_close($ftp);
 ?>