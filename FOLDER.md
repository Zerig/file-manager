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
public $url  => UrlParser\Url("root/aaa/bbb/folder")
public $size => 0
public $name => "folder"
public $mode => 0777
public $dir  => UrlParser\Url("root/aaa/bbb")

```
## FF - INHERITED METHOD
- [**exist()**](https://github.com/Zerig/file-manager/blob/master/FF.md#exist) Check if *FF* (*File*, *Folder*) really exist
- [**isFolder()**](https://github.com/Zerig/file-manager/blob/master/FF.md#isfolder) Check if *Folder* really exist!
- [**isFile()**](https://github.com/Zerig/file-manager/blob/master/FF.md#isfile) Check if *File* really exist!
- [**rename($new_name)**](https://github.com/Zerig/file-manager/blob/master/FF.md#renamenew_name) Change name of file/folder
- [**move($new_dir)**](https://github.com/Zerig/file-manager/blob/master/FF.md#movenew_dir) Change dir, not name of *FF* (file/folder)
- [**has($filter, $key = "name")**](https://github.com/Zerig/file-manager/blob/master/FF.md#hasfilter-key--name) Chceck if object *$key* contains *$filter* expression.

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
$copy_folder->url => FileManager\Folder("root/aaa/bbb/folder-copy")

// NEW name
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$copy_folder = $folder->copy("new_folder");
$copy_folder->url => FileManager\Folder("root/aaa/bbb/new_folder")
```

<hr>

## scan($column = null)
- $column [string]
- @return [array of File/Folder / array of string]

Scan current folder NOT subfolders<br>
When column is null scan return array of obj File/FOLDER<br>
When column has value "name" scan returns array of names

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");

// scan returns array of obj File/Folder
$folder->scan() => [
	[0] => FileManager\File("root/aaa/bbb/folder/file.txt"),
	[1] => FileManager\Folder("root/aaa/bbb/folder/next_folder")
]

// scan returns array of string from obj (name)
$folder->scan("name") => [
	[0] => "file.txt"
	[1] => "next_folder"
]
```




## scanTree($column = null)
- $column [string]
- @return [array of File/Folder / array of string]

Scan current folder and all subfolders<br>
When column is null scan return array of obj File/FOLDER<br>
When column has value "name" scan returns array of names

```code
folder/
└── next_folder
│	├── next_file.txt
│	└── another_folder
├── file.txt
└── second_file.txt
```

```php
$folder = new \FileManager\Folder("folder");

// scan returns array of obj File/Folder
$folder->scanTree() => [
	[0] => FileManager\File("folder/file.txt"),
	[1] => [
		[0] => FileManager\Folder("folder/next_folder"),
		[1] => [
			[0] => FileManager\File("folder/next_file.txt"),
			[1] => FileManager\Folder("folder/another_folder")
		]
	],
	[2] => FileManager\File("folder/second_file.txt")
]

// scan returns array of string from obj (name)
$folder->scan("name") => [
	[0] => "file.txt"
	[1] => [
		[0] => "next_folder"
		[1] => [
			[0] => "next_file.txt"
			[1] => "another_folder"
		]
	]
	[2] => "second_file.txt"
]
```


<hr>


## delete()
Remove Folder and everything inside with all subfolders

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
$folder->scan()  => []
```
