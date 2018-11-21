<?php
    require_once("modeloAbstractoDB.php");
	
    class Unidad extends ModeloAbstractoDB {
        private $unidadres_ID;
        private $ciudad_ID;
        private $unidadres_Nomb;
		private $unidadres_Dir;
		private $unidadres_Tel;
        private $estado_ID;
        
		function __construct() {
			//$this->db_name = '';
		}

		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
		public function getCiudad_ID(){
			return $this->ciudad_ID;
		}
		public function getUnidadres_Nomb(){
			return $this->unidadres_Nomb;
		}
		public function getUnidadres_Dir(){
			return $this->unidadres_Dir;
		}
		public function getUnidadres_Tel(){
			return $this->unidadres_Tel;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}	

		public function consultar($unidadres_ID='') {
			if($unidadres_ID !=''):
				$this->query = "
				SELECT unidadres_ID, ciudad_ID, unidadres_Nomb, unidadres_Dir, unidadres_Tel, estado_ID
				FROM   uni_residencial
				WHERE unidadres_ID = '$unidadres_ID' order by unidadres_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}	
		
		
		public function listaUnidad() {
			$this->query = "
			SELECT unidadres_ID, m.ciudad_Nomb, unidadres_Nomb, unidadres_Dir, unidadres_Tel, e.estado
			FROM uni_residencial as u 
			inner join ciudad as m ON (u.ciudad_ID = m.ciudad_ID)
			inner join estadogeneral as e ON (e.estado_ID = u.estado_ID)
			order by unidadres_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('unidadres_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO uni_residencial
					(unidadres_ID, ciudad_ID, unidadres_Nomb, unidadres_Dir, unidadres_Tel, estado_ID)
					VALUES
					(NULL, '$ciudad_ID','$unidadres_Nomb', '$unidadres_Dir', '$unidadres_Tel', '$estado_ID')
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
			UPDATE uni_residencial 
			SET unidadres_ID = '$unidadres_ID', 
				ciudad_ID = '$ciudad_ID', 
				unidadres_Nomb = '$unidadres_Nomb', 
				unidadres_Dir = '$unidadres_Dir', 
				unidadres_Tel = '$unidadres_Tel',
			 	estado_ID = '$estado_ID' 
			 WHERE unidadres_ID = '$unidadres_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($unidadres_ID='') {
			$this->query = "
			DELETE FROM uni_residencial 
			WHERE unidadres_ID = '$unidadres_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>