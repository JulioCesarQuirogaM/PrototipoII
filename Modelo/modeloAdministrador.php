<?php
    require_once("modeloAbstractoDB.php");
	
    class Persona extends ModeloAbstractoDB {
        
		private $persona_ID; 
		private $ciudad_ID;
		private $persona_Nomb; 
		private $persona_Apel;
		private $fecha_reg;
		private $persona_Sexo;
		private $persona_Dir;
		private $persona_Tel;
		private $persona_Cel;
		private $persona_Mail;
		private $persona_Estado_Civil;
		private $imagen;
		private $Persona_Estado;



		
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
		public function getFecha_reg(){
			return $this->fecha_reg;
		}
		public function getPersona_Sexo(){
			return $this->persona_Sexo;
		}
		public function getPersona_Dir(){
			return $this->persona_Dir;
		}
		public function getPersona_Tel(){
			return $this->persona_Tel;
		}

		public function getPersona_Cel(){
			return $this->persona_Cel;
		}
		public function getPersona_Mail(){
			return $this->persona_Mail;
		}
		public function getPersona_Estado_Civil(){
			return $this->persona_Estado_Civil;
		}
		public function getImagen(){
			return $this->imagen;
		}
		
		public function getPersona_Estado(){
			return $this->Persona_Estado;
		}
        
        

		
		public function consultar($datos = array()) {
			
			//$usuario = $datos['usuario'];
			//$password = $datos['password'];
            $this->query = "
            SELECT persona_ID,ciudad_ID,persona_Nomb,persona_Apel,fecha_reg,persona_Sexo,persona_Dir,persona_Tel,persona_Cel,persona_Mail,persona_Estado_Civil,imagen, Persona_Estado FROM persona where persona_ID='$persona_ID'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function listaPersona() {
			$this->query = "
			SELECT persona_ID, CONCAT (CONCAT(persona_Nomb,' '),persona_Apel) as Nombres
			FROM persona as m order by persona_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
        
		public function nuevo($datos=array()) {
			if(array_key_exists('usua_codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO persona (persona_ID, ciudad_ID, persona_Nomb, persona_Apel, fecha_reg, persona_Sexo, persona_Dir, persona_Tel, persona_Cel, persona_Mail, persona_Estado_Civil, imagen, Persona_Estado) VALUES ($persona_ID, '$ciudad_ID', '$persona_Nomb', '$persona_Apel', '$fecha_reg', '$persona_Sexo', '$persona_Dir', '$persona_Tel', '$persona_Cel', '$persona_Mail', '$persona_Estado_Civil', '$imagen', '$Persona_Estado');
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
			UPDATE persona SET persona_ID = 'persona_ID',
			 ciudad_ID = '$ciudad_ID', 
			 persona_Nomb = '$persona_Nomb', 
			 persona_Apel = '$persona_Apel',
			 fecha_reg = '$fecha_reg',
			 persona_Sexo = '$persona_Sexo', 
			 persona_Dir = '$persona_Dir', 
			 persona_Tel = '$persona_Tel', 
			 persona_Cel = '$persona_Cel', 
			 persona_Mail = '$persona_Mail', 
			 persona_Estado_Civil = '$persona_Estado_Civil', 
			 imagen = '$imagen', 
			 Persona_Estado = '$Persona_Estado' 
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
		
		/*function __destruct() {
			//unset($this);
		}*/
	}
?>