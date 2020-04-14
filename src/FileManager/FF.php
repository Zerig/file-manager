<?php
namespace FileManager;

class FF{
	public $url;			// UrlParser\Url::www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/


	public function __construct($ff_url){
		if(is_a($ff_url, "\UrlParser\Url"))		self::set($ff_url->getString());
		else  									self::set($ff_url);
	}

	/**
	 * set all necessary FF public variables
	 */
	public function set($ff_url){
		$this->url = 		new \UrlParser\Url($ff_url);
		$this->name = 		end( $this->url->getPath("array") );

		if(self::exist()){
			$this->size = 		filesize($this->url->getString());
			$this->mode = 		substr(sprintf('%o', fileperms($this->url->getString())), -4);
		}

		// set dir
		$this->dir = clone $this->url;
		$this->dir->pop();
	}

	public function exist(){
		return (is_dir($this->url->getString()) || is_file($this->url->getString()));
	}


	/**
	 * SET obj with new FF->name
	 *
	 * @param string $new_name		name of new file
	 */
	public function rename($new_name){
		$source_ff_url =	$this->url;
		// Create new URL object with right name
		$target_ff_url = 	clone $this->dir;
		$target_ff_url->addPath($new_name);

		rename($source_ff_url->getString(), $target_ff_url->getString());
		self::set($target_ff_url->getString());
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
		self::set($target_ff_url->getString());
	}

}
