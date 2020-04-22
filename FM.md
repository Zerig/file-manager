# FILE MANAGER \ FM
- use **\UrlParser\FF** class
- use **\UrlParser\File** class
- use **\UrlParser\Folder** class

Manage multiple *FF* files/Folders which cannot be in the same folder and cannot exist.


```php
// BOTH variant are possile ↓
$fm = new \FileManager\FM( new \FileManager\File("root/aaa/bbb/aaa.html") );
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/aaa.html"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),		// File realy Exists in dir
	new \FileManager\Folder("root/aaa/bbb/folder"),		// Folder realy Exists in dir
	new \FileManager\Folder("root/aaa/bbb")			// Folder realy Exists in dir
]);
```
<hr>

# GET...()

## get($i = null)
- **$i [num]**	=> [null / num]
- @return [array of FileManager\FF / FileManager\FF]

Return all *FF* files/Folders in one array, when *i* is NULL.
```php
// Returns all FF items
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/aaa.html"),
	[1] => FileManager\File("root/aaa/bbb/myfile.html"),
	[2] => FileManager\File("root/aaa/bbb/file.txt"),
	[3] => FileManager\Folder("root/aaa/bbb/folder"),
	[4] => FileManager\Folder("root/aaa/bbb")
]
```

Return one *FF* file/Folder, when *i* is num.
```php
// Returns all FF items
$fm->get(0)  => FileManager\File("root/aaa/bbb/aaa.html")
$fm->get(1)  => FileManager\File("root/aaa/bbb/myfile.html")

$fm->get(-1) => FileManager\File("root/aaa/bbb")
$fm->get(-2) => FileManager\File("root/aaa/bbb/folder")

```


## getFiles()
- @return [array of FileManager\FF]

Return all *FF* objects which are *File*
```php
// Returns only File items
$fm->getFiles() => [
	[0] => FileManager\File("root/aaa/bbb/aaa.html"),
	[1] => FileManager\File("root/aaa/bbb/myfile.html"),
	[2] => FileManager\File("root/aaa/bbb/file.txt")
]
```

## getFolders()
- @return [array of FileManager\FF]

Return all *FF* objects which are *Folder*
```php
// Returns only Folder items
$fm->getFolders()	=> [
	[0] => FileManager\Folder("root/aaa/bbb/folder"),
	[1] => FileManager\Folder("root/aaa/bbb")
]
```


## getExist(){
- @return [array of FileManager\FF]

Return all *FF* which is real Files or Folders. Which really exist in URL
```php
// Returns all FF items
$fm->getExist() => [
	[0] => FileManager\File("root/aaa/bbb/file.txt"),
	[1] => FileManager\Folder("root/aaa/bbb/folder"),
	[2] => FileManager\Folder("root/aaa/bbb")
]
```

## getNotExist(){
- @return [array of FileManager\FF]

Return all *FF* which is real Files or Folders. Which really exist in URL
```php
// Returns all FF items
$fm->getExist() => [
	[0] => FileManager\File("root/aaa/bbb/aaa.html"),
	[1] => FileManager\File("root/aaa/bbb/myfile.html"),
]
```


## getFilter($filter, $type = 1, $key = "name")
- **$filter [string]**
- **$type [boolean]**
- **$key [name]**
 - @return [array of FileManager\FF]

Filter array of *FF* by *filter* array<br>
Primary it choose files which accept *$filter* expression. And the expression is primary searched in *$key* **name**.


### $filter [string]
Set what you want to find. You can use *'%'* just like operator *LIKE* in SQL\n
```code
NAME OF FILE: "myfile.html"
FILTER:
"my%"	 	=> "myfile.html" file was chosen
"%html"		=> "myfile.html" file was chosen
"%file%"	=> "myfile.html" file was chosen
"myfile.html"	=> "myfile.html" file was chosen
```
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt")
]);
$fm->filter("my%") => [	FileManager\File("root/aaa/bbb/myfile.html") ]
```

### $type [boolean]
You can set if you want selected files / folders or not.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->filter("my%", 1) => [ FileManager\File("root/aaa/bbb/myfile.html") ]
$fm->filter("my%", 0) => [ FileManager\File("root/aaa/bbb/file.txt") ]
```

### $key [string]
You can set which object value *$key* should be used in filtering
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->filter("html", 1, "extension")	=> [ FileManager\File("root/aaa/bbb/myfile.html") ]
$fm->filter("html", 1, "name")		=> []
$fm->filter("%html", 1, "name")		=> [ FileManager\File("root/aaa/bbb/myfile.html") ]

