<?php
    require_once("modeloAbstractoDB.php");
	
    class Rol extends ModeloAbstractoDB {
        private $rol_ID;
        private $rol_Descripcion;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getRol_ID(){
			return $this->rol_ID;
		}
		
		public function getRol_Descripcion(){
			return $this->rol_Descripcion;
		}
		
		
		public function consultar($rol_ID='') {
			if($rol_ID !=''):
				$this->query = "
				SELECT rol_ID, rol_Descripcion
				FROM rol 
				WHERE rol_ID = '$rol_ID' order by rol_Descripcion
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaRol() {
			$this->query = "
			SELECT rol_ID, rol_Descripcion
			FROM rol
			order by rol_Descripcion
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('rol_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO rol
					(rol_ID, rol_Descripcion)
					VALUES
					(NULL, '$rol_Descripcion)
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
			UPDATE rol 
			SET rol_ID = '$rol_ID',
				rol_Descripcion = '$rol_Descripcion', 
			 	 
			WHERE rol_ID = '$rol_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($rol_ID='') {
			$this->query = "
			DELETE FROM rol 
			WHERE rol_ID = '$rol_ID'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>