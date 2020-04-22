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

$fm = new \FileManager\FM($array_ff);
echo '$fm->pop()'."\n";
$fm->pop();
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->pop(3)'."\n";
$fm->pop(3);
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

$fm = new \FileManager\FM($array_ff);
echo '$fm->shift()'."\n";
$fm->shift();
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
echo '$fm->shift(3)'."\n";
$fm->shift(3);
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

$fm = new \FileManager\FM($array_ff);
echo '$fm->add(new \FileManager\File("root/aaa/bbb/new-file.html"))'."\n";
$fm->add(new \FileManager\File("root/aaa/bbb/new-file.html"));
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
$fm = new \FileManager\FM($array_ff);
echo '$fm->add(['."\n";
echo "	".'new \FileManager\File("root/aaa/bbb/new-file_1.html"),'."\n";
echo "	".'new \FileManager\File("root/aaa/bbb/new-file_2.html"),'."\n";
echo "	".'new \FileManager\File("root/aaa/bbb/new-file_3.html")'."\n";
echo '])'."\n";
$fm->add([
	new \FileManager\File("root/aaa/bbb/new-file_1.html"),
	new \FileManager\File("root/aaa/bbb/new-file_2.html"),
	new \FileManager\File("root/aaa/bbb/new-file_3.html")
]);
echo '$fm->get() => ['."\n";
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";
