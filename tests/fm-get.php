<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing

$array_ff = [
	new \FileManager\File("root/aaa/bbb/aaa.html"),
	new \FileManager\File("root/aaa/bbb/myfile.html"),
	new \FileManager\File("root/aaa/bbb/file.txt"),
	new \FileManager\Folder("root/aaa/bbb/ccc/ddd"),
	new \FileManager\Folder("root/aaa/bbb/folder"),
	new \FileManager\Folder("root/aaa/bbb"),
];

$fm = new \FileManager\FM($array_ff);
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";
echo '$fm->'."count() => ".$fm->count()."\n";
echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

echo '$fm->get(0)  => '.$fm->get(0)->url->getString()."\n";
echo '$fm->get(1)  => '.$fm->get(1)->url->getString()."\n";
echo '$fm->get(-1) => '.$fm->get(-1)->url->getString()."\n";
echo '$fm->get(-2) => '.$fm->get(-2)->url->getString()."\n";

echo "<br>---------------------------------------------<br><br>";

echo '$fm->getExist() => ['."\n";
foreach($fm->getExist() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getNotExist() => ['."\n";
foreach($fm->getNotExist() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

echo '$fm->getFiles() => ['."\n";
foreach($fm->getFiles() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getFolders() => ['."\n";
foreach($fm->getFolders() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

echo '$fm->getFilter("my%") => ['."\n";
foreach($fm->getFilter("my%") as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getFilter("%file%") => ['."\n";
foreach($fm->getFilter("%file%") as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getFilter("%html") => ['."\n";
foreach($fm->getFilter("%html") as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getFilter("%html", 1) => ['."\n";
foreach($fm->getFilter("%html", 1) as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";


echo "\n";
echo '$fm->getFilter("%html", 0) => ['."\n";
foreach($fm->getFilter("%html", 0) as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->getFilter("html", 0, "extension") => ['."\n";
foreach($fm->getFilter("html", 0, "extension") as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";
