<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


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
