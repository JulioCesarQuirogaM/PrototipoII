<?php
    require_once("modeloAbstractoDB.php");
	
    class vigilante extends ModeloAbstractoDB {
        private $vigilante_ID;
        private $unidadres_ID;
        private $vigilante_Nomb;
        private $vigilante_Apel;
		private $objeto_ID;
		private $fecha_Ingreso
		private $fecha_Salida;
		function __construct() {
			//$this->db_name = '';
		}

		public function getVigilante_ID(){
			return $this->vigilante_ID;
		}
		public function getUnidadres_ID(){
			return $this->ciudad_ID;
		}
		public function getVigilante_Nomb(){
			return $this->vigilante_Nomb;
		}
		public function getVigilante_Apel(){
			return $this->vigilante_Apel;
		}
		public function getObjeto_ID(){
			return $this->objeto_ID;
		}
		
		public function getFecha_Ingreso(){
			return $this->fecha_Ingreso;
		}
		}
		public function getFecha_Salida(){
			return $this->fecha_Salida;
		}


		


		
		public function consultar($datos = array()) {
            $this->query = "
	SELECT vigilante_ID,unidadres_ID,vigilante_Nomb,vigilante_Apel,objeto_ID,fecha_Ingreso,fecha_Salida FROM vigilante WHERE vigilante_ID='$vigilante_ID'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		
		
		public function listaVigilante() {
			$this->query = "
			SELECT vigilante_ID,unidadres_ID,vigilante_Nomb,vigilante_Apel,objeto_ID,fecha_Ingreso,fecha_Salida
			FROM vigilante as u order by vigilante_ID
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}


		public function nuevo($datos=array()) {
			if(array_key_exists('vigilante_ID', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO vigilante_ID,unidadres_ID,vigilante_Nomb,vigilante_Apel,objeto_ID,fecha_Ingreso,fecha_Salida VALUES ('$vigilante_ID','$unidadres_ID','$vigilante_Nomb','$vigilante_Apel','$objeto_ID','$fecha_Ingreso','$fecha_Salida')
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
			UPDATE vigilante SET vigilante_ID = '$vigilante_ID',
			 unidadres_ID = '$unidadres_ID',
			 vigilante_Nomb = '$vigilante_Nomb',
			 vigilante_Apel = '$vigilante_Apel',
			 objeto_ID = '$objeto_ID', 
			 fecha_Ingreso = '$fecha_Ingreso', 
		     fecha_Salida = '$fecha_Salida'
		      WHERE vigilante_ID = $vigilante_ID;
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($vigilante_ID='') {
			$this->query = "
			DELETE FROM vigilante 
			WHERE vigilante_ID = $vigilante_ID
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;

		}
		
	}
?>