<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload


$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

echo "FILTERED FILES: \n";
$file = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/myfile.txt"));
echo "FF: ".$file->url->getString()."\n";
$filter = 'my%';
echo "::filter('".$filter."')		=> ".$file->filter($filter)."\n";
$filter = '%txt';
echo "::filter('".$filter."')	=> ".$file->filter($filter)."\n";
$filter = '%file%';
echo "::filter('".$filter."')	=> ".$file->filter($filter)."\n";
$filter = 'myfile.txt';
echo "::filter('".$filter."')	=> ".$file->filter($filter)."\n";
echo "\n";
$filter = 'anf%';
echo "::filter('".$filter."')	=> ".$file->filter($filter)."\n";
echo "\n";
$filter = 'txt';
echo "::filter('".$filter."', 'extension')	=> ".$file->filter($filter, 'extension')."\n";


echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";



$ff = new \FileManager\FF(new \UrlParser\Url("root/aaa/bbb/file.txt"));
echo print_r($ff);
echo "<br>---------------------------------------------<br><br>";
$ff = new \FileManager\FF("root/aaa/bbb/");
echo print_r($ff);
echo "<br>---------------------------------------------<br><br>RENAME";
echo "<br>---------------------------------------------<br><br>";

$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff->rename("ffile.txt");
echo print_r($ff);
echo "<br>---------------------------------------------<br><br>";
$ff = new \FileManager\FF("root/aaa/bbb");
$ff->rename("bbbb");
echo print_r($ff);
echo "<br>---------------------------------------------<br><br>MOVE";
echo "<br>---------------------------------------------<br><br>";

$ff = new \FileManager\FF("root/aaa/bbbb/ffile.txt");
$ff->move("root/a");
echo print_r($ff);
echo "<br>---------------------------------------------<br><br>";
$ff = new \FileManager\FF("root/aaa/bbbb");
$ff->move("root/a");
echo print_r($ff);
echo "<br>";
$ff = new \FileManager\FF("root/a");
$ff->move("root/aa");
echo print_r($ff);
