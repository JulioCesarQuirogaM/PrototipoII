<?php
    require_once("modeloAbstractoDB.php");
	
    class usuario extends ModeloAbstractoDB {
        private $usuario_ID;
        private $unidadres_ID;
        private $persona_ID;
		private $rol_ID;
		private $usuario_Login;
        private $usuario_Pass;
        private $imagen;
		private $usuario_Estado;
		private $persona_Nomb;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getUsuario_ID(){
			return $this->usuario_ID;
		}
		public function getUnidadres_ID(){
			return $this->unidadres_ID;
		}
        
        public function getPersona_ID(){
			return $this->persona_ID;
		}

		public function getRol_ID(){
			return $this->rol_ID;
		}

		public function getUsuario_Login(){
			return $this->usuario_Login;
		}
		
		public function getUsuario_Pass(){
			return $this->usuario_Pass;
        }
        
        public function getImagen(){
			return $this->imagen;
		}
		 public function getUsuario_Estado(){
			return $this->usuario_Estado;
		}
		public function getPersona_Nomb(){
			return $this->persona_Nomb;
		}


		
		public function consultar($datos = array()) {
			
			$usuario = $datos['usuario'];
			$password = $datos['password'];
            $this->query = "
	SELECT u.usuario_ID, u.persona_ID, u.usuario_Login,p.imagen, u.usuario_Pass, u.usuario_Estado, p.persona_Nomb FROM usuario as u, persona as p WHERE p.persona_ID=u.persona_ID AND u.usuario_Login='$usuario'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		public function listaRol() {
			$this->query = "
			SELECT rol_ID, rol_Descripcion 
			FROM rol as m order by rol_Descripcion
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listaUnidad() {
			$this->query = "
			SELECT unidadres_ID, unidadres_Nomb 
			FROM uni_residencial as u order by unidadres_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listaPersona() {
			$this->query = "
			SELECT c.usuario_ID,c.unidadres_ID,c.persona_ID,c.rol_ID,c.usuario_Login,c.usuario_Pass,c.usuario_Estado,n.persona_Nomb from usuario as c INNER JOIN persona as n on (c.persona_ID=n.persona_ID) order by persona_ID			
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaUsuario() {
			$this->query = "
			SELECT c.usuario_ID,c.unidadres_ID,c.persona_ID,c.rol_ID,c.usuario_Login,c.usuario_Pass,c.usuario_Estado,n.persona_Nomb from usuario as c INNER JOIN persona as n on (c.persona_ID=n.persona_ID) order by usuario_ID			
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
        
        public function listaVigilante() {
			$this->query = "
			SELECT c.vigilante_ID,c.unidadres_ID,c.vigilante_Nomb,c.vigilante_Apel,c.fecha_Ingreso,c.fecha_Salida,n.objeto_Descrip from vigilante as c INNER JOIN objeto as n on (c.objeto_ID=n.objeto_ID) order by vigilante_ID			
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
        public function generarPassword($pass=""){
            $opciones = [
                'cost' => 12,
            ];
            
            $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);
            
            return $passwordHashed;
        }

		public function nuevo($datos=array()) {
			if(array_key_exists('usuario_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO usuario (usuario_ID, unidadres_ID, persona_ID, rol_ID, usuario_Login, usuario_Pass, usuario_Estado) VALUES (NULL, '$unidadres_ID', '$persona_ID', '$rol_ID', '$usuario_Login', '$usuario_Pass', '$usuario_Estado');
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
			UPDATE usuario
			SET unidadres_ID ='$unidadres_ID',
			    persona_ID ='$persona_ID',
			    rol_ID ='$rol_ID', usuario_Login ='$usuario_Login',
			    usuario_Pass ='$usuario_Pass', usuario_Estado ='$usuario_Estado'
			WHERE usuario_ID = '$usuario_ID'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($usuario_ID='') {
			$this->query = "
			DELETE FROM usuario
			WHERE usuario_ID = '$usuario_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
		/*function __destruct() {
			//unset($this);
		}*/
	}
?>