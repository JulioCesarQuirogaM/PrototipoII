<?php
    require_once("modeloAbstractoDB.php");
	
    class Apartamento extends ModeloAbstractoDB {
        private $apart_ID;
        private $unidadres_ID;
        private $bloque_ID;
		private $apart_Sigla;
		private $estado_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getApart_ID(){
			return $this->apart_ID;
		}
		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
		public function getBloque_ID(){
			return $this->bloque_ID;
		}
		public function getApart_Sigla(){
			return $this->apart_Sigla;
		}
		public function getEstado_ID(){
			return $this->estado_ID;
		}

		public function consultar($apart_ID='') {
			if($apart_ID !=''):
				$this->query = "
				SELECT apart_ID,unidadres_ID,bloque_ID,apart_Sigla,estado_ID 
				FROM apartamento 
				WHERE apart_ID='$apart_ID' order by apart_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}		
		
		public function listaApartamento() {
			$this->query = "
			SELECT apart_ID, m.unidadres_Nomb, c.bloque_Descrip, apart_Sigla, e.estado 
			FROM apartamento as u 
			inner join uni_residencial as m ON (u.unidadres_ID = m.unidadres_ID) 
			inner join bloque  as c ON (c.bloque_ID = u.bloque_ID) 
			inner JOIN estadogeneral as e ON (e.estado_ID = u.estado_ID) 
			order by  apart_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;

		}
		public function nuevo($datos=array()) {
			if(array_key_exists('apart_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO apartamento
					(apart_ID, unidadres_ID, bloque_ID, apart_Sigla, estado_ID )
					VALUES
					(NULL, '$unidadres_ID','$bloque_ID', '$apart_Sigla', '$estado_ID')
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
			UPDATE apartamento 
			SET    apart_ID = '$apart_ID',
			 	   unidadres_ID = '$unidadres_ID', 
			 	   bloque_ID = '$bloque_ID', 
			 	   apart_Sigla = '$apart_Sigla',
			 	   estado_ID = '$estado_ID' 
			WHERE apart_ID='$apart_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($apart_ID='') {
			$this->query = "
			DELETE FROM apartamento 
			WHERE apart_ID = '$apart_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}

		function __destruct() {
			//unset($this);
		}
		
	}
?>