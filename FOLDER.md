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
public $url => \UrlParser\Url::getString() => "root/aaa/bbb/folder"
public $size => 0
public $name => "folder"
public $mode => 0777
public $dir => \UrlParser\Url::getString() => "root/aaa/bbb"

```

## exist()
=> parent::	in FF
Check if File/Folder really exist<br>
@return [boolean]

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->exist();
$folder->mode => 0777	// when exist
$folder->mode => null	// when doesn't exist
```


## rename($new_name)
=> parent::	in FF
Change name of file/folder<br>
$new_name [string]

```php
$folder = new \FileManager\Folder("root/aaa/bbb/folder");
$folder->rename("ffile.txt");
$folder->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
=> parent::	in FF
Change dir, not name of file/folder<br>
$new_dir [string]

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
$copy_name [string]<br>
Copy File in the same folder. If you don't use $copy_name of new file, the file get "-copy" <br>

```php
// OLD name with "-copy"
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy();
$copy_file->getString() => "root/aaa/bbb/file-copy.txt"

// NEW name
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$copy_file = $file->copy("new_file.txt");
$copy_file->getString() => "root/aaa/bbb/new_file.txt"
```

## upload(File $local_file)
$local_file [File]<br>
take uploaded, **temporary**, file and upload it into new "empty" File

```html
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file[]" multiple>
	<input type="submit" value="Upload" name="submit">
</form>
```

```php
$files = my__multipleFiles($_FILES);

foreach($files as $file){
	$local_file = 	new \FileManager\File( $file["tmp_name"] );
	$server_file = 	new \FileManager\File( new \UrlParser\Url( ["root/a", $file["name"]] ) );

	$server_file->upload($local_file);	// upload file into "root/a"
}

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
