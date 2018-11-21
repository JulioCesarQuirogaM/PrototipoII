<?php
    require_once("modeloAbstractoDB.php");
	
    class Bloque extends ModeloAbstractoDB {
        private $bloque_ID;
        private $unidadres_ID;
        private $bloque_Descrip;
		private $estado_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getBloque_ID(){
			return $this->bloque_ID;
		}
		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
		public function getBloque_Descrip(){
			return $this->bloque_Descrip;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}
		
		public function consultar($bloque_ID='') {
			if($bloque_ID !=''):
				$this->query = "
				SELECT bloque_ID, unidadres_ID, bloque_Descrip, estado_ID 
				FROM bloque 
				WHERE bloque_ID='$bloque_ID' order by bloque_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}	
		
		
		public function listaBloque() {
			$this->query = "
			SELECT bloque_ID, m.unidadres_Nomb, bloque_Descrip, e.estado 
			FROM bloque as u 
			inner join	uni_residencial as m ON (u.unidadres_ID = m.unidadres_ID)
			inner join estadogeneral as e ON (u.estado_ID = e.estado_ID)
			 order by bloque_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('bloque_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO bloque
					(bloque_ID, unidadres_ID, bloque_Descrip, estado_ID)
					VALUES
					(NULL, '$unidadres_ID','$bloque_Descrip', '$estado_ID')
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
			UPDATE bloque 
			SET bloque_ID = '$bloque_ID', 
			unidadres_ID = '$unidadres_ID', 
			bloque_Descrip = '$bloque_Descrip', 
			estado_ID = '$estado_ID' 
			WHERE bloque_ID = '$bloque_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($bloque_ID='') {
			$this->query = "
			DELETE FROM bloque 
			WHERE bloque_ID = '$bloque_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>