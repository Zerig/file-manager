# FILE MANAGER \ FF
- needs **\UrlParser\Url** class

 parent class of every File and Folder => FF


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

## exist()
- @return [boolean]

Check if *FF* (*File*, *Folder*) really exist
```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->exist() => 1	// when exist
$folder->exist() => 0	// when doesn't exist
```

## isFolder()
- @return [boolean]

Check if *Folder* really exist!
```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->isFolder() => 1	// when Folder really exist
$folder->isFolder() => 0	// when Folder doesn't exist
```

## isFile()
- @return [boolean]

Check if *File* really exist!
```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->idFile() => 1	// when File really exist
$folder->idFile() => 0	// when File doesn't exist
```


## rename($new_name)
- $new_name [string]

Change name of file/folder
```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->rename("ffile.txt");
$folder->url => FileManager\Folder("root/aaa/bbb/ffile.txt")
```

## move($new_dir)
- $new_dir [string]

Change dir, not name of *FF* (file/folder)
```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
// BOTH variant are possile ↓
$folder->move("root/aaa/b");
$folder->move(new \UrlParser\Url("root/aaa/b"));

$folder->url => FileManager\Folder("root/aaa/b/folder")
```

## ::checkIf($filter, $key = "name")
- **$filter [string]**
- **$key [name]**
* @return [boolean]

Chceck if same value *key* of object contain

### $filter [string]
Set what you want to find and filter by it. And you can use '%' just like *LIKE* in SQL
```php
$ff = new \FileManager\FF("root/aaa/bbb/myfile.html");
$ff->filter('my%')         => 1
$ff->filter('%html')       => 1
$ff->filter('%file%')      => 1
$ff->filter('myfile.html') => 1

$ff->filter('aaa%')        => 0
```

### $key [string]
You can choose which obj value you want to compare
```php
$ff = new \FileManager\File("root/aaa/bbb/myfile.html");
$ff->name 	=> "myFile.html"
$ff->filename 	=> "myFile"
$ff->extension 	=> "html"

$ff->filter('filename', 'name')	  => 0
$ff->filter('filename%', 'name')  => 1
$ff->filter('filename', 'myfile') => 1
$ff->filter('html', 'extension')  => 1


```
