<?php
    require_once("modeloAbstractoDB.php");
	
    class ZonaP extends ModeloAbstractoDB {
        private $zonaP_ID;
        private $unidadres_ID;
        private $zonaP_Descrip;
		private $estado_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getZonaP_ID(){
			return $this->zonaP_ID;
		}
		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
		public function getZonaP_Descrip(){
			return $this->zonaP_Descrip;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}
		
		public function consultar($zonaP_ID='') {
			if($zonaP_ID !=''):
				$this->query = "
				SELECT zonaP_ID, unidadres_ID, zonaP_Descrip, estado_ID 
				FROM zona_publica 
				WHERE zonaP_ID = '$zonaP_ID' order by zonaP_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaZona() {
			$this->query = "
			SELECT zonaP_ID, m.unidadres_Nomb, zonaP_Descrip, e.estado 
			FROM zona_publica as c 
			inner join uni_residencial as m ON (c.unidadres_ID = m.unidadres_ID) 
			inner join estadogeneral as e ON (c.estado_ID = e.estado_ID)
			order by zonaP_ID
			";

			
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('zonaP_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO zona_publica
					(zonaP_ID, unidadres_ID, zonaP_Descrip, estado_ID)
					VALUES
					(NULL, '$unidadres_ID','$zonaP_Descrip', '$estado_ID')
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
			UPDATE zona_publica 
			SET zonaP_ID = '$zonaP_ID',
				unidadres_ID = '$unidadres_ID',
			 	zonaP_Descrip = '$zonaP_Descrip', 
			 	estado_ID = '$estado_ID' 
			WHERE zonaP_ID = '$zonaP_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($zonaP_ID='') {
			$this->query = "
			DELETE FROM zona_publica 
			WHERE zonaP_ID = '$zonaP_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>