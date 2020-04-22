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





	public function isFolder(){
		return ( $this->url->isFolder() );
	}

	public function isFile(){
		return ( $this->url->isFile() );
	}

	public function exist(){
		return ( self::isFolder() || self::isFile() );
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

		return new \FileManager\FF($source_ff_url);
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

		return new \FileManager\FF($source_ff_url);
	}






	/*
	 * $array_ff [array of \FileManager\FF]
	 */
	public function has($filter, $key = "name"){
		if(!isset($this->{$key})) return 0;		// When key doesnt exists

		// "%" char in the BEGINNING and END of $filter
		if($filter[0] == "%" && substr($filter, -1) == "%"){
			$filter = str_replace("%", "", $filter);
			return (stripos($this->{$key}, $filter) !== false);

		// "%" char in the END of $filter
		}else if(substr($filter, -1) == "%"){
			$filter = str_replace("%", "", $filter);
			return $filter == substr($this->{$key}, 0, strlen($filter));

		// "%" char in the BEGINNING of $filter
		}else if($filter[0] == "%"){
			$filter = str_replace("%", "", $filter);
			return $filter == substr($this->{$key}, -strlen($filter), strlen($filter));

		// "%" char is not in $filter
		}else{
			return ($this->{$key} == $filter);
		}
	}

}
