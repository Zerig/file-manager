<?php
namespace UrlParser;
// !!!!!USE:::::  $GLOBALS["server_root"]
if(!isset($GLOBALS["server_root"])) $GLOBALS["server_root"] = new Url("");

class Url{
	// http://localhost/web/o-nas/kontakt.html?clen=ja&vek=15#nadpis
	public $scheme;		// "http"
	public $host;		// "localhost"
	public $root;		// ["web"]
	public $path;		// ["o-nas", "kontakt.html"]
	public $query;		// ["clen" => "ja", "vek" => "15"]
	public $fragment;	// "nadpis"

	/**
	 * CONNECT input into one correct URL
	 *
	 * @param [array of string / string] $array_url 		// ["aaa/bbb/", "/ccc". "name.html"] or "aa/bb//ccc/name.html"
	 * @return string 										// "aa/bb/ccc/name.html"
	 */
	public function __construct($url_path){
		$url_path = self::makeItString($url_path);
		$parse_url = parse_url($url_path);

		if(isset($parse_url["scheme"]))		$this->scheme = $parse_url["scheme"];		// set SCHEME
		if(isset($parse_url["host"]))		$this->host = $parse_url["host"];			// set HOST
		if(isset($parse_url["path"]))		self::setPath($parse_url["path"]);			// set PATH
		if(isset($parse_url["path"]))		self::setRoot();							// set ROOT and rewrite PATH
		if(isset($parse_url["query"]))		self::setQuery($parse_url["query"]);		// set QUERY
		if(isset($parse_url["fragment"]))	$this->fragment = $parse_url["fragment"];	// set FRAGMENT
	}






	/**
	 * make URL in right FORM STRING
	 * makeItString("http://www.web.cz//aaa/bbb/a.html")
	 * makeItString(["http", "/www.web.cz/", "/aaa/bbb", "a.html"])
	 * => http://www.web.cz/aaa/bbb/a.html

	 * @url_path [string, array of string]
	 */
	public function makeItString($url_path){
		$url_array = (is_array($url_path))? $url_path : [$url_path];
		$merge_url_array = [];
		$fin_url_array = [];

		foreach($url_array as $url_part){
			if(is_array($url_part)) $merge_url_array = array_merge($merge_url_array, $url_part);
			else  					$merge_url_array = array_merge($merge_url_array, explode("/", $url_part));
		}

		$merge_url_array = array_filter($merge_url_array);	// Remove all empty values of array

		// CONTROL if one of send url string contains http,...
		foreach($merge_url_array as $url_part){
			if(preg_match('(http|https|ftp|sftp)', $url_part) === 1){
				$fin_url_array[] = (strpos($url_part, ":") === false)? $url_part.":/" : $url_part."/";
			}else{
				$fin_url_array[] = $url_part;
			}

		}

		return implode("/", $fin_url_array);
	}










	/* set PATH
	 * @path [string]	"/aaa/bbb/file.html"
	 */
	public function setPath($path){
		// remove first "/" if exist
		if(substr($path, 0, 1) == "/") $path = substr($path, 1);
		$this->path = explode("/", $path);
	}


	/* set root
	 * find $GLOBALS["server_root"] and $this->path
	 * server_root set into PATH
	 * PATH will be smaller
	 */
	public function setRoot(){
		if(isset($GLOBALS["server_root"])){
			$server_root = clone $GLOBALS["server_root"];

			// IF HOST part SERVER_ROOT and THIS obj is the same OR one of them has not set HOST
			if( ( isset($server_root->host) && isset($this->host) && ($server_root->host == $this->host) ) || !isset($server_root->host) || !isset($this->host) ){
				$array_root = $server_root->getPath("array");
				$array_path = $this->path;
				$pathContainRoot = true;

				// IF SERVER_ROOT and ARRAY_PATH is not empty
				if(isset($array_root) && isset($array_path)){

					// CONTROL all first items of PATH if are the same asi in ROOT
					// IF YES then remove them from PATH
					foreach($array_root as $item_root){
						// if first item from ROOT and first item from THIS obj path is the same
						if($item_root == $array_path[0]){
							array_shift($array_path);
						}else{
							$pathContainRoot = false;
							break;
						}
						if(empty($array_path)){
							$pathContainRoot = false;
						}
					}

					// IF ROOT is part of PATH
					if($pathContainRoot){
						$this->path = $array_path;	// reset PATH
						$this->root = $array_root;	// set ROOT
					}
				}
			}
		}
	}




	/* set QUERY
	 * ?name=nym&age=15 => ["name" => "nym", "age" => 15]

	 * @query [string]
	 */
	public function setQuery($query){
		$query = explode("&", $query);

		foreach($query as $q){
			$item = explode("=", $q);
			$this->query[$item[0]] = $item[1];
		}
	}


















	/* POP
	 * remove last part of url PATH

	 * @times [int]		How many time
	 */
	public function pop($times = 1){
		for($i = 0; $i < $times; $i++){
			array_pop($this->path);
		}
	}

