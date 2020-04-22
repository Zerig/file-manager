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


	public function rename($new_name){
		$source_ff = parent::rename($new_name);
		return new \FileManager\Folder($source_ff->url->getString());
	}


	public function move($new_dir){
		$source_ff = parent::move($new_dir);
		return new \FileManager\Folder($source_ff->url->getString());
	}



	public function copy($copy_name = null){
		$from_folder_url =	$this->url;
		$to_folder_url =	clone $this->dir;

		$copyFolder = (is_null($copy_name))? new \FileManager\Folder($this->url->getString()) : new \FileManager\Folder( new \UrlParser\Url([$this->dir->getString(), $copy_name]) );

		$copyFolder = self::createName($copyFolder);
		self::recurseCopy($this->url->getString(), $copyFolder->url->getString());
		return new Folder($to_folder_url);
	}



	private function createName($ff, $i = 0){
		$copy = "-copy";

		if($i > 0){
			$ff->url->pop();	// remove last part of URL (the file NAME)
			// clean name from all "-copy[num]"
			$ff->name = substr($ff->name, 0, (strpos($ff->name, $copy) == 0)? strlen($ff->name) : strpos($ff->name, $copy));
			$ff->url->addPath($ff->name.$copy.$i);	// add new "-copy[num]" with higher number

			$ff->set($ff->url->getString());	// RESET all FF object by new URL
		}

		// when NEW FILE NAME not EXIST cycling END
		$i++;
		if($ff->exist())	$ff = self::createName($ff, $i);
		return $ff;
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
		if(empty(self::scan()))	rmdir($this->url->getString());
	}



	public function clean(){
		foreach(self::scan() as $child){
			$child->delete();
		}
	}



	public function scan($column = null){
		$scanFolder = ($this->url->getString() == "")? "." : $this->url->getString();
		$array_file = array_diff( scandir($scanFolder), array('..', '.') );
		$array_obj_file = [];

		foreach($array_file as $file){
			//$file_url = new \UrlParser\Url([$this->url, $file]);
			$file_url = clone $this->url;		// \UrlParser\Url
			$file_url->addPath($file);

			if($column == null)	$array_obj_file[] = ( $file_url->isFolder() )? new Folder($file_url) : new File($file_url);
			else   				$array_obj_file[] = ( $file_url->isFolder() )? (new Folder($file_url))->$column : (new File($file_url))->$column;
		}

		return $array_obj_file;
	}



	public function scanTree($column = null){
		$array_obj_child = self::scan();	// array of \FileManager\File/Folder
		$array_tree = [];



		foreach($array_obj_child as $child){
			// IF finded children is FOLDER
			if($child->url->isFolder() && !empty($child->scan()) ){
				if($column == null) $array_tree[] = [$child, $child->scanTree($column)];
				else   				$array_tree[] = [$child->$column, $child->scanTree($column)];

			}else{
				if($column == null) $array_tree[] = $child;		// file or empty folder
				else   				$array_tree[] = $child->$column;
			}

		}

		return $array_tree;
	}




}
