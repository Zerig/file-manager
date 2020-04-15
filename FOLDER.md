# FILE MANAGER \ FOLDER
- class File extends **\FileManager\FF**
- needs **\UrlParser\Url** class
- needs **\FileManager\File** class
works with Folder and has information about files/folders inside


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

## exist()
- parent::	in FF
- @return [boolean]

Check if File/Folder really exist<br>

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->exist() => 1	// when exist
$folder->exist() => 0	// when doesn't exist
```


## rename($new_name)
- parent::	in FF
- $new_name [string]

Change name of file/folder<br>

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->rename("ffile.txt");
$folder->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
- parent::	in FF
- $new_dir [string]

Change dir, not name of file/folder<br>

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
// BOTH variant are possile ↓
$folder->move("root/aaa/b");
$folder->move(new \UrlParser\Url("root/aaa/b"));

$folder->url->getString => "root/aaa/b/folder"
```



<br>
<hr>
<br>


## copy($copy_name = null)
- $copy_name [string]

Copy Folder (and all Files/Folders inside) in the same dir place, but with new name. If you don't use $copy_name of new folder, the folder get "-copy"

```php
// OLD name with "-copy"
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$copy_folder = $folder->copy();
$copy_folder->getString() => "root/aaa/bbb/folder-copy"

// NEW name
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$copy_folder = $folder->copy("new_folder");
$copy_folder->getString() => "root/aaa/bbb/new_folder"
```



## scan($column = null)
- $column [string]
- @return [array of File/Folder / array of string]

Scan current folder NOT subfolders<br>
When column is null scan return array of obj File/FOLDER<br>
When column has value "name" scan returns array of names

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");

// scan returns array of obj File/Folder
$scan_array = $folder->scan();
$scan_array[0]->getString() => "root/aaa/bbb/folder/file.txt"
$scan_array[1]->getString()=> "root/aaa/bbb/folder/next_folder"

// scan returns array of string from obj (name)
$scan_array = $folder->scan("name");
$scan_array[0] => "file.txt"
$scan_array[1] => "next_folder"
```




## scanTree($column = null)
- $column [string]
- @return [array of File/Folder / array of string]

Scan current folder and all subfolders<br>
When column is null scan return array of obj File/FOLDER<br>
When column has value "name" scan returns array of names

```code
folder/
├── file.txt
└── next_folder
│	├── next_file.txt
│	└── another_folder
└── second_file.txt
```

```php
$folder = new \FileManager\Folder("folder");

// scan returns array of obj File/Folder
$scan_array = $folder->scanTree();
$scan_array[0]->getString() => "folder/file.txt"
$scan_array[1][0]->getString()=> "folder/next_folder"
$scan_array[1][0][0]->getString()=> "folder/next_file.txt"
$scan_array[1][0][1]->getString()=> "folder/another_folder"
$scan_array[2]->getString() => "folder/second_file.txt"

// scan returns array of string from obj (name)
$scan_array = $folder->scan("name");
$scan_array => Array(
	[0] => "file.txt"
	[1] => Array(
		[0] => "next_folder"
		[1] => Array(
			[0] => "next_file.txt"
			[1] => "another_folder"
		)
	)
	[2] => "second_file.txt"
)
```





## delete()
Remove Folder and everything inside

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->delete();

$folder->exist() => 0
```


## clean()
Remove everything inside Folder. NOT the FOLDER

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->clean();

$folder->exist() => 1
$scan_array = $folder->scan(); => empty
```
