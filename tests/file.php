<code style="white-space: pre;">
<?php
require_once '../src/UrlParser/url.php';
require_once '../src/FileManager/FF.php';

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';
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
