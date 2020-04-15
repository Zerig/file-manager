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


/*

$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/folder"));
echo print_r($folder);
echo "<br>---------------------------------------------<br><br>";
$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/folder_not_exist"));
echo print_r($folder);


echo "<br>---------------------------------------------<br><br>RENAME";
echo "<br>---------------------------------------------<br><br>";


$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/folder"));
$folder->rename("ffolder");
echo print_r($folder);

*/
echo "<br>---------------------------------------------<br><br> COPY";
echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/empty_folder"));
echo "URL: ".$folder->url->getString()."<br>";
$copy_folder = $folder->copy("empty_ffolder");
echo "COPY FFOLDER EXIST(): ".$copy_folder->exist()."<br>";

echo "<br>---------------------------------------------<br><br>";

$folder = new \FileManager\Folder(new \UrlParser\Url("root/aaa/bbb/folder"));
echo "URL: ".$folder->url->getString()."<br>";
$copy_folder = $folder->copy("ffolder");
echo "COPY FFOLDER EXIST(): ".$copy_folder->exist()."<br>";
