<?php
namespace FileManager;


class File extends FF{
	public $url;			// www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// www/_img/


	public $filename;		// file
	public $extension;		// jpg
	public $mime;			// image/jpeg



	public function __construct($file_url){
		parent::__construct($file_url);		// SET obj without existing File
		if(self::exist())	self::set();	// WHEN FILE exist create OBJ
	}



	public function set(){
		parent::set();	// universal settings

		$path_info = pathinfo($this->url);
		$this->filename = 	$path_info["filename"];
		$this->extension =	$path_info["extension"];

		$this->mime = 		mime_content_type($this->url);
	}




	public function exist(){
		/*if(file_exists($this->url) && !is_dir($this->url))	throw new \MSG($this, "File exist", 1);
		else  												throw new \MSG($this, "File not exist", 0);

		return file_exists($this->url) && !is_dir($this->url);*/
	}




	/**
	 * UPLOAD local File OBJ to server File OBJ
	 *
	 * @param File $local_file		obj File created from PC url
	 */
	public function upload(File $local_file){
		if( move_uploaded_file($local_file->url, $this->url) ){
			self::set($this->url);	// set OBJ by new uploaded File
			throw new \MSG($this, "File was successful uploaded", 1);
		}else{
			throw new \MSG($this, "File was NOT uploaded", 3);
		}
	}




	// PARENT::FF
	public function rename($new_name){
		$target_file_url = parent::rename($new_name);	// Do rename in PARENT obj
		self::set($target_file_url);					// reset OBJ on new rename obj
	}

	// PARENT::FF
	public function move($new_dir){
		$target_file_url = parent::move($new_dir);
		self::set($target_file_url);
	}


	public function copy(){
		$from_file_url =	$this->url;
		$to_file_url =		connect_url([$this->dir, $this->filename."-copy.".$this->extension]);

		//if(!$overwrite && file_exists($to_file_url))	return null;

		copy($from_file_url, $to_file_url);
		return new File($to_file_url);
	}


	public function delete(){
		$file_url =	$this->url;
		unlink($file_url);
	}
}
