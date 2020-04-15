<code style="white-space: pre;">

<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file[]" multiple>
	<input type="submit" value="Upload" name="submit">
</form>

<?php
require_once '../src/UrlParser/url.php';
require_once '../src/FileManager/FF.php';
require_once '../src/FileManager/File.php';

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

/*
$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/file.txt"));
echo print_r($file);
echo "<br>---------------------------------------------<br><br>";
$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/file_not_exist.txt"));
echo print_r($file);
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";


$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/file.txt"));
$file->rename("ffile.txt");
echo print_r($file);
echo "<br>---------------------------------------------<br><br> COPY";
echo "<br>---------------------------------------------<br><br>";


$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/ffile.txt"));
$copy_file = $file->copy();
$copy_name_file = $file->copy("my_name_file.txt");
echo print_r($copy_file);
echo "<br>---------------------------------------------<br><br>";
echo print_r($copy_name_file);
*/

echo "<br>---------------------------------------------<br><br> UPLOAD";
echo "<br>---------------------------------------------<br><br>";


$files = my__multipleFiles($_FILES);



foreach($files as $file){
	$local_file = new \FileManager\File( $file["tmp_name"] );
	$server_file = new \FileManager\File(new \UrlParser\Url( ["root/a", $file["name"]] ));

	echo $local_file->url->getString()." => ".$server_file->url->getString()."<br>";
	$server_file->upload($local_file);
	echo print_r($server_file);
	echo "<br>---------------------------------------------<br><br>";
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
