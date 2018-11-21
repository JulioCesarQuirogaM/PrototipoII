<?php
    require_once("modeloAbstractoDB.php");
	
    class VehiculoApart extends ModeloAbstractoDB {
        private $vehiculoApart_ID;
        private $vehiculo_ID;
        private $placa;
		private $persona_ID;
		private $bloque_ID;
		private $apart_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getVehiculoApart_ID(){
			return $this->vehiculoApart_ID;
		}
		public function getVehiculo_ID(){
			return $this->vehiculo_ID;
		}
		public function getPlaca(){
			return $this->placa;
		}
		public function getPersona_ID(){
			return $this->persona_ID;
		}
		public function getBloque_ID(){
			return $this->bloque_ID;
		}

		public function getApart_ID(){
			return $this->apart_ID;
		}

		
		public function consultar($vehiculoApart_ID='') {
			if($vehiculoApart_ID !=''):
				$this->query = "
			SELECT	vehiculoApart_ID, vehiculo_ID, placa, persona_ID, bloque_ID, apart_ID 
			FROM 	vehiculo_apart
			WHERE vehiculoApart_ID='$vehiculoApart_ID' 
			ORDER BY  vehiculoApart_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}			
		
		public function listaVehiculoApart() {
			$this->query = "
			SELECT vehiculoApart_ID, v.vehiculo_Descrip, placa, p.persona_Nomb, b.bloque_Descrip, a.apart_Sigla FROM vehiculo_apart as u inner join vehiculo as v ON (u.vehiculo_ID = v.vehiculo_ID) inner join persona  as p ON (u.persona_ID = p.persona_ID) inner join bloque  as b ON (u.bloque_ID = b.bloque_ID) inner join apartamento  as a ON (a.apart_ID = u.apart_ID) order by  vehiculoApart_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;

		}
		public function nuevo($datos=array()) {
			if(array_key_exists('vehiculoApart_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO `vehiculo_apart` 
					(`vehiculoApart_ID`, `vehiculo_ID`, `placa`, `persona_ID`, `bloque_ID`, `apart_ID`) 
					VALUES (NULL, '$vehiculo_ID', '$placa', '$persona_ID', '$bloque_ID', '$apart_ID');
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
			UPDATE vehiculo_apart 
			SET    vehiculoApart_ID = '$vehiculoApart_ID',
			 	   vehiculo_ID = '$vehiculo_ID', 
			 	   placa = '$placa', 
			 	   persona_ID = '$persona_ID',
			 	   bloque_ID = '$bloque_ID',
			 	   apart_ID = '$apart_ID' 
			WHERE vehiculoApart_ID ='$vehiculoApart_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($vehiculoApart_ID='') {
			$this->query = "
			DELETE FROM vehiculo_apart 
			WHERE vehiculoApart_ID = '$vehiculoApart_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}

		function __destruct() {
			//unset($this);
		}
		
	}
?>