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

$fm->remove();
echo '<b>$fm->'."remove()</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

$fm = new \FileManager\FM($array_ff);
$fm->remove(new \FileManager\File("root/aaa/bbb/file.txt"));
echo '<b>$fm->'."remove(new \FileManager\File('root/aaa/bbb/file.txt'))</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
$remove_array = $fm->getFilter("%html");
echo '$remove_array = ::getFilter("%html")'."\n";
echo '$remove_array => [<br>';
foreach($remove_array as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";
echo "\n";
$fm->remove($remove_array);
echo '<b>$fm->remove(new \FileManager\File($remove_array))</b>'."\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";

echo '$remove_fm = new \FileManager\FM($fm->getFilter("%d%"))'."\n";
$remove_fm = new \FileManager\FM($fm->getFilter("%d%"));
echo '$remove_fm->removeFilter("%d%", 0)'."\n";
echo '$remove_fm->get() => [<br>';
foreach($remove_fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";
$fm->remove($remove_fm);
echo '<b>$fm->remove($remove_fm)</b>'."\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

$fm = new \FileManager\FM($array_ff);
$fm->removeFiles();
echo '<b>$fm->'."removeFiles()</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
$fm->removeNotExist();
echo '<b>$fm->'."removeNotExist()</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "\n";
$fm->removeFolders();
echo '<b>$fm->'."removeFolder()</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]\n";

echo "<br>---------------------------------------------<br><br>";

$fm = new \FileManager\FM($array_ff);
$fm->removeFilter("%html");
echo '<b>$fm->'."removeFilter()</b>\n";
echo '$fm->get() => [<br>';
foreach($fm->get() as $ff){
	echo "	".$ff->url->getString()."\n";
}
echo "]";
