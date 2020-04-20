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
	new \FileManager\File("root/aaa/bbb/file.txt"),
	new \FileManager\Folder("root/aaa/bbb/folder"),
	new \FileManager\Folder("root/aaa/bbb"),
]);
```

## get($obj = null)
- **$obj [string]**	=> [null / "files" / "folders"]
- @return [array of FileManager\FF]

Return all *FF* files/Folders in one array
```php
// Returns all FF items
$ff = $fm->get();

$ff[0]->url->getString() => "root/aaa/bbb/aaa.html"
$ff[1]->url->getString() => "root/aaa/bbb/myfile.html"
$ff[2]->url->getString() => "root/aaa/bbb/file.txt"
$ff[3]->url->getString() => "root/aaa/bbb/folder"
$ff[4]->url->getString() => "root/aaa/bbb"
```
```php
// Returns only File items
$ff = $fm->get("files");

$ff[0]->url->getString() => "root/aaa/bbb/aaa.html"
$ff[1]->url->getString() => "root/aaa/bbb/myfile.html"
$ff[2]->url->getString() => "root/aaa/bbb/file.txt"
```
```php
// Returns only Folder items
$ff = $fm->get("folders");

$ff[0]->url->getString() => "root/aaa/bbb/folder"
$ff[1]->url->getString() => "root/aaa/bbb"

```


## getExist($obj = null){
- **$obj [string]**	=> [null / "files" / "folders"]
- @return [array of FileManager\FF]

Return all *FF* which is real Files or Folders. Which really exist in URL
```php
// Returns all FF items
$ff = $fm->getExist();

$ff[0]->url->getString() => "root/aaa/bbb/aaa.html"
$ff[1]->url->getString() => "root/aaa/bbb/myfile.html"
$ff[2]->url->getString() => "root/aaa/bbb/file.txt"
$ff[3]->url->getString() => "root/aaa/bbb/folder"
$ff[4]->url->getString() => "root/aaa/bbb"
```
```php
// Returns only File items
$ff = $fm->getExist("files");

$ff[0]->url->getString() => "root/aaa/bbb/file.txt"
```
```php
// Returns only Folder items
$ff = $fm->getExist("folders");

$ff[0]->url->getString() => "root/aaa/bbb/folder"
$ff[1]->url->getString() => "root/aaa/bbb"

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

Remove last *times* items from object
```php
$fm->count()	=> 5

$fm->pop();
$fm->count()	=> 4

$fm->pop(2);
$fm->count()	=> 2
```

## shift($times = 1){
- **$times [null / num]**

Remove first *times* items from object
```php
$fm->count()	=> 5

$fm->shift();
$fm->count()	=> 4

$fm->shift(2);
$fm->count()	=> 2
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
<br>





## filter($filter, $type = 1, $key = "name")
- **$filter [string]**
- **$type [boolean]**
- **$key [name]**
 - @return [array of FileManager\FF]

Filter array of *FF* by *filter* array<br>


### $filter [string]
Set what you want to find and filter by it. And it is possible to use '%' just li *LIKE* in SQL\n
```php
NAME OF FILE: "myfile.html"
FILTER:
"my%"	 	=> it choose file
"%html"		=> it choose file
"%file%"	=> it choose file
"myfile.html"	=> it choose file

$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);
$fm->filter("my%")	=> array with one File item: "root/aaa/bbb/myfile.html"
```

### $type [boolean]
You can set if you want selected files / folders or not.
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->filter("my%", 1)	=> array with one File item: "root/aaa/bbb/myfile.html"
$fm->filter("my%", 0)	=> array with one File item: "root/aaa/bbb/file.txt"
```

### $key [string]
You can set which object value *$key* should be used in filtering
```php
$fm = new \FileManager\FM([
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
]);

$fm->filter("html", 1, "extension")	=> array with one File item: "root/aaa/bbb/myfile.html"
$fm->filter("html", 1, "name")	=> empty
$fm->filter("%html", 1, "name")	=> array with one File item: "root/aaa/bbb/myfile.html"

```


```php
$array_ff = [
	new \FileManager\FF("root/aaa/bbb/file.txt"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\Folder("root/aaa/bbb"),
	new \FileManager\Folder("root/aaa"),
	new \FileManager\File("root/aaa/bbb/filename.html")
];
$filter = 'file%';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter, 1);
foreach($array_filtered_ff as $ff){
	echo $ff->url->getString()."\n";
}
```
