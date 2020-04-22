<code style="white-space: pre;">

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] => '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

echo '<b>NOT EXISTING FILE:</b>'."\n";
$ff_not = new \FileManager\FF(new \UrlParser\Url("root/aaa/bbb/not_existing_file.txt"));
echo '<b>$ff_not->url->getString() => '.$ff_not->url->getString()."</b>\n";
echo '$ff_not->name      => '.$ff_not->name."\n";
echo '$ff_not->size      => '.$ff_not->size."\n";
echo '$ff_not->mode      => '.$ff_not->mode."\n";

echo "\n";
echo '<b>EXISTING FF FILE:</b>'."\n";
$ff_file = new \FileManager\FF(new \UrlParser\Url("root/aaa/bbb/file.txt"));
echo '<b>$ff_file->url->getString() => '.$ff_file->url->getString()."</b>\n";
echo '$ff_file->name      => '.$ff_file->name."\n";
echo '$ff_file->size      => '.$ff_file->size."\n";
echo '$ff_file->mode      => '.$ff_file->mode."\n";

echo "\n";
echo '<b>EXISTING FF FOLDER:</b>'."\n";
$ff_folder = new \FileManager\FF(new \UrlParser\Url("root/aaa/bbb"));
echo '<b>$ff_folder->url->getString() => '.$ff_folder->url->getString()."</b>\n";
echo '$ff_folder->name      => '.$ff_folder->name."\n";
echo '$ff_folder->size      => '.$ff_folder->size."\n";
echo '$ff_folder->mode      => '.$ff_folder->mode."\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$ff_not->exist()    => '.$ff_not->exist()."</b>\n";
echo '<b>$ff_file->exist()   => '.$ff_file->exist()."</b>\n";
echo '<b>$ff_folder->exist() => '.$ff_folder->exist()."</b>\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$ff_not->isFolder()    => '.$ff_not->isFolder()."</b>\n";
echo '<b>$ff_not->isFile()      => '.$ff_not->isFile()."</b>\n";
echo "\n";
echo '<b>$ff_file->isFolder()   => '.$ff_file->isFolder()."</b>\n";
echo '<b>$ff_file->isFile()     => '.$ff_file->isFile()."</b>\n";
echo "\n";
echo '<b>$ff_folder->isFolder() => '.$ff_folder->isFolder()."</b>\n";
echo '<b>$ff_folder->isFile()   => '.$ff_folder->isFile()."</b>\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$origin_ff_file = $ff_file->rename("new-file.txt")'."</b>\n";
$origin_ff_file = $ff_file->rename("new-file.txt");
echo '$ff_file->url->getString()        => '.$ff_file->url->getString()."\n";
echo '$ff_file->name                    => '.$ff_file->name."\n";
echo '$ff_file->exist()                 => '.$ff_file->exist()."\n";
echo "\n";
echo '$origin_ff_file->url->getString() => '.$origin_ff_file->url->getString()."\n";
echo '$origin_ff_file->name             => '.$origin_ff_file->name."\n";
echo '$origin_ff_file->exist()          => '.$origin_ff_file->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$origin_ff_folder = $ff_folder->rename("new-bbb")'."</b>\n";
$origin_ff_folder = $ff_folder->rename("new-bbb");
echo '$ff_folder->url->getString()        => '.$ff_folder->url->getString()."\n";
echo '$ff_folder->name                    => '.$ff_folder->name."\n";
echo '$ff_folder->exist()                 => '.$ff_folder->exist()."\n";
echo "\n";
echo '$origin_ff_folder->url->getString() => '.$origin_ff_folder->url->getString()."\n";
echo '$origin_ff_folder->name             => '.$origin_ff_folder->name."\n";
echo '$origin_ff_folder->exist()          => '.$origin_ff_folder->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

$ff_file = new \FileManager\FF(new \UrlParser\Url("root/aaa/bb/file.txt"));
echo '$ff_file->url->getString()        => '.$ff_file->url->getString()."\n";
echo '$ff_file->exist()                 => '.$ff_file->exist()."\n";
echo "\n";
echo '<b>$origin_ff_file = $ff_file->move("root/aaa/b")'."</b>\n";

$origin_ff_file = $ff_file->move("root/aaa/b");
echo '$ff_file->url->getString()        => '.$ff_file->url->getString()."\n";
echo '$ff_file->exist()                 => '.$ff_file->exist()."\n";
echo "\n";
echo '$origin_ff_file->url->getString() => '.$origin_ff_file->url->getString()."\n";
echo '$origin_ff_file->exist()          => '.$origin_ff_file->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

$ff_folder = new \FileManager\FF(new \UrlParser\Url("root/aaa/bb/folder"));
echo '$ff_folder->url->getString()        => '.$ff_folder->url->getString()."\n";
echo '$ff_folder->exist()                 => '.$ff_folder->exist()."\n";
echo "\n";
echo '<b>$origin_ff_folder = $ff_folder->move("root/aaa/b")'."</b>\n";

$origin_ff_folder = $ff_folder->move("root/aaa/b");
echo '$ff_folder->url->getString()        => '.$ff_folder->url->getString()."\n";
echo '$ff_folder->exist()                 => '.$ff_folder->exist()."\n";
echo "\n";
echo '$origin_ff_folder->url->getString() => '.$origin_ff_folder->url->getString()."\n";
echo '$origin_ff_folder->exist()          => '.$origin_ff_folder->exist()."\n";

echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

$ff_file = new \FileManager\FF(new \UrlParser\Url("root/aa/myfile.txt"));
echo '<b>$ff_file->url->getString() => '.$ff_file->url->getString()."</b>\n";
echo '$ff_file->name => '.$ff_file->name."\n";
echo '$ff_file->size => '.$ff_file->size."\n";
echo '$ff_file->mode => '.$ff_file->mode."\n";
echo "\n";
echo '$ff_file->has("my%")          => '.$ff_file->has("my%")."\n";
echo '$ff_file->has("%txt")         => '.$ff_file->has("%txt")."\n";
echo '$ff_file->has("%file%")       => '.$ff_file->has("%file%")."\n";
echo '$ff_file->has("myfile.txt")   => '.$ff_file->has("myfile.txt")."\n";
echo "\n";
echo '$ff_file->has("my")           => '.$ff_file->has("my")."\n";
echo '$ff_file->has("bhfm%")        => '.$ff_file->has("bhfm%")."\n";
echo "\n";

echo '$ff_file->has("0666", "mode") => '.$ff_file->has("0666", "mode")."\n";
echo '$ff_file->has("0%", "mode")   => '.$ff_file->has("0%", "mode")."\n";
echo '$ff_file->has("0777", "mode") => '.$ff_file->has("0777", "mode")."\n";
