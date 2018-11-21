<?php
    require_once("modeloAbstractoDB.php");
	
    class Vehiculo extends ModeloAbstractoDB {
        private $vehiculo_ID;
        private $vehiculo_Descrip;
		function __construct() {
			//$this->db_name = '';
		}

		public function getVehiculo_ID(){
			return $this->vehiculo_ID;
		}
		
		public function getVehiculo_Descrip(){
			return $this->vehiculo_Descrip;
		}
				
		public function consultar($vehiculo_ID='') {
			if($vehiculo_ID !=''):
				$this->query = "
				SELECT vehiculo_ID, vehiculo_Descrip 
				FROM vehiculo 
				WHERE vehiculo_ID = '$vehiculo_ID' order by vehiculo_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaVehiculo() {
			$this->query = "
			SELECT vehiculo_ID, vehiculo_Descrip
			FROM vehiculo 
			order by vehiculo_ID
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('pais_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO pais
					(pais_ID, pais_Nomb, pais_Estado)
					VALUES
					(NULL, '$pais_Nomb', '$pais_Estado')
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			endif;
			
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE pais 
			SET pais_ID = '$pais_ID',
				pais_Nomb = '$pais_Nomb', 
			 	pais_Estado = '$pais_Estado' 
			WHERE pais_ID = '$pais_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($pais_ID='') {
			$this->query = "
			DELETE FROM pais 
			WHERE pais_ID = '$pais_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>