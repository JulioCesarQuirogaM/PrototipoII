<?php
    require_once("modeloAbstractoDB.php");
	
    class Estado extends ModeloAbstractoDB {
        private $estado_ID;
        private $estado;		
		function __construct() {
			//$this->db_name = '';
		}

		public function getEstado_ID(){
			return $this->estado_ID;
		}
		
		public function getEstado(){
			return $this->estado;
		}
		
		public function consultar($estado_ID='') {
			if($estado_ID !=''):
				$this->query = "
				SELECT estado_ID, estado
				FROM estadogeneral 
				WHERE estado_ID = '$estado_ID' order by estado_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaEstado() {
			$this->query = "
			SELECT estado_ID, estado 
			FROM estadogeneral 
			order by estado_ID
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('estado_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO estadogeneral
					(estado_ID, estado)
					VALUES
					(NULL, '$estado')
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
			UPDATE estadogeneral 
			SET estado_ID = '$estado_ID',
				estado = '$estado'			 	
			WHERE estado_ID = '$estado_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($estado_ID='') {
			$this->query = "
			DELETE FROM estadogeneral 
			WHERE estado_ID = '$estado_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>