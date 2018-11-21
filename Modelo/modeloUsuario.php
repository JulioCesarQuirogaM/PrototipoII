<?php
    require_once("modeloAbstractoDB.php");
	
    class Usuario extends ModeloAbstractoDB {
        private $usuario_ID;
		private $usuario_pwd;		
		private $rol_ID;
		private $persona_ID;
        
        
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getUsuario_ID(){
			return $this->usuario_ID;
		}

		public function getUsuario_pwd(){
			return $this->usuario_pwd;
		}
		
		public function getRol_ID(){
			return $this->rol_ID;
        }
		
		public function getPersona_ID(){
			return $this->persona_ID;
        }
		
		public function consultar($datos = array()) {
			
			$usuario = $datos['usuario'];
			$password = $datos['password'];
			//$rol = $datos['rol'];

            $this->query = "
            SELECT usuario_ID, usuario_pwd, rol_ID, persona_ID 
            FROM usuario
            WHERE usuario_ID = '$usuario'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT comu_codi, comu_nomb, m.muni_nomb
			FROM tb_comuna as c inner join tb_municipio as m
			ON (c.muni_codi = m.muni_codi) order by comu_codi
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function listaUsuario() {
			$this->query = "
			SELECT usuario_ID, usuario_pwd, rol_ID, apart_ID
			FROM usuario as m order by usuario_ID
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
			if(array_key_exists('usuario_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO tb_usuario
					(usuario_id, usua_user, usuario_nombre, usuario_pwd,rol_id,update_at)
					VALUES
					(NULL, '$comu_nomb', '$muni_codi',NOW())
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
			UPDATE tb_comuna
			SET comu_nomb ='$comu_nomb',
			muni_codi ='$muni_codi',
			update_at = NOW()
			WHERE comu_codi = '$comu_codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($comu_codi='') {
			$this->query = "
			DELETE FROM tb_comuna
			WHERE comu_codi = '$comu_codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>