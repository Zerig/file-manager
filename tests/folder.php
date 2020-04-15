<code style="white-space: pre;">

<?php
require_once '../src/UrlParser/Url.php';
require_once '../src/FileManager/FF.php';
require_once '../src/FileManager/File.php';
require_once '../src/FileManager/Folder.php';

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";




$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb"));
echo print_r($folder);
echo "<br>---------------------------------------------<br><br>";
$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb"));
echo print_r($folder);
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";
