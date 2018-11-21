<?php
    require_once("modeloAbstractoDB.php");
	
    class objApart extends ModeloAbstractoDB {
        private $objetoxapto_ID;
        private $objeto_ID;
        private $persona_ID;
		private $Fecha_Entrada;
		private $Fecha_salida;
		function __construct() {
			//$this->db_name = '';
		}

		public function getobjetoxapto_ID(){
			return $this->objetoxapto_ID;
		}
		public function getobjeto_ID(){
			return $this->objeto_ID;
		}
		public function getpersona_ID(){
			return $this->persona_ID;
		}
		public function getFecha_Entrada(){
			return $this->Fecha_Entrada;
		}
		public function getFecha_salida(){
			return $this->Fecha_salida;
		}
		
		public function consultar($datos = array()) {
            $this->query = "
	SELECT objetoxapto_ID,objeto_ID,persona_ID,Fecha_Entrada,Fecha_salida FROM objeto_apartamento WHERE objetoxapto_ID='$objetoxapto_ID'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaObjApart() {
			$this->query = "
			SELECT objetoxapto_ID,objeto_ID,persona_ID,Fecha_Entrada,Fecha_salida FROM objeto_apartamento as u order by objetoxapto_ID
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
					INSERT INTO objeto_apartamento (objetoxapto_ID, objeto_ID, persona_ID, Fecha_Entrada, Fecha_salida) VALUES ('$objetoxapto_ID', '$objeto_ID', '$persona_ID', '$Fecha_Entrada', '$Fecha_salida');
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
			UPDATE objeto_apartamento SET objetoxapto_ID = '$objetoxapto_ID', 
			objeto_ID = '$objeto_ID', 
			persona_ID = '$persona_ID', 
			Fecha_Entrada = '$Fecha_Entrada', 
			Fecha_salida = '$getFecha_salida' 
			WHERE objetoxapto_ID = '$objetoxapto_ID';
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($usuario_ID='') {
			$this->query = "
			DELETE FROM objetoxapto_ID 
			WHERE objetoxapto_ID = $objetoxapto_ID
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>