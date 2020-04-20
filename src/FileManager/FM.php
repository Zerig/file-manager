<?php
namespace FileManager;

class FM{
	public $arrayFF;


	public function __construct($array_ff){
		$array_ff = (is_array($array_ff))? $array_ff : [$array_ff];

		foreach($array_ff as $ff){
			if(is_a($ff, "\FileManager\FF"))	$this->arrayFF[] = $ff;
		}
	}

	public function get($obj = null){
		if($obj == null) 		return $this->arrayFF;
		if($obj == "files") 	return self::getFiles();
		if($obj == "folders") 	return self::getFolders();
	}

	public function getExist($obj = null){
		$array_exist_ff = [];
		foreach($this->arrayFF as $ff){
			if($ff->exist()) $array_exist_ff[] = $ff;
		}

		if($obj == null)	return $array_exist_ff;
		if($obj == "files"){
			$fm = new FM($array_exist_ff);
							return $fm->get("files");
		}
		if($obj == "folders"){
			$fm = new FM($array_exist_ff);
							return $fm->get("folders");
		}

	}

	private function getFiles(){
		$array_file = [];
		foreach($this->arrayFF as $ff){
			if(is_a($ff, "\FileManager\File")) $array_file[] = $ff;
		}

		return $array_file;
	}

	private function getFolders(){
		$array_folder = [];
		foreach($this->arrayFF as $ff){
			if(is_a($ff, "\FileManager\Folder")) $array_folder[] = $ff;
		}

		return $array_folder;
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
			if(is_a($ff, "\FileManager\FF")) array_push($this->arrayFF, $ff);
		}
	}









	/*
	 * $array_ff [array of \FileManager\FF]
	 */
	public function filter($filter, $type = 1, $key = "name"){
		$filtered_array_positive = [];
		$filtered_array_negative = [];

		foreach($this->arrayFF as $ff){
			if($ff->filter($filter, $key)) 	$filtered_array_positive[] = $ff;
			else   							$filtered_array_negative[] = $ff;
		}

		return ($type)? $filtered_array_positive : $filtered_array_negative;
	}






	public function delete(){
		foreach($this->$arrayFF as $ff){
			$ff->delete();
		}
	}


	public function move($new_dir){
		foreach($this->$arrayFF as $ff){
			$ff->move($new_dir);
		}
	}



}
