<?php
    require_once("modeloAbstractoDB.php");
	
    class PropietarioApart extends ModeloAbstractoDB {
        private $propietarioApart_ID;
        private $unidadres_ID;
        private $apart_ID;
		private $persona_ID;
		//private $propietarioApart_ID;
		function __construct() {
			//$this->db_name = '';
		}

		public function getPropietarioApart_ID(){
			return $this->propietarioApart_ID;
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

		public function consultar($propietarioApart_ID='') {
			if($propietarioApart_ID !=''):
				$this->query = "
				SELECT propietarioApart_ID,unidadres_ID,apart_ID,persona_ID 
				FROM propietario_apart 
				WHERE propietarioApart_ID='$propietarioApart_ID' order by propietarioApart_ID
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}		
		
		public function listaPropietarioApart() {
			$this->query = "
			SELECT propietarioApart_ID, u.unidadres_Nomb, a.apart_Sigla, p.persona_Nomb 
			FROM propietario_apart as i 
			inner join uni_residencial as u ON (i.unidadres_ID = u.unidadres_ID) 
			inner join apartamento  as a ON (a.apart_ID = i.apart_ID) 
			inner join persona  as p ON (p.persona_ID  = i.persona_ID) 
			order by  propietarioApart_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;

		}
		public function nuevo($datos=array()) {
			if(array_key_exists('propietarioApart_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO propietario_apart
					(propietarioApart_ID, unidadres_ID, apart_ID, persona_ID )
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
			UPDATE propietario_apart 
			SET    propietarioApart_ID = '$propietarioApart_ID',
			 	   unidadres_ID = '$unidadres_ID', 
			 	   apart_ID = '$apart_ID', 
			 	   persona_ID = '$persona_ID'
			 	   
			WHERE propietarioApart_ID='$propietarioApart_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($propietarioApart_ID='') {
			$this->query = "
			DELETE FROM propietario_apart 
			WHERE propietarioApart_ID = '$propietarioApart_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}

		function __destruct() {
			//unset($this);
		}
		
	}
?>