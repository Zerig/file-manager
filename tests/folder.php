<code style="white-space: pre;">

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing


$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] => '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

echo '<b>NOT EXISTING FILE:</b>'."\n";
$file = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/not_existing_folder"));
echo '<b>$file->url->getString() => '.$file->url->getString()."</b>\n";
echo '$file->name      => '.$file->name."\n";
echo '$file->size      => '.$file->size."\n";
echo '$file->mode      => '.$file->mode."\n";

echo "\n";
echo '<b>EXISTING FILE:</b>'."\n";
$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/folder"));
echo '<b>$file->url->getString() => '.$file->url->getString()."</b>\n";
echo '$file->name      => '.$file->name."\n";
echo '$file->filename  => '.$file->filename."\n";
echo '$file->extension => '.$file->extension."\n";
echo '$file->size      => '.$file->size."\n";
echo '$file->mode      => '.$file->mode."\n";
echo "\n";
echo '$file->mime      => '.$file->mime."\n";

echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb"));
$file_copy = $folder->copy();
echo '<b>$file_copy = $file->copy()</b>'."\n";
echo '$file_copy->url->getString() => '.$file_copy->url->getString()."\n";
