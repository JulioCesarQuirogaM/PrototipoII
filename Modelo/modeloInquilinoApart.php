<?php
    require_once("modeloAbstractoDB.php");
	
    class InquilinoApart extends ModeloAbstractoDB {
        private $inquilinoApart_ID;
        private $unidadres_ID;
        private $apart_ID;
		private $persona_ID;
		//private $propietarioApart_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getInquilinoApart_ID(){
			return $this->inquilinoApart_ID;
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
		/*public function getPropietarioApart_ID(){
			return $this->propietarioApart_ID;
		}*/

		public function consultar($inquilinoApart_ID='') {
			if($inquilinoApart_ID !=''):
				$this->query = "
				SELECT inquilinoApart_ID,unidadres_ID,apart_ID,persona_ID 
				FROM inquilino_apart 
				WHERE inquilinoApart_ID='$inquilinoApart_ID' order by inquilinoApart_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}		
		
		public function listaInquilinoApart() {
			$this->query = "
			SELECT inquilinoApart_ID, u.unidadres_Nomb, a.apart_Sigla, p.persona_Nomb FROM inquilino_apart as i inner join uni_residencial as u ON (i.unidadres_ID = u.unidadres_ID) inner join apartamento  as a ON (a.apart_ID = i.apart_ID) inner join persona  as p ON (p.persona_ID  = i.persona_ID) order by  inquilinoApart_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;

		}
		public function nuevo($datos=array()) {
			if(array_key_exists('inquilinoApart_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO inquilino_apart
					(inquilinoApart_ID, unidadres_ID, apart_ID, persona_ID )
					VALUES (NULL, '$unidadres_ID','$apart_ID', '$persona_ID')
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
			UPDATE inquilino_apart 
			SET    inquilinoApart_ID = '$inquilinoApart_ID',
			 	   unidadres_ID = '$unidadres_ID', 
			 	   apart_ID = '$apart_ID', 
			 	   persona_ID = '$persona_ID'
			 	   
			WHERE inquilinoApart_ID='$inquilinoApart_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($inquilinoApart_ID='') {
			$this->query = "
			DELETE FROM inquilino_apart 
			WHERE inquilinoApart_ID = '$inquilinoApart_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}

		function __destruct() {
			//unset($this);
		}
		
	}
?>