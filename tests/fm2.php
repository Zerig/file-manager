<code style="white-space: pre;">
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file[]" multiple>
	<input type="submit" value="Upload" name="submit">
</form>

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


$array_ff = [
	new \FileManager\File("root/aaa/bbb/aaa.html"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
	new \FileManager\Folder("root/aaa/bbb/folder"),
	new \FileManager\Folder("root/aaa/bbb"),
];

$fm = new \FileManager\FM($array_ff);
echo 'FM > foreach($fm->get()) > url->getString():<br>';
foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
echo "::count() => ".$fm->count()."\n";

echo "<br>---------------------------------------------<br><br>";

$fm->add(new \FileManager\File("root/aaa/bbb/name.txt"));
echo '::add(new \FileManager\File("root/aaa/bbb/name.txt"))<br>';
$fm->add(new \FileManager\File("root/aaa/bbb/image.jpg"));
echo '::add(new \FileManager\File("root/aaa/bbb/image.jpg"))<br>';
foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
echo "::count() => ".$fm->count()."\n";

echo "<br>---------------------------------------------<br><br>";

$fm->pop();
echo '::pop()<br>';
foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
echo "::count() => ".$fm->count()."\n";
echo "\n";
$fm->shift();
echo '::shift()<br>';
foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
echo "::count() => ".$fm->count()."\n";

echo "<br>---------------------------------------------<br><br>";

$files= $fm->get("files");
echo "::count() => ".$fm->count()."\n";
echo "::count('files') => ".$fm->count('files')."\n";
echo "::count('folders') => ".$fm->count('folders')."\n";
echo "\n";

echo "::get('files')<br>";
foreach($files as $ff){
	echo $ff->url->getString()."\n";
}

echo "\n";
$folders = $fm->get("folders");
echo "::get('folders')<br>";
foreach($folders as $ff){
	echo $ff->url->getString()."\n";
}

/*
echo "\n";
$exist = $fm->getExist();

echo "::getExist()<br>";
foreach($exist as $ff){
	echo $ff->url->getString()."\n";
}*/

echo "\n";
$exist= $fm->getExist("folders");
echo "::getExist('folders')<br>";
foreach($exist as $ff){
	echo $ff->url->getString()."\n";
}

echo "\n";
$exist = $fm->getExist("files");
echo "::getExist('files')<br>";
foreach($exist as $ff){
	echo $ff->url->getString()."\n";
}


echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

$filter = "%f%";
echo "::has('".$filter."')<br>";
$filtered = $fm->getFilter($filter);
foreach($filtered as $ff){
	echo $ff->url->getString()."\n";
}
echo "\n";

$filter = "%f%";
$type = 0;
echo "::has('".$filter."', ".$type.")<br>";
$filtered = $fm->getFilter($filter, $type);
foreach($filtered as $ff){
	echo $ff->url->getString()."\n";
}
echo "\n";

$filter = "txt";
$type = 1;
$key = "extension";
echo "::has('".$filter."', ".$type.", '".$key."')<br>";
$filtered = $fm->getFilter($filter, $type, $key);
foreach($filtered as $ff){
	echo $ff->url->getString()."\n";
}



echo "<br>---------------------------------------------<br><br>UPLOAD";
echo "<br>---------------------------------------------<br><br>";


if(isset($_POST["submit"])){

	$server_fm = new \FileManager\FM();
	$local_fm = new \FileManager\FM();

	$files = my__multipleFiles($_FILES);

	foreach($files as $file){
		$server_fm->add( new \FileManager\File(new \UrlParser\Url(["root/a", $file["name"]])) );
		$local_fm->add( new \FileManager\File($file["tmp_name"]) );
	}
	$server_fm->upload($local_fm);



	foreach($local_fm->get() as $ff){
		echo $ff->url->getString()."\n";
	}
	echo "\n-----------\n";
	foreach($server_fm->get() as $ff){
		echo $ff->url->getString()."\n";
	}



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

echo "<br>---------------------------------------------<br><br>";
$clone_fm = clone $server_fm;

echo $clone_fm->get()[0]->url->getString()."\n";
echo $server_fm->get()[0]->url->getString()."\n";
$clone_fm->get()[0]->url->addPath("rrr");
echo $clone_fm->get()[0]->url->getString()."\n";
echo $server_fm->get()[0]->url->getString()."\n";


echo "<br>---------------------------------------------<br><br>DELETE";
echo "<br>---------------------------------------------<br><br>";


$fm_delete = clone $server_fm;
$fm_delete->has("%zana%");
$fm_delete->delete();
foreach($fm_delete->get() as $ff){
	echo $ff->url->getString()."\n";
}
echo "<br>---------------------------------------------<br><br>MOVE";
echo "<br>---------------------------------------------<br><br>";
$fm_move = clone $server_fm;
$fm_move->has("%zana%", 0);

$fm_move->move("root/aa");
foreach($fm_move->get() as $ff){
	echo $ff->url->getString()."\n";
}

echo "<br>---------------------------------------------<br><br>REMOVE FROM FM CLASS";
echo "<br>---------------------------------------------<br><br>";
foreach($fm_delete->get() as $ff){
	echo $ff->url->getString()."\n";
}
$server_fm->remove($fm_delete);
echo "\n";
echo '::remove($fm_delete)';
echo "\n";
foreach($server_fm->get() as $ff){
	echo $ff->url->getString()."\n";
}

echo "<br>---------------------------------------------<br><br>";
$array_ff = [
	new \FileManager\File("root/aaa/bbb/aaa.html"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
	new \FileManager\Folder("root/aaa/bbb/folder"),
	new \FileManager\Folder("root/aaa/bbb"),
];

$fm = new \FileManager\FM($array_ff);

foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
$fm->removeNotExist();
echo "\n";
echo '::removeNotExist()';
echo "\n";
foreach($fm->get() as $ff){
	echo $ff->url->getString()."\n";
}
