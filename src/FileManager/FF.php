<?php
namespace FileManager;

class FF{
	public $url;			// UrlParser\Url::www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/


	function __clone(){
		$this->url = clone $this->url;
		$this->dir = clone $this->dir;
    }

	public function __construct($ff_url){
		self::set($ff_url);
	}

	/**
	 * set all necessary FF public variables
	 */
	public function set($ff_url){
		$this->url = 		self::setUrl($ff_url);					// SAVE as \UrlParser\Url
		$this->name = 		end( $this->url->getPath("array") );

		if(self::exist()){
			$this->size = 		filesize($this->url->getString());
			$this->mode = 		substr(sprintf('%o', fileperms($this->url->getString())), -4);
		}

		// set dir
		$this->dir = clone $this->url;
		$this->dir->pop();
	}



	public function setUrl($ff_url){
		if(is_a($ff_url, "\UrlParser\Url"))		return $ff_url;
		else  									return new \UrlParser\Url($ff_url);
	}





	public function isDir(){
		return ( $this->url->isDir() );
	}

	public function isFile(){
		return ( $this->url->isFile() );
	}

	public function exist(){
		return ( self::isDir() || self::isFile() );
	}


	/**
	 * SET obj with new FF->name
	 *
	 * @param string $new_name		name of new file
	 */
	public function rename($new_name){
		$source_ff_url =	$this->url;		// \UrlParser\Url
		// Create new URL object with right name
		$target_ff_url = 	clone $this->dir;
		$target_ff_url->addPath($new_name);

		rename($source_ff_url->getString(), $target_ff_url->getString());
		self::set($target_ff_url);
	}

	/**
	 * SET obj with new FF->dir
	 *
	 * @param string $new_dir		name of new dir path
	 */
	public function move($new_dir){
		$source_ff_url =	$this->url;	// obj \UrlParser\Url
		$target_ff_url = 	(is_a($new_dir, "\UrlParser\Url"))? $new_dir->addPath($this->name) : new \UrlParser\Url([$new_dir, $this->name]);

		rename($source_ff_url->getString(), $target_ff_url->getString());
		self::set($target_ff_url);
	}






	/*
	 * $array_ff [array of \FileManager\FF]
	 */
	public function filter($filter, $key = "name"){
		if(!isset($this->{$key})) return 0;

		if($filter[0] == "%" && substr($filter, -1) == "%"){
			$filter = str_replace("%", "", $filter);
			return (stripos($this->{$key}, $filter) !== false);

		}else if(substr($filter, -1) == "%"){
			$filter = str_replace("%", "", $filter);
			return $filter == substr($this->{$key}, 0, strlen($filter));

		}else if($filter[0] == "%"){
			$filter = str_replace("%", "", $filter);
			return $filter == substr($this->{$key}, -strlen($filter), strlen($filter));

		}else{
			return ($this->{$key} == $filter);
		}

		//return ($type)? $result : !$result;
	}

}
