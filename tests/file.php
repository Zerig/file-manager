<code style="white-space: pre;">
<?php
require_once '../src/UrlParser/url.php';
require_once '../src/FileManager/FF.php';
require_once '../src/FileManager/File.php';

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";


$ff = new \FileManager\File(new \UrlParser\Url("root/aaa/bbb/file.txt"));
echo print_r($ff);
