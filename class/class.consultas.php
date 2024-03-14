<?php
require_once("classconexion.php");

class conectorDB extends Db
{
	public function __construct()
    {
        parent::__construct();
    } 	
	
	public function EjecutarSentencia($consulta, $valores = array()){  //funcion principal, ejecuta todas las consultas
		$resultado = false;
		
		if($statement = $this->dbh->prepare($consulta)){  //prepara la consulta
			if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
				$campo = array_pop($campo); //inserto en un arreglo
				foreach($campo as $parametro){
					$statement->bindValue($parametro, $valores[substr($parametro,1)]);
				}
			}
			try {
				if (!$statement->execute()) { //si no se ejecuta la consulta...
					print_r($statement->errorInfo()); //imprimir errores
					return false;
				}
				$resultado = $statement->fetchAll(PDO::FETCH_ASSOC); //si es una consulta que devuelve valores los guarda en un arreglo.
				$statement->closeCursor();
			}
			catch(PDOException $e){
				echo "Error de ejecución: \n";
				print_r($e->getMessage());
			}	
		}
		return $resultado;
		$this->dbh = null; //cerramos la conexión
	} /// Termina funcion consultarBD
}/// Termina clase conectorDB

class Json
{
	private $json;

	public function BuscaDocente($filtro){
		$consulta = "SELECT CONCAT(ceddoc, ' : ',nomdoc) as label, coddoc FROM docentes WHERE CONCAT(ceddoc, '',nomdoc) LIKE '%".$filtro."%' order by coddoc asc LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaRepresentante($filtro){
		$consulta = "SELECT CONCAT(cedpadre) as label, codpadre, nompadre, apepadre, tlfpadre, statuspad FROM padres WHERE cedpadre LIKE '%".$filtro."%' order by codpadre asc LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaEstudiante($filtro){
		$consulta = "SELECT CONCAT(cedest) as label, codest, cedpadre, cedest, pnomest, snomest, papeest, sapeest, sexoest, direcest, fnacest FROM estudiantes WHERE CONCAT(cedest, ' ',pnomest, ' ',snomest, ' ',papeest, ' ',sapeest) LIKE '%".$filtro."%' ORDER BY cedest ASC LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BusquedaEstudiante($filtro){
		$consulta = "SELECT CONCAT(cedest, ' : ',pnomest, ' ',snomest, ' ',papeest, ' ',sapeest) as label, codest, cedpadre, cedest, pnomest, snomest, papeest, sapeest, sexoest, direcest, fnacest FROM estudiantes WHERE CONCAT(cedest, ' ',pnomest, ' ',snomest, ' ',papeest, ' ',sapeest) LIKE '%".$filtro."%' ORDER BY cedest ASC LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}


     }/// TERMINA CLASE  ///
?>