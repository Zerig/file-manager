# FILE MANAGER \ FM
- use **\UrlParser\FF** class
- use **\UrlParser\File** class
- use **\UrlParser\Folder** class

Manage multiple *FF* which cannot be in the same folder.


```php
// BOTH variant are possile ↓
$fm = new \FileManager\FM("root/aaa/bbb/file.txt");
$ff = new \FileManager\FF( new \UrlParser\Url("root/aaa/bbb/file.txt") );

public $url => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir => \UrlParser\Url::getString() => "root/aaa/bbb"
```



## ::filter($array_ff, $filter, $type = true, $key = "name")
- **$array_ff [array of FileManager\FF]**
- **$filter [string]**
- **$type [boolean]**
- **$key [name]**
 - @return [array of FileManager\FF]

Filter array of *FF* by *filter* array<br>


### $filter [string]
Set what you want to find and filter by it. And it is possible to use '%' just li *LIKE* in SQL
```php
$array_ff = [ new \FileManager\File("root/aaa/bbb/myfile.html") ];
$filter = 'my%';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$filter = '%html';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$filter = '%file%';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$filter = 'myfile.html';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$filter = 'aa%';
$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff => empty;	// file was NOT chosen
```


### $type [boolean]
Set if you want filter objects **accept** or **refuse**.
```php
$array_ff = [ new \FileManager\File("root/aaa/bbb/myfile.html") ];
$filter = 'my%';

$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter, 1);
$array_filtered_ff[]->url->getString() => "root/aaa/bbb/myfile.html";	// file was chosen

$array_filtered_ff = \FileManager\FF::filter($array_ff, $filter);
$array_filtered_ff => empty;	// file was NOT chosen
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