	/* PUSH
	 * remove first part of url PATH

	 * @times [int]		How many time
	 */
	public function shift($times = 1){
		for($i = 0; $i < $times; $i++){
			array_shift($this->path);
		}
	}


	/* SWAP
	 * replace URL PATH part for another

	 * @from [string]
	 * @to [string]
	 */
	public function swap($from, $to){
		for($i = 0; $i < count($this->path); $i++){
			if($this->path[$i] == $from) $this->path[$i] = $to;
		}
	}










	/* get ALL URL PARTS
	 * getScheme() / getScheme("string") / getScheme("array")

	 * @exp [string]
	 */
	public function getScheme($exp = null){
		if(!isset($this->scheme)) 	return null;

		if($exp == null)			return $this->scheme;
		if($exp == "array")			return [$this->scheme];
		if($exp == "string")		return $this->scheme."://";
	}

	public function getHost($exp = null){
		if(!isset($this->host)) 	return null;

		if($exp == null)			return $this->host;
		if($exp == "array")			return [$this->host];
		if($exp == "string")		return $this->host;
	}

	public function getRoot($exp = null){
		if(!isset($this->root)) 	return null;

		if($exp == null)			return $this->root;
		if($exp == "array")			return $this->root;
		if($exp == "string")		return implode("/", $this->root);
	}

	public function getPath($exp = null){
		if(!isset($this->path)) 	return null;

		if($exp == null)			return $this->path;
		if($exp == "array")			return $this->path;
		if($exp == "string")		return implode("/", $this->path);
	}

	public function getQuery($exp = null){
		if(!isset($this->query)) 	return null;

		if($exp == null)			return $this->query;
		if($exp == "array")			return $this->query;
		if($exp == "string"){
			$string_query = ""; $i = 1;
			foreach($this->query as $key => $val){
				$string_query .= ($i == 1)? "?".$key."=".$val : "&".$key."=".$val;
				$i++;
			}
									return $string_query;
		}
	}

	public function getFragment($exp = null){
		if(!isset($this->fragment)) 	return null;

		if($exp == null)			return $this->fragment;
		if($exp == "array")			return [$this->fragment];
		if($exp == "string")		return "#".$this->fragment;
	}


	public function getString(){
		$string_url = "";
		$implode_array = [];
		if(isset($this->scheme)) 	$string_url .= self::getScheme("string");

		if(isset($this->host)) 	$implode_array[] = $this->host;
		if(isset($this->root)) 	$implode_array[] = $this->root;
		if(isset($this->path)) 	$implode_array[] = $this->path;
									$string_url .= self::makeItString($implode_array);

		if(isset($this->query))		$string_url .= self::getQuery("string");
		if(isset($this->fragment)) 	$string_url .= self::getFragment("string");

		return $string_url;
	}




	public function hasFile(){
		return strpos(end($this->path), ".") !== false;
	}

	public function getDepth(){
		$depth = sizeof($this->path);

		if(self::hasFile()) return $depth - 1;
		else    			return $depth;
	}



	public function linkRoot(){
		$link = "";
		for($i = 0; $i < self::getDepth(); $i++){
			$link .= "../";
		}

		return $link;
	}














	public function addPath($add_part){
		$string = self::makeItString($add_part);
		$array = explode("/", $string);

		if(self::hasFile()){
			$i = count($this->path) - 1;
			$array_file = explode(".", $this->path[$i]);
			$this->path[$i] = $array_file[0];

			if(strpos(end($array), ".") === false){
				$array[count($array) - 1] .= ".".$array_file[1];
			}
		}

		foreach($array as $part){
			$this->path[] = $part;
		}
	}

	public function addQuery($add_part){
		foreach($add_part as $key => $val){
			$this->query[$key] = $val;
		}
	}







	public function beforePath($add_part){
		$string = self::makeItString($add_part);
		$array = explode("/", $string);

		foreach($this->path as $part){
			$array[] = $part;
		}
		$this->path = $array;
	}







	/* remove ALL URL PARTS
	 * removeQuery(["name", "age"])

	 * @$key_array [array of string]
	 */
	public function removeScheme(){		$this->scheme = null;	}
	public function removeHost(){		$this->host = null;	}
	public function removeRoot(){		$this->root = null;	}
	public function removeFragment(){	$this->fragment = null;	}


	public function removePath($path_part = null){
		if(empty($path_part)) $this->path = null;
		if(!empty($path_part)){
			$string_url = self::makeItString($path_part);
			$string_url = str_replace($string_url, "", self::getPath("string"));
			$string_url = self::makeItString($string_url);

			self::setPath($string_url);
		}
	}


	public function removeQuery($key_array = []){
		if(empty($key_array))		$this->query = null;
		if(!is_array($key_array))	$key_array = [$key_array];

		if(!empty($this->query)){
			foreach($this->query as $key => $val){
				foreach($key_array as $remove_key){
					if($remove_key == $key)	unset($this->query[$key]);	// remove item
				}
			}
		}


	}



















}
