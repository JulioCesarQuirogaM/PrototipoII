<?php
    require_once("modeloAbstractoDB.php");
	
    class Pais extends ModeloAbstractoDB {
        private $pais_ID;
        private $pais_Nomb;
		private $estado_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getPais_ID(){
			return $this->pais_ID;
		}
		
		public function getPais_Nomb(){
			return $this->pais_Nomb;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}
		
		public function consultar($pais_ID='') {
			if($pais_ID !=''):
				$this->query = "
				SELECT pais_ID, pais_Nomb, estado_ID 
				FROM pais 
				WHERE pais_ID = '$pais_ID' order by pais_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaPais() {
			$this->query = "
			SELECT pais_ID, pais_Nomb, e.estado
			FROM pais as p
			inner join estadogeneral as e ON(p.estado_ID = e.estado_ID)
			order by pais_ID
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
					(pais_ID, pais_Nomb, estado_ID)
					VALUES
					(NULL, '$pais_Nomb', '$estado_ID')
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
			 	estado_ID = '$estado_ID' 
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