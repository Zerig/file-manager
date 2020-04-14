# FILE MANAGER \ FILE
- class File extends **\FileManager\FF**
- needs **\UrlParser\Url** class
works with Files


```php
// BOTH variant are possile ↓
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file = new \FileManager\File( new \UrlParser\Url("root/aaa/bbb/file.txt") );

// These ↓ are in parent class FF
public $url => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir => \UrlParser\Url::getString() => "root/aaa/bbb"

// These are specific for File class
public $filename	=> "file"
public $extension	=> "txt"
public $mime		=> "text/plain"

```

## exist()
* parent::

Check if File/Folder really exist<br>
@return [boolean]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->exist();
$file->mode => 0666	// when exist
$file->mode => null	// when doesn't exist
```


## rename($new_name)
* parent::

Change name of file/folder<br>
$new_name [string]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->rename("ffile.txt");
$file->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
* parent::

Change dir, not name of file/folder<br>
$new_dir [string]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
// BOTH variant are possile ↓
$file->move("root/aaa/b");
$file->move(new \UrlParser\Url("root/aaa/b"));

$file->url->getString => "root/aaa/b/file.txt"
```


## copy($copy_name = null)
$copy_name [string]
Copy File in the same folder. If you don't use $copy_name of new file, the file get "-copy" <br>

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy();
$copy_file->getString() => "root/aaa/bbb/file-copy.txt"

$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy("new_file.txt");
$copy_file->getString() => "root/aaa/bbb/new_file.txt"
```
