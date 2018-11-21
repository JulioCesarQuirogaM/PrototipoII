<?php
    require_once("modeloAbstractoDB.php");
	
    class Persona extends ModeloAbstractoDB {
		private $persona_ID;
		private $ciudad_ID;
		private $persona_Nomb;
		private $persona_Apel;
		private $sexo;
		private $persona_Cel;
		private $persona_Mail;
		private $apart_ID;
		private $rol_ID;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getPersona_ID(){
			return $this->persona_ID;
		}

		public function getCiudad_ID(){
			return $this->ciudad_ID;
		}
		
		public function getPersona_Nomb(){
			return $this->persona_Nomb;
		}

		public function getPersona_Apel(){
			return $this->persona_Apel;
		}

		public function getSexo(){
			return $this->sexo;
		}
		
		public function getPersona_Cel(){
			return $this->persona_Cel;
		}

		public function getPersona_Mail(){
			return $this->persona_Mail;
		}
		
		public function getApart_ID(){
			return $this->apart_ID;
		}

		public function getRol_ID(){
			return $this->rol_ID;
		}
		
		

		public function consultar($persona_ID='') {
			if($persona_ID !=''):
				$this->query = "
				SELECT persona_ID, ciudad_ID, persona_Nomb, persona_Apel, sexo, persona_Cel, persona_Mail, apart_ID, rol_ID 
				FROM persona 
				WHERE persona_ID = '$persona_ID' order by persona_Nomb
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function listaPersona() {
			$this->query = "
			SELECT p.persona_ID, c.ciudad_Nomb, p.persona_Nomb, p.persona_Apel, p.sexo, p.persona_Cel, p.persona_Mail, a.apart_Sigla, r.rol_Descripcion
			FROM persona as p 
			INNER JOIN ciudad as c ON (p.ciudad_ID = c.ciudad_ID)
			INNER JOIN apartamento as a ON (p.apart_ID = a.apart_ID)
			INNER JOIN rol as r ON (p.rol_ID = r.rol_ID)
			ORDER BY persona_Nomb

			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('persona_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;	
				$this->query = "
					INSERT INTO persona
					(persona_ID, ciudad_ID, persona_Nomb, persona_Apel, sexo, persona_Cel, persona_Mail, apart_ID, rol_ID)
					 VALUES ('$persona_ID' , '$ciudad_ID','$persona_Nomb', '$persona_Apel', '$sexo',  '$persona_Cel', '$persona_Mail', '$apart_ID', '$rol_ID')
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
			UPDATE persona
			SET persona_ID = '$persona_ID',
			ciudad_ID = '$ciudad_ID',
			persona_Nomb = '$persona_Nomb',
			persona_Apel = '$persona_Apel',
			sexo = '$sexo',
			persona_Cel = '$persona_Cel',
			persona_Mail = '$persona_Mail',
			apart_ID = '$apart_ID',
			rol_ID = '$rol_ID'
			WHERE persona_ID = '$persona_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($persona_ID='') {
			$this->query = "
			DELETE FROM persona
			WHERE persona_ID = '$persona_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>