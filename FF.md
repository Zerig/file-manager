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

## ::checkIf($filter, $key = "name")
- **$filter [string]**
- **$key [name]**
* @return [boolean]

Chceck if same value *key* of object contain

### $filter [string]
Set what you want to find and filter by it. And you can use '%' just like *LIKE* in SQL
```php
$ff = new \FileManager\FF("root/aaa/bbb/myfile.html");
$ff->filter('my%')			=> 1
$ff->filter('%html') 		=> 1
$ff->filter('%file%') 		=> 1
$ff->filter('myfile.html')	=> 1

$ff->filter('aaa%') => 0
```
