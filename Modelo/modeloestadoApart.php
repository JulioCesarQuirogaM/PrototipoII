<?php
    require_once("modeloAbstractoDB.php");
	
    class estApar extends ModeloAbstractoDB {
        private $aparEstado_ID;
        private $unidadres_ID;
        private $apart_ID;
		private $persona_ID;
		private $apartamento_Estado;
		function __construct() {
			//$this->db_name = '';
		}

		public function getAparEstado_ID(){
			return $this->aparEstado_ID;
		}
		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
		public function getApart_ID(){
			return $this->apart_ID;
		}
		public function getPersona_ID(){
			return $this->persona_ID;
		}
		public function getApartamento_Estado(){
			return $this->apartamento_Estado;
		}
		
		public function consultar($datos = array()) {
            $this->query = "
	SELECT aparEstado_ID,unidadres_ID,apart_ID,persona_ID,apartamento_Estado FROM estadoapart WHERE aparEstado_ID='$aparEstado_ID'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaEstApart() {
			$this->query = "
			SELECT aparEstado_ID,unidadres_ID,apart_ID,persona_ID,apartamento_Estado FROM estadoapart as u order by aparEstado_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function nuevo($datos=array()) {
			if(array_key_exists('apart_ID	', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO estadoapart (aparEstado_ID, unidadres_ID, apart_ID, persona_ID, apartamento_Estado) VALUES ('$aparEstado_ID', '$unidadres_ID', '$apart_ID', '$persona_ID', '$apartamento_Estado');
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
			UPDATE estadoapart SET aparEstado_ID = 'aparEstado_ID', 
			unidadres_ID = 'unidadres_ID', 
			apart_ID='apart_ID'
			persona_ID = 'persona_ID',
			apartamento_Estado = 'apartamento_Estado' WHERE aparEstado_ID = '$estadoapart';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($aparEstado_ID='') {
			$this->query = "
			DELETE FROM estadoapart 
			WHERE aparEstado_ID = '$aparEstado_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}

		function __destruct() {
			//unset($this);
		}
		
	}
?>