# FILE MANAGER \ FILE
- class File extends **\FileManager\FF**
- needs **\UrlParser\Url** class
works with Files


```php
// BOTH variant are possile ↓
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file = new \FileManager\File( new \UrlParser\Url("root/aaa/bbb/file.txt") );

// These ↓ are in parent class FF
public $url  => \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size => 80
public $name => "file.txt"
public $mode => 0777
public $dir  => \UrlParser\Url::getString() => "root/aaa/bbb"

// These are specific for File class
public $filename	=> "file"
public $extension	=> "txt"
public $mime		=> "text/plain"

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

Copy File in the same folder. If fileName already exist script add "-copy[num]" with notexisting variant of number.
```php
// OLD name with "-copy"
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy();
$copy_file->url->getString() => "root/aaa/bbb/file-copy1.txt"

$copy_file = $file->copy();
$copy_file->url->getString() => "root/aaa/bbb/file-copy2.txt"

// NEW name
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy("new_file.txt");
$copy_file->url->getString() => "root/aaa/bbb/new_file.txt"

$copy_file = $file->copy("new_file.txt");
$copy_file->url->getString() => "root/aaa/bbb/new_file-copy1.txt"
```

## upload(File $local_file)
- $local_file [File]

take uploaded, **temporary**, file and upload it into new "empty" File
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
$files = my__multipleFiles($_FILES);

foreach($files as $file){
	$local_file = 	new \FileManager\File( $file["tmp_name"] );	// local TMP file => "C:\xampp\tmp\php9351.tmp"
	$server_file = 	new \FileManager\File( new \UrlParser\Url( ["root/a", $file["name"]] ) ); // server URL and NAME of uploaded file => "root/a/dave-greco-elemental.jpg"

	$server_file->upload($local_file);	// upload file into "root/a"
}
$server_file->exist() => 1 // when file was UPLOADED
$server_file->exist() => 0 // when file was NOT UPLOADED

```


## delete()
Remove concrete File not object

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->exist() => 1

$file->delete();
$file->exist() => 0
```
