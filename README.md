# FILE MANAGER
- needs **\UrlParser\Url** class

This NAMESPACE group specializes in File/Folder structures. It loads files and folders into class.

1. FILE MANAGER \ **FF**
2. FILE MANAGER \ **FILE**
3. FILE MANAGER \ **FOLDER**


## FILE MANAGER \ FF
This class is universal for File/Folder. Another classes inherit from this class.

```php
namespace FileManager;

class FF{
	public $url;			// UrlParser\Url::www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/

	public function __construct($ff_url){}	// get Url and create class
	public function set($ff_url){}		// set all init class variables
	public function setUrl($ff_url){}	// set URL variable as obj \UrlParser\Url

	public function isFolder(){}	// check if URL is existing FOLDER
	public function isFile(){}	// check if URL is existing FILE
	public function exist(){}	// check if URL is real File OR Folder

	public function rename($new_name){}	// Rename File in the same folder
	public function move($new_dir){}	// Move fole to another folder
}
```


```php
// BOTH variant are possile ↓
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff = new \FileManager\FF( new \UrlParser\Url("root/aaa/bbb/file.txt") );

public $url => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir => \UrlParser\Url::getString() => "root/aaa/bbb"
```

<br>
<hr>
<br>

## FILE MANAGER \ FILE
- class File extends **\FileManager\FF**

This class is extends FF. It specializes in Files.

```php
namespace FileManager;

class File extends FF{
	public $url;			// UrlParser\Url::www/_img/file.jpg
	public $size;			// 79949
	public $name;			// file.jpg
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/

	public $filename;	// file
	public $extension;	// .jpg
	public $mime;		// text/plain


	public function __construct($ff_url){}	// get Url and create class
	public function set($ff_url){}		// set all init class variables
	public function setUrl($ff_url){}	// set URL variable as obj \UrlParser\Url

	public function isFolder(){}	// check if URL is existing FOLDER
	public function isFile(){}	// check if URL is existing FILE
	public function exist(){}	// check if URL is real File OR Folder

	public function rename($new_name){}	// Rename File in the same folder
	public function move($new_dir){}	// Move fole to another folder


	public function isTemporary($file_url){}	// check if file is temporary => "***.tmp"
	public function copy($copy_name = null){}	// copy file and return new obj
	public function upload(File $local_file){}	// upload temporary file into object and folder
	public function delete(){}			// delete file NOT obj


}
```

```php
// BOTH variant are possile ↓
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file = new \FileManager\File( new \UrlParser\Url("root/aaa/bbb/file.txt") );

// These ↓ are in parent class FF
public $url  => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "root/aaa/bbb"

// These are specific for File class
public $filename	=> "file"
public $extension	=> "txt"
public $mime		=> "text/plain"

```


<br>
<hr>
<br>

## FILE MANAGER \ FOLDER
- class File extends **\FileManager\FF**
- needs **\FileManager\File** class

This class is extends FF. It specializes in Files.

```php
namespace FileManager;

class Folder extends FF{
	public $url;			// UrlParser\Url::www/_img/folder
	public $size;			// 79949
	public $name;			// folder
	public $mode;			// 0777
	public $dir;			// UrlParser\Url::www/_img/



	public function __construct($ff_url){}	// get Url and create class
	public function set($ff_url){}		// set all init class variables
	public function setUrl($ff_url){}	// set URL variable as obj \UrlParser\Url

	public function isFolder(){}	// check if URL is existing FOLDER
	public function isFile(){}	// check if URL is existing FILE
	public function exist(){}	// check if URL is real File OR Folder

	public function rename($new_name){}	// Rename File in the same folder
	public function move($new_dir){}	// Move fole to another folder


	public function copy($copy_name = null){}	// copy folder with everything inside and return new obj
	private function recurseCopy($src,$dst){}	// this method helps copy() method capy all subfolders
	public function scan($column = null){}		// scan folder and return current Files/Folders
	public function scanTree($column = null){}	// scan folder and return tree of all subFFolders and Files
	public function delete(){}			// delete folder and everything inside


}
```

```php
// BOTH variant are possile ↓
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder = new \FileManager\Folder( new \UrlParser\Url("root/aaa/bbb/folder") );

// These ↓ are in parent class FF
public $url  => \UrlParser\Url::getString() => "root/aaa/bbb/folder"
public $size => 0
public $name => "folder"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "root/aaa/bbb"

```
