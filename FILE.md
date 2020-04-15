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

## exist()
=> parent::	in FF
Check if File/Folder really exist<br>
@return [boolean]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->exist();
$file->exist() => 1	// when exist
$file->exist() => 0	// when doesn't exist
```


## rename($new_name)
=> parent::	in FF
Change name of file/folder<br>
$new_name [string]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->rename("ffile.txt");
$file->url->getString => "root/aaa/bbb/ffile.txt"
```

## move($new_dir)
=> parent::	in FF
Change dir, not name of file/folder<br>
$new_dir [string]

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
// BOTH variant are possile ↓
$file->move("root/aaa/b");
$file->move(new \UrlParser\Url("root/aaa/b"));

$file->url->getString => "root/aaa/b/file.txt"
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


## delete()
Remove concrete File not object

```php
$file = new \FileManager\File("root/aaa/bbb/file.txt");
$file->exist() => 1;
$file->delete();
$file->exist() => 0;
```