```




<br>
<hr>
<br>





## count($obj = null){
- **$obj [string]**	=> [null / "files" / "folders"]
- @return [num]

Return all *FF* which is real Files or Folders. Which really exist in URL
```php
// Returns all FF items
$fm->count()		=> 5
$fm->count('files')	=> 3
$fm->count('folders')	=> 2
```

## pop($times = 1){
- **$times [null / num]**

Remove last *times* items from object.
```php
$fm->count() => 5

$fm->pop();
$fm->count() => 4

$fm->pop(2);
$fm->count() => 2
```

## shift($times = 1){
- **$times [null / num]**

Remove first *times* items from object.
```php
$fm->count() => 5

$fm->shift();
$fm->count() => 4

$fm->shift(2);
$fm->count() => 2
```

## add($array_ff){
- **$array_ff [FileManager\FF / array of FileManager\FF]**
- @return [array of FileManager\FF]

Add *FileManager\FF* or *array of FileManager\FF* and add them in the end of object FF array *$arrayFF*
```php
// BOTH variant are possile ↓
$fm->add(new \FileManager\File("root/aaa/bbb/new-file.html"));
$fm->add([
	new \FileManager\File("root/aaa/bbb/new-file.html"),
	new \FileManager\Folder("root/aaa/bbb/new-folder")
]);
```


<br>
<hr>


# REMOVE...()

## remove($fm = null)
- **$fm [FileManager\FM / array of FileManager\FF / FileManager\FF]**
 - @return [FileManager\FM]

Remove *FF* Files/folders from obj *FM* - NOT from server
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]);
```

```php
// Remove one ff object
$fm->remove( new \FileManager\File("root/aaa/file.txt") );
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/myfile.html"),
	[1] => FileManager\Folder("root/aaa/folder")
]
```

```php
// Remove multiple ff objects by ARRAY OF FF
$fm->remove([
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]);
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/myfile.html")
]
```

```php
// Remove multiple ff objects by FM OBJECT
$fm->remove(new \FileManager\FM([
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]));
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/myfile.html")
]

```

## removeNotExist()
 - @return [FileManager\FM]

Remove all *FF* Files/folders objects which **NOT EXIST** in FTP from *FM* - NOT from server
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),				// This FILE exist
	new \FileManager\Folder("root/aaa/folder")				// This FOLDER exist
]);
```
```php
$fm->removeExist();
$fm->get() => [
	[0] => FileManager\File("root/aaa/file.txt"),
	[1] => FileManager\Folder("root/aaa/folder")
]
```

## removeExist()
 - @return [FileManager\FM]

Remove all existing *FF*. The same as [*removeNotExist()*](#removenotexist) but reverse.

```php
$fm->removeNotExist();
$fm->get() => [
	new \FileManager\File("root/aaa/bbb/myfile.html")
]
```

## removeFiles()
 - @return [FileManager\FM]

Remove all *File* objects from *FM* - NOT from FTP
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]);
```
```php
$fm->removeFiles();
$fm->get() => [
	[0] => FileManager\Folder("root/aaa/folder")
]
```


## removeFolders()
 - @return [FileManager\FM]

Remove all *Folder* objects from *FM* - NOT from FTP
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]);
```
```php
$fm->removeFiles();
$fm->get() => [
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt")
]
```

## removeFilter($filter, $type = 1, $key = "name")
- **$filter [string]**
- **$type [boolean]**
- **$key [name]**
 - @return [FileManager\FM]

Find *FF* objects by *$filter* and remove them from *FM* - NOT from FTP.\n
Returns removed objects.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
	new \FileManager\Folder("root/aaa/folder")
]);
```
Rules how to filter find in (*getFilter($filter, $type = 1, $key = "name")*)[#getfilterfilter-type--1-key--name]
```php
$fm->removeFilter("%file%");
$fm->get() => [
	new \FileManager\Folder("root/aaa/folder")
]
```


<br>
<hr>


# FTP
## upload(FM $local_files_fm)
Delete all files inside of object, if they were existing.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
]);

$fm->delete();
$fm->get()[0]->exist()	=> 0
$fm->get()[1]->exist()	=> 0

```


## delete()
Delete all files inside of object - NOT OBJ.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
]);

$fm->delete();
$fm->exist() => [
	[0] => 0,
	[1] => 0
]

```


## move($new_dir)
- $new_dir [string]

Change dir path of all files, no matter where they were before.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/file.txt"),
]);

$fm->move("root/aaa/bbb/ccc");
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/ccc/myfile.html"),
	[1] => FileManager\File("root/aaa/bbb/ccc/file.txt")
]


```
