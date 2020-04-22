<?php
namespace FileManager;

class FM{
	public $arrayFF = [];

	function __clone(){
		$clone_arrayFF = [];
        foreach($this->arrayFF as $ff){		$clone_arrayFF[] = clone $ff;	}
		$this->arrayFF = $clone_arrayFF;
    }


	public function __construct($array_ff = null){
		if($array_ff != null)	self::add($array_ff);
	}


	public function get($i = null){
		if(is_null($i)) 	return $this->arrayFF;
		if($i >= 0)			return $this->arrayFF[$i];
		if($i < 0)			return $this->arrayFF[self::count() + $i];

	}


	public function getExist(){
		$array_exist_ff = [];
		foreach($this->arrayFF as $ff){
			if($ff->exist()) $array_exist_ff[] = $ff;
		}

		return $array_exist_ff;
	}

	public function getNotExist(){
		$array_exist_ff = [];
		foreach($this->arrayFF as $ff){
			if(!$ff->exist()) $array_exist_ff[] = $ff;
		}

		return $array_exist_ff;
	}

	public function getFiles(){
		$array_file = [];
		foreach($this->arrayFF as $ff){
			if(is_a($ff, "\FileManager\File")) $array_file[] = $ff;
		}

		return $array_file;
	}

	public function getFolders(){
		$array_folder = [];
		foreach($this->arrayFF as $ff){
			if(is_a($ff, "\FileManager\Folder")) $array_folder[] = $ff;
		}

		return $array_folder;
	}




	public function getFilter($filter, $type = 1, $key = "name"){
		$filtered_array_positive = [];
		$filtered_array_negative = [];

		foreach($this->arrayFF as $ff){
			if($ff->filter($filter, $key)) 	$filtered_array_positive[] = $ff;
			else   							$filtered_array_negative[] = $ff;
		}

		return ($type)? $filtered_array_positive : $filtered_array_negative;
	}





	public function exist(){
		$array_exist = [];
		foreach($this->arrayFF as $ff){
			if($ff->exist()) $array_exist[] = 1;
			else  			 $array_exist[] = 0;
		}
		return $array_exist;
	}






	public function count($obj = null){
		if($obj == null) 		return count($this->arrayFF);
		if($obj == "files") 	return count(self::getFiles());
		if($obj == "folders") 	return count(self::getFolders());
	}

	/* POP
	 * remove last part of url PATH

	 * @times [int]		How many time
	 */
	public function pop($times = 1){
		for($i = 0; $i < $times; $i++){
			array_pop($this->arrayFF);
		}
	}

	/* PUSH
	 * remove first part of url PATH

	 * @times [int]		How many time
	 */
	public function shift($times = 1){
		for($i = 0; $i < $times; $i++){
			array_shift($this->arrayFF);
		}
	}


	public function add($array_ff){
		$array_ff = (is_array($array_ff))? $array_ff : [$array_ff];
		foreach($array_ff as $ff){
			if(is_a($ff, "\FileManager\FF")) $this->arrayFF[] = $ff;
		}
	}












	public function remove($fm = null){
		if(is_null($fm)){
			$return = new \FileManager\FM($this->arrayFF);
			$this->arrayFF = [];
			return $return;
		}else{
			$fm = (is_a($fm, "\FileManager\FF"))? [$fm] : $fm;
			$fm = (is_array($fm))? new \FileMAnager\FM($fm) : $fm;
			$new_arrayFF = [];
			$return_arrayFF = [];

			foreach($this->arrayFF as $ff){
				$save = true;
				foreach($fm->get() as $f){
					if($ff->url->getString() == $f->url->getString()) $save = false;
				}
				if($save) 	$new_arrayFF[] = $ff;
				else  		$return_arrayFF[] = $ff;
			}

			$return = new \FileManager\FM($return_arrayFF);
			$this->arrayFF = $new_arrayFF;
			return $return;
		}
	}


	public function removeNotExist(){
		$return = new \FileManager\FM(self::getNotExist());
		$this->arrayFF = self::getExist();
		return $return;
	}

	public function removeExist(){
		$return = new \FileManager\FM(self::getExist());
		$this->arrayFF = self::getNotExist();
		return $return;
	}

	public function removeFiles(){
		$return = new \FileManager\FM(self::getFiles());	// return what was removed
		$this->arrayFF = self::getFolders();
		return $return;
	}

	public function removeFolders(){
		$return = new \FileManager\FM(self::getFolders());	// return what was removed
		$this->arrayFF = self::getFiles();
		return $return;
	}



	public function removeFilter($filter, $type = 1, $key = "name"){
		$return = new \FileManager\FM(self::getFilter($filter, !$type, $key));	// return what was removed
		$this->arrayFF = self::getFilter($filter, $type, $key);
		return $return;
	}









	public function delete(){
		foreach($this->arrayFF as $ff){
			$ff->delete();
		}
	}




	public function move($new_dir){
		foreach($this->arrayFF as $ff){
			$ff->move($new_dir);
		}

	}


	public function upload($local_files_fm){

		if($local_files_fm->count() == self::count()){
			$i = 0;
			foreach($this->arrayFF as $ff){
				$ff->upload($local_files_fm->get()[$i]);
				$i++;
			}

		}
	}


}
