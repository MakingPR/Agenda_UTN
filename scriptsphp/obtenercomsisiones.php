<?
session_start();
$Carrera=$_GET['Carrera'];
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
//Este script se encarda de mostrar todas las comisiones correspondientes a todas las carreras
//Primero muestra todas las comisiones correspondientes a la carrera a la que pertenece el usuario y despues pasa a mostrar las comisiones del resto de las carreras por si el usuario esta recursando uuna mteria homogenea en una comsision perteneciente a otra carrera
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$ab="select * from carrera where idcarrera=$Carrera";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mref=mysqli_fetch_array($ba);
$cantidadanios=$mref['Cantidadanios'];
$abrevcarrera=$mref['Abrevcarrera'];
//Variable que contendra cada uno de los options del select de comisiones
$comsisiones="";
$comsisiones.='<select name="listacomisiones" id="listacomisiones" data-native-menu="false" multiple="multiple" onchange="mostrarmaterias()"> <option data-placeholder="true">Seleccionar comision/es</option><optgroup label="Comisiones '.$abrevcarrera.'">';
                 for ($x=1;$x<=$cantidadanios;$x++)
				 {
					 	$ac="select * from comisiones where Carrera=$Carrera AND Anio=$x";	
						$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
						$mreco=mysqli_fetch_array($ca);
						$cantidadcomsisiones=$mreco['Cantidadcomis'];
						for ($y=1;$y<=$cantidadcomsisiones;$y++)
						 {
							 switch($y)
							 {
								 case 1:
								 $letra="A";
								 break;
								 case 2:
								 $letra="B";
								 break;
								 case 3:
								 $letra="C";
								 break;
								 case 4:
								 $letra="D";
								 break;
								 case 5:
								 $letra="E";
								 break;
								 case 6:
								 $letra="F";
								 break;
							}
							$comsisiones.='<option value="'.$x.' Ano '.$letra.' '.$abrevcarrera.'">'.$x."º Año ".$letra.'</option>';
						} 
						
				} 
		$comsisiones.='</optgroup>';
		//Selecciona el resto de las carreras
$ab="select * from carrera where idcarrera!=$Carrera";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);

while ($mref=mysqli_fetch_array($ba))
{
	$Carrera=$mref['idcarrera'];
	$cantidadanios=$mref['Cantidadanios'];
	$abrevcarrera=$mref['Abrevcarrera'];
	$comsisiones.='<optgroup label="Comisiones '.$abrevcarrera.'">';
	for ($x=1;$x<=$cantidadanios;$x++)
				 {
					 	$ac="select * from comisiones where Carrera=$Carrera AND Anio=$x";	
						$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
						$mreco=mysqli_fetch_array($ca);
						$cantidadcomsisiones=$mreco['Cantidadcomis'];
						for ($y=1;$y<=$cantidadcomsisiones;$y++)
						 {
							 switch($y)
							 {
								 case 1:
								 $letra="A";
								 break;
								 case 2:
								 $letra="B";
								 break;
								 case 3:
								 $letra="C";
								 break;
								 case 4:
								 $letra="D";
								 break;
								 case 5:
								 $letra="E";
								 break;
								 case 6:
								 $letra="F";
								 break;
							}		
							$comsisiones.='<option value="'.$x.' Ano '.$letra.' '.$abrevcarrera.'">'.$x."º Año ".$letra.'</option>';
						} 
						
				} 
		$comsisiones.='</optgroup>';
}
$comsisiones.='</select><span id="errorcomisiones"></span>';
		echo $comsisiones;
?>


	