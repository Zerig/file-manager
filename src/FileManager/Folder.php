<?php
namespace FileManager;


class Folder extends FF{
	public $url;			// UrlParser\Url::www/_img/folder
	public $size;			// 79949
	public $name;			// folder
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/



	public function __construct($folder_url){
		parent::__construct($folder_url);	// SET obj without existing Folder
		if(self::exist())	parent::set($folder_url);
	}



	public function copy($copy_name = null){
		$from_folder_url =	$this->url;
		$to_folder_url =	clone $this->dir;

		// IF we have a COPY name, or NOT
		if(is_null($copy_name))		$to_folder_url->addPath($this->name."-copy");
		else   						$to_folder_url->addPath($copy_name);

		//if(!$overwrite && folder_exists($to_folder_url))	return null;

		self::recurseCopy($from_folder_url->getString(), $to_folder_url->getString());
		return new Folder($to_folder_url);
	}


	private function recurseCopy($src,$dst){
	    $dir = opendir($src);
	    @mkdir($dst);
	    while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' )) {
	            if ( is_dir($src . '/' . $file) ) {
	                self::recurseCopy($src . '/' . $file,$dst . '/' . $file);
	            }
	            else {
	                copy($src . '/' . $file,$dst . '/' . $file);
	            }
	        }
	    }
	    closedir($dir);
	}


	public function delete(){
		$array_obj_child = self::scan();

		// FOREACH scan actual FOLDER
		foreach($array_obj_child as $child){
			$child->delete();		// delete folder::delete() / delete file::delete() :D
			unset($child);
		}

		// delete only IF folder is empty
		if(empty(self::scan()))	rmdir($this->url);
	}



	public function clean(){
		foreach(self::scan() as $child){
			$child->delete();
		}
	}



	public function scan(){
		$array_file = array_diff( scandir($this->url), array('..', '.') );
		$array_obj_file = [];

		foreach($array_file as $file){
			$file_url = new Url([$this->url, $file]);

			$array_obj_file[] = (is_dir($file_url->path))? new Folder($file_url->path) : new File($file_url->path);
		}

		return $array_obj_file;
	}



	public function scanTree(){
		$array_obj_child = self::scan();
		$array_tree = [];


		foreach($array_obj_child as $child){
			// IF finded children is FOLDER
			if(is_dir($child->url) && !empty($child->scan()) ){
				$array_tree[] = [$child, $child->scanTree()];

			}else{
				$array_tree[] = $child;		// file or empty folder
			}

		}

		return $array_tree;
	}



}
