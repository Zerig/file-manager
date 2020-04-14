# FILE MANAGER \ FILE
- class File extends **\FileManager\FF**
- need **\UrlParser\Url** class
works with Files


```php
// BOTH variant are possile ↓
$ff = new \FileManager\File("root/aaa/bbb/file.txt");
$ff = new \FileManager\File( new \UrlParser\Url("root/aaa/bbb/file.txt") );

// These ↓ are in parent class FF
public $url => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir => \UrlParser\Url::getString() => "root/aaa/bbb"

// These are specific for File class
public $filename	=> "file"
public $extension	=> "txt"
public $mime	=> "text/plain"

```

## <small>parent::</small>exist()
Check if File/Folder really exist<br>
@return [boolean]

```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff->exist();
$ff->mode => 0666	// when exist
$ff->mode => null	// when doesn't exist
```


## rename($new_name)
Change name of file/folder<br>
$new_name [string]

```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff->rename("ffile.txt");
$ff->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
Change dir, not name of file/folder<br>
$new_dir [string]

```php
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
// BOTH variant are possile ↓
$ff->move("root/aaa/b");
$ff->move(new \UrlParser\Url("root/aaa/b"));

$ff->url->getString => "root/aaa/b/file.txt"
```
