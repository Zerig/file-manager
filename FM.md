# FILE MANAGER \ FM
- use **\UrlParser\FF** class
- use **\UrlParser\File** class
- use **\UrlParser\Folder** class

Manage multiple *FF* files/Folders which cannot be in the same folder and cannot exist.

```code
root/
└── a/
└── aa/
└── aaa/
	├── b/
	├── bb/
	└── bbb/
		├── clean_folder/
		│	├── next_folder/
		│	└── file.txt
		├── empty_folder/
		├── folder/
		│	├── next_folder/
		│	└── file.txt
		└── file.txt
```
```php
// BOTH variant are possile ↓
$fm = new \FileManager\FM( new \FileManager\File("root/aaa/bbb/aaa.html") );
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/aaa.html"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),		// File realy Exists in dir
	new \FileManager\Folder("root/aaa/bbb/ccc/ddd"),	
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
	[3] => FileManager\File("root/aaa/bbb/ccc/ddd"),
	[4] => FileManager\Folder("root/aaa/bbb/folder"),
	[5] => FileManager\Folder("root/aaa/bbb")
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

Return all *FF* objects which are *File* objects. They cannot exist!
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

Return all *FF* objects which are *Folder* objects. They cannot exist!
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

Filter array of *FF* by *filter* array\n
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
$fm->getFilter("my%") => [	FileManager\File("root/aaa/bbb/myfile.html") ]
```

### $type [boolean]
You can set if you want selected files / folders or not.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->getFilter("my%", 1) => [ FileManager\File("root/aaa/bbb/myfile.html") ]
$fm->getFilter("my%", 0) => [ FileManager\File("root/aaa/bbb/file.txt") ]
```

### $key [string]
You can set which object value *$key* should be used in filtering
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->getFilter("html", 1, "extension")	=> [ FileManager\File("root/aaa/bbb/myfile.html") ]
$fm->getFilter("html", 1, "name")		=> []
$fm->getFilter("%html", 1, "name")		=> [ FileManager\File("root/aaa/bbb/myfile.html") ]

```




<br>
<hr>
<br>



# ARRAY FF MODIFICATION

## pop($times = 1){
- **$times [null / num]**

Remove last *times* items from object.
```php
$fm->pop()
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/aaa.html"),
	[1] => FileManager\File("root/aaa/bbb/myfile.html"),
	[2] => FileManager\File("root/aaa/bbb/file.txt"),
	[3] => FileManager\File("root/aaa/bbb/ccc/ddd"),
	[4] => FileManager\File("root/aaa/bbb/folder")
]

$fm->pop(3)
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/aaa.html"),
	[0] => FileManager\File("root/aaa/bbb/myfile.html")
]
```

## shift($times = 1){
- **$times [null / num]**

Remove first *times* items from object.
```php
$fm->shift()
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/myfile.html"),
	[1] => FileManager\File("root/aaa/bbb/file.txt"),
	[2] => FileManager\File("root/aaa/bbb/ccc/ddd"),
	[3] => FileManager\File("root/aaa/bbb/folder"),
	[4] => FileManager\File("root/aaa/bbb")
]

$fm->shift(3)
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/folder"),
	[1] => FileManager\File("root/aaa/bbb")
]
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


## exist(){
- @return [array of Boolean]

Return array of *1/0* specifying which *FF* really exist.
```php
$fm->exist() => [
	[0] => 0,
	[1] => 0,
	[2] => 1,
	[3] => 1,
	[4] => 1
]
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
## upload($local_files_fm)
- **$local_files_fm [FileManager\FM]** temporary files

Upload all *FF* items in object *FM* *$local_files_fm* into server.
```html
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file[]" multiple>
	<input type="submit" value="Upload" name="submit">
</form>
```
```php
// FUNCTION FOR TRANSFORM $_FILES form <form> INTO RIGHT ARRAY FORM
function my__multipleFiles($_files){
	$files = [];

	if(is_array($_files["file"]["tmp_name"])){
		for($i = 0; $i < count($_files["file"]["tmp_name"]); $i++){
			$files[] = [
				"name" => $_files["file"]["name"][$i],
				"type" => $_files["file"]["type"][$i],
				"tmp_name" => $_files["file"]["tmp_name"][$i],
				"error" => $_files["file"]["error"][$i],
				"size" => $_files["file"]["size"][$i]
			];

		}
	}else{
		$files[] = $_files["file"];
	}

	return $files;
}
```
```php
$server_fm = new \FileManager\FM();
$local_fm = new \FileManager\FM();

if(isset($_POST["submit"])){
	$files = my__multipleFiles($_FILES);

	foreach($files as $file){
		$server_fm->add( new \FileManager\File(new \UrlParser\Url(["root/a", $file["name"]])) ); // server URL and NAME of uploaded files => "root/a/dave-greco-elemental.jpg"
		$local_fm->add( new \FileManager\File($file["tmp_name"]) );	// local TMP files => "C:\xampp\tmp\php9351.tmp"
	}
	$server_fm->upload($local_fm);
}

$server_fm->get() => [
	[0] => FileManager\File("root/a/dave-greco-elemental.jpg"),
	[1] => FileManager\File("root/a/eytan-zana-art-of-uncharted-re-cover.jpg"),
	[2] => FileManager\File("root/a/eytan-zana-fallengod-web.jpg"),
	[3] => FileManager\File("root/a/eytan-zana-forest-god4.jpg"),
	[4] => FileManager\File("root/a/forgestoker_dragon__promo__by_lucasgraciano-d9qd928.jpg"),
	[5] => FileManager\File("root/a/Grzegorz-Rutkowski-19.jpg")
]

$local_fm->get() => [
	[0] => FileManager\File("C:\xampp\tmp\php9106.tmp"),
	[1] => FileManager\File("C:\xampp\tmp\php9117.tmp"),
	[2] => FileManager\File("C:\xampp\tmp\php9118.tmp"),
	[3] => FileManager\File("C:\xampp\tmp\php9119.tmp"),
	[4] => FileManager\File("C:\xampp\tmp\php911A.tmp"),
	[5] => FileManager\File("C:\xampp\tmp\php912B.tmp")
]

$server_fm->exist() => [
	[0] => 1
	[1] => 1
	[2] => 1
	[3] => 1
	[4] => 1
	[5] => 1
]

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
])

$fm->move("root/aaa/bbb/ccc");
$fm->get() => [
	[0] => FileManager\File("root/aaa/bbb/ccc/myfile.html"),
	[1] => FileManager\File("root/aaa/bbb/ccc/file.txt")
]


```
