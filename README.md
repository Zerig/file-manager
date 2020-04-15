# FILE MANAGER
This NAMESPACE group specializes in File/Folder structures. It loads files and folders into class.


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

	public function isDir(){}	// 
	public function isFile(){}	//
	public function exist(){}	//

	public function rename($new_name){}	//
	public function move($new_dir){}	//
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

## exist(), isDir(), isFile()
- @return [boolean]

Check if File/Folder really exist<br>

```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff->exist();
$ff->exist() => 0	// when exist
$ff->exist() => 1	// when doesn't exist
```


## rename($new_name)
- $new_name [string]

Change name of file/folder

```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff->rename("ffile.txt");
$ff->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
- $new_dir [string]

Change dir, not name of file/folder<br>
```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
// BOTH variant are possile ↓
$ff->move("root/aaa/b");
$ff->move(new \UrlParser\Url("root/aaa/b"));

$ff->url->getString => "root/aaa/b/file.txt"
```
