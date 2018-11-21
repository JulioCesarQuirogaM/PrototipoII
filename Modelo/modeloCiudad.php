<?php
    require_once("modeloAbstractoDB.php");
	
    class Ciudad extends ModeloAbstractoDB {
        private $ciudad_ID;
        private $ciudad_Nomb;
        private $pais_ID;
		private $estado_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getCiudad_ID(){
			return $this->ciudad_ID;
		}
		public function getCiudad_Nomb(){
			return $this->ciudad_Nomb;
		}
		public function getPais_ID(){
			return $this->pais_ID;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}
		
		public function consultar($ciudad_ID='') {
			if($ciudad_ID !=''):
				$this->query = "
				SELECT ciudad_ID, ciudad_Nomb, pais_ID, estado_ID 
				FROM ciudad 
				WHERE ciudad_ID = '$ciudad_ID' order by ciudad_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}	
		
		
		public function listaCiudad() {
			$this->query = "
			SELECT ciudad_ID, ciudad_Nomb, p.pais_Nomb, e.estado 
			FROM ciudad as c 
			inner join pais as p ON (c.pais_ID = p.pais_ID)
			inner join estadogeneral as e 
			ON (c.estado_ID = e.estado_ID)
			order by ciudad_ID
			";

			
			$this->obtener_resultados_query();
			return $this->rows;
		}


		public function nuevo($datos=array()) {
			if(array_key_exists('ciudad_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO ciudad 
					(ciudad_ID, ciudad_Nomb, pais_ID, estado_ID) 
					VALUES (NULL, '$ciudad_Nomb', '$pais_ID', '$estado_ID')
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
			UPDATE  ciudad 
			SET 	ciudad_ID = '$ciudad_ID',
				 	ciudad_Nomb = '$ciudad_Nomb',
				 	pais_ID = '$pais_ID', 
				 	estado_ID = '$estado_ID' 
			WHERE 	ciudad_ID = '$ciudad_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($ciudad_ID='') {
			$this->query = "
			DELETE FROM ciudad 
			WHERE ciudad_ID = '$ciudad_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>