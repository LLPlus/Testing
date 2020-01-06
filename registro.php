<?php 

class informacion
{
	static public function obtenerinformacion()
	{
		$i=0;
		//se abre el archivo de usuarios en modo lectura y contrasenas en la variable archivo
		$archivo=fopen("archivo.txt","r");
		// se genera un ciclo hasta que llegue al fin del archivo
		while(!feof($archivo)){
			//se obtiene la "n" linea del texto quitando el salto de linea o fin de cadena
			$linea=rtrim(fgets($archivo));
			//del array obtenido, se delimita por una coma para almacenar los valores
			//estos valores se almacenan en una matriz llamada $lista
			$lista[$i]=explode(",",$linea);
			$i++;
		}
		// se cierra el archivo en modo lectura	
		fclose($archivo);
		return $lista;
	}

	static public function ingresarinformacion($cadena)
	{
		// se abre el archivo en modo anadir informacion
		$archivo=fopen("archivo.txt","a");
		// se anade al final del texto, la informacion proporcionada separada por comas
		fwrite($archivo,$cadena[0].",".$cadena[1].",".$cadena[2].",".$cadena[3].",".PHP_EOL);
		// se cierra el archivo
		fclose($archivo);
	}
}

function comparacion($rengloningresado,$renglonalmacenado){
	for($j=0;$j<count($renglonalmacenado);$j++){
		// se compara el nombre del usuario y el nombre almacenado en la lista si son iguales
		if(strcmp($rengloningresado[0],$renglonalmacenado[$j][0])==0){	
				return 1;
				// cambia el valor de la bandera y termina con el ciclo while y la condicion if
				break;
		}
	}
}

//se inicializan las variables, se usara una variable auxiliar como bandera;
$datoingresado=array(($_POST["usuario"]),($_POST["nombre"]),($_POST["correo"]),sha1(($_POST["contrasena"])));
$auxiliar=3;
$datos=new informacion();
$datoalmacenado=$datos->obtenerinformacion();
$opcion=comparacion($datoingresado,$datoalmacenado);

switch ($opcion){
	case 1:
		//se despliega que ya existe el usuario
		echo "El usuario: ".$usuario." ya existe, favor ingresa otro usuario";
		break;
	default:
		//se almacena la informacion en el archivo
		$datos->ingresarinformacion($datoingresado);
		// Desplegamos la informacion almacenada en la pantalla del usuario para corroborar
		echo "Usuario: ".$datoingresado[0];
		echo "<br>";
		echo "Contraseña: ".($_POST["contrasena"]);
		echo "<br>";
		echo "Agregados correctamente !!!";
}

?>