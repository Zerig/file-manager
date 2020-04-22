<code style="white-space: pre;">

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing


$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] => '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

echo '<b>NOT EXISTING FILE:</b>'."\n";
$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/not_existing_folder"));
echo '<b>$folder->url->getString() => '.$folder->url->getString()."</b>\n";
echo '$folder->name      => '.$folder->name."\n";
echo '$folder->size      => '.$folder->size."\n";
echo '$folder->mode      => '.$folder->mode."\n";

echo "\n";
echo '<b>EXISTING FILE:</b>'."\n";
$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb"));
echo '<b>$folder->url->getString() => '.$folder->url->getString()."</b>\n";
echo '$folder->name      => '.$folder->name."\n";
echo '$folder->size      => '.$folder->size."\n";
echo '$folder->mode      => '.$folder->mode."\n";

echo "<br>---------------------------------------------<br><br>";

$folder_copy = $folder->copy();
echo '<b>$folder_copy = $folder->copy()</b>'."\n";
echo '$folder_copy->url->getString() => '.$folder_copy->url->getString()."\n";

echo "<br>---------------------------------------------<br><br>";

$scan_folder = $folder->scan();
echo '<b>$scan_folder = $folder->scan() => [</b>'."\n";
foreach($scan_folder as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";

echo "<br>---------------------------------------------<br><br>";

$scanTree_folder = $folder->scanTree("name");
echo '<b>$scanTree_folder = $folder->scanTree("name") => [</b>'."\n";
echo print_r($scanTree_folder);
/*foreach($scanTree_folder as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}*/
echo ']'."\n";

echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder("root/aaa/bbb/empty_folder");
echo '$folder = new \FileManager\Folder("root/aaa/bbb/empty_folder")'."\n";
echo '$folder->exist() => '.$folder->exist()."\n";
$folder->delete();
echo '<b>$folder->delete()</b>'."\n";
echo '$folder->exist() => '.$folder->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder("root/aaa/bbb/folder");
echo '$folder = new \FileManager\Folder("root/aaa/bbb/folder")'."\n";
echo '$folder->exist() => '.$folder->exist()."\n";
$folder->delete();
echo '<b>$folder->delete()</b>'."\n";
echo '$folder->exist() => '.$folder->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder("root/aaa/bbb/folder_2");
echo '$folder = new \FileManager\Folder("root/aaa/bbb/folder_2")'."\n";

echo '$folder->exist() => '.$folder->exist()."\n";

$scan_folder = $folder->scan();
echo '$scan_folder = $folder->scan() => ['."\n";
foreach($scan_folder as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";

echo "\n";
$folder->clean();
echo '<b>$folder->clean()</b>'."\n";
echo '$folder->exist() => '.$folder->exist()."\n";
$scan_folder = $folder->scan();
echo '$scan_folder = $folder->scan() => ['."\n";
foreach($scan_folder as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";
