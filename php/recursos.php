<?php  
	

	include 'config/Database.connect.php';
	

	class Recursos extends Connect
	{
		public function Query($select){
			$this->query =  mysqli_query($this->connect,$select) or die(mysqli_error($this->connect));
			return $this->query;
		}
		public function fetch_array($query,$callback){
			while($this->fect =  mysqli_fetch_array($query)){
				 $callback($this->fect);
			}
		}
		public function login($query,$callback,$callback2){
			if(mysqli_num_rows($query) > 0){
				while($this->fect =  mysqli_fetch_array($query)){
					$update =  $this->query('update usuario set acesso= now() where id_usuario ='.$this->fect[0].' ');
				 	$callback($this->fect);
				}
			}else{
				$callback2();
			}
		}
		public function paginação($query,$select,$pagina,$callback,$callback2){

			$this->linhas = mysqli_num_rows($query);
			$this->registros = $GLOBALS['config']['quantidade_registros'] ;
			$this->paginas = ceil($this->linhas/$this->registros);
			$this->começo = ($this->registros*$pagina) - $this->registros;
			$this->produtos =  mysqli_query($this->connect,"".$select." limit $this->começo,$this->registros");
    		$this->total = mysqli_num_rows($this->produtos);

    		while($this->fect =  mysqli_fetch_array($this->produtos)){
				 $callback($this->fect);
			}

			$callback2($this->paginas);

		}
		public function data_diferença($data1,$data2){
			  $this->datatime1 = new DateTime($data1);
		      $this->datatime2 = new DateTime($data2);
		      $this->data1  = $this->datatime1->format('Y-m-d H:i:s');
		      $this->data2  = $this->datatime2->format('Y-m-d H:i:s');
		      $this->diff = $this->datatime1->diff($this->datatime2);
		     
		     return $this->horas =  ($this->diff->days) . ' - Dias';
		}
		public function diferença_km($km1,$km2){
			$diferença = ceil($km1 - $km2);
			return $diferença. ' - Km aproximado';
		}
		public function contador_registros($select){
			$this->query =  mysqli_query($this->connect,$select); 
			$this->num_row = mysqli_num_rows($this->query);
			echo  $this->num_row;
		}
		public function formatdata($datatime)
		{
          return (new DateTime($datatime))->format('d/m/Y H:i:s');		
		}
	}
		
?>
