<code style="white-space: pre;">
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

$files = $fm->getFiles();
echo "::getFiles()<br>";
foreach($files as $ff){
	echo $ff->url->getString()."\n";
}

echo "\n";
$folders = $fm->getFolders();
echo "::getFolders()<br>";
foreach($folders as $ff){
	echo $ff->url->getString()."\n";
}

echo "\n";
$array_ff = $fm->getExist();
echo "::getExist()<br>";
foreach($array_ff as $ff){
	echo $ff->url->getString()."\n";
}

echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

$filter = "%f%";
echo "::filter('".$filter."')<br>";
$filtered_ff = $fm->filter($filter);
foreach($filtered_ff as $ff){
	echo $ff->url->getString()."\n";
}
echo "\n";

$filter = "%f%";
$type = 0;
echo "::filter('".$filter."', ".$type.")<br>";
$filtered_ff = $fm->filter($filter, $type);
foreach($filtered_ff as $ff){
	echo $ff->url->getString()."\n";
}
echo "\n";

$filter = "txt";
$type = 1;
$key = "extension";
echo "::filter('".$filter."', ".$type.", '".$key."')<br>";
$filtered_ff = $fm->filter($filter, $type, $key);
foreach($filtered_ff as $ff){
	echo $ff->url->getString()."\n";
}
