<?php
namespace FileManager;


class File extends FF{
	public $url;			// UrlParser\Url::www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/


	public $filename;		// file
	public $extension;		// jpg
	public $mime;			// image/jpeg


	public function __construct($file_url){
		$file_str = (is_a($file_url, "\UrlParser\Url"))? $file_url->getString() : $file_url;
		self::set($file_url);
	}



	public function set($file_url){
		//if the file is TEMPORARY => it means if has in the end ".tmp"
		if(self::isTemporary($file_url)) 	parent::set( new \UrlParser\Url($file_url, '\\') );	// universal settings -> set \UrlParser\Url obj in $this->url
		else   								parent::set( $file_url );

		$path_info = pathinfo($this->url->getString());
		$this->filename = 	$path_info["filename"];
		$this->extension =	$path_info["extension"];

		$this->mime = 		(self::exist())? mime_content_type($this->url->getString()) : null;
	}






	/*
	 * detect if url adress is isTemporary
	 * $file_url [string]
	 */
	public function isTemporary($file_url){
		$file_str = (is_a($file_url, "\UrlParser\Url"))? $file_url->getString() : $file_url;

		// when last 3 chars are "tmp", then return TRUE
		if(!isset($file_str)) 		return false;
		if(strlen($file_str) < 3) 	return false;
		return ( substr($file_str, -3, 3) == "tmp" );
	}





	/**
	 * copy file in the same folder
	 * $copy_name [string]
	 */
	public function copy($copy_name = null){
		// Create new FILE URL object with right name
		$copyFile = (is_null($copy_name))? new \FileManager\File($this->url->getString()) : new \FileManager\File( new \UrlParser\Url([$this->dir->getString(), $copy_name]) );


		$copyFile = self::createName($copyFile);
		copy($this->url->getString(), $copyFile->url->getString());
		return $copyFile;
	}


	private function createName($ff, $i = 0){
		$copy = "-copy";

		if($i > 0){
			$ff->url->pop();	// remove last part of URL (the file NAME)
			// clean filename from all "-copy[num]"
			$ff->filename = substr($ff->filename, 0, (strpos($ff->filename, $copy) == 0)? strlen($ff->filename) : strpos($ff->filename, $copy));
			$ff->url->addPath($ff->filename.$copy.$i.".".$ff->extension);	// add new "-copy[num]" with higher number

			$ff->set($ff->url->getString());	// RESET all FF object by new URL
		}

		// when NEW FILE NAME not EXIST cycling END
		$i++;
		if($ff->exist())	$ff = self::createName($ff, $i);
		return $ff;
	}




	/**
	 * UPLOAD local File OBJ to server File OBJ
	 *
	 * $local_file [obj File]		obj File created from PC url
	 */
	public function upload(File $local_file){
		if( move_uploaded_file($local_file->url->getString(), $this->url->getString()) ){
			self::set($this->url);	// set OBJ by new uploaded File
		}
	}




	public function delete(){
		$file_url = $this->url->getString();
		unlink($file_url);
		//self::set($file_url);
	}
}
