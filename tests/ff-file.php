<code style="white-space: pre;">

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] => '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

echo '<b>NOT EXISTING FILE:</b>'."\n";
$file_not = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/not_existing_file.txt"));
echo '<b>$file_not->url->getString() => '.$file_not->url->getString()."</b>\n";
echo '$file_not->name => '.$file_not->name."\n";
echo '$file_not->size => '.$file_not->size."\n";
echo '$file_not->mode => '.$file_not->mode."\n";

echo "\n";
echo '<b>EXISTING FILE:</b>'."\n";
$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/file.txt"));
echo '<b>$file->url->getString() => '.$file->url->getString()."</b>\n";
echo '$file->name => '.$file->name."\n";
echo '$file->size => '.$file->size."\n";
echo '$file->mode => '.$file->mode."\n";


echo "<br>---------------------------------------------<br><br>";

echo '<b>$file_not->exist()  => '.$file_not->exist()."</b>\n";
echo '<b>$file->exist()      => '.$file->exist()."</b>\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$file_not->isFolder() => '.$file_not->isFolder()."</b>\n";
echo '<b>$file_not->isFile()   => '.$file_not->isFile()."</b>\n";
echo "\n";
echo '<b>$file->isFolder()     => '.$file->isFolder()."</b>\n";
echo '<b>$file->isFile()       => '.$file->isFile()."</b>\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$origin_ff_file = $file->rename("new-file.txt")'."</b>\n";
$origin_ff_file = $file->rename("new-file.txt");
echo '$file->url->getString()           => '.$file->url->getString()."\n";
echo '$file->name                       => '.$file->name."\n";
echo '$file->exist()                    => '.$file->exist()."\n";
echo "\n";
echo '$origin_ff_file->url->getString() => '.$origin_ff_file->url->getString()."\n";
echo '$origin_ff_file->name             => '.$origin_ff_file->name."\n";
echo '$origin_ff_file->exist()          => '.$origin_ff_file->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bb/file.txt"));
echo '$file->url->getString()        => '.$file->url->getString()."\n";
echo '$file->exist()                 => '.$file->exist()."\n";
echo "\n";
echo '<b>$origin_ff_file = $file->move("root/aaa/b")'."</b>\n";

$origin_ff_file = $file->move("root/aaa/b");
echo '$file->url->getString()        => '.$file->url->getString()."\n";
echo '$file->exist()                 => '.$file->exist()."\n";
echo "\n";
echo '$origin_ff_file->url->getString() => '.$origin_ff_file->url->getString()."\n";
echo '$origin_ff_file->exist()          => '.$origin_ff_file->exist()."\n";

echo "<br>---------------------------------------------";
echo "<br>---------------------------------------------<br><br>";

$file = new \FileManager\File(new \UrlParser\Url("root/aa/myfile.txt"));
echo '<b>$file->url->getString() => '.$file->url->getString()."</b>\n";
echo '$file->name => '.$file->name."\n";
echo '$file->size => '.$file->size."\n";
echo '$file->mode => '.$file->mode."\n";
echo "\n";
echo '$file->has("my%")          => '.$file->has("my%")."\n";
echo '$file->has("%txt")         => '.$file->has("%txt")."\n";
echo '$file->has("%file%")       => '.$file->has("%file%")."\n";
echo '$file->has("myfile.txt")   => '.$file->has("myfile.txt")."\n";
echo "\n";
echo '$file->has("my")           => '.$file->has("my")."\n";
echo '$file->has("bhfm%")        => '.$file->has("bhfm%")."\n";
echo "\n";

echo '$file->has("0666", "mode") => '.$file->has("0666", "mode")."\n";
echo '$file->has("0%", "mode")   => '.$file->has("0%", "mode")."\n";
echo '$file->has("0777", "mode") => '.$file->has("0777", "mode")."\n";
