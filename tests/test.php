<code style="white-space: pre;">
<?php
//require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '../src/UrlParser/Url.php';

$GLOBALS["server_root"] = new \UrlParser\Url("root");
echo '$GLOBALS["server_root"] = '.$GLOBALS["server_root"]->getString().'<br>';

echo "<br>---------------------------------------------<br><br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo print_r($GLOBALS["url"])."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url('s', '\\');
echo print_r($GLOBALS["url"])."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo print_r($GLOBALS["url"])."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url('C:\xampp\tmp\php2410.tmp');
echo print_r($GLOBALS["url"])."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

$GLOBALS["url"]->pop(2);
echo "pop(2) => "."URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->shift();
echo "shift() => "."URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->swap("aaa", "ccc");
echo "swap('aaa', 'ccc') => "."URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html?member=me&age=15#hashtag");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "getScheme('string') => ".$GLOBALS["url"]->getScheme('string')."<br>";
echo "getHost('string') => ".$GLOBALS["url"]->getHost('string')."<br>";
echo "getRoot('string') => ".$GLOBALS["url"]->getRoot('string')."<br>";
echo "getPath('string') => ".$GLOBALS["url"]->getPath('string')."<br>";
echo "getQuery('string') => ".$GLOBALS["url"]->getQuery('string')."<br>";
echo "getFragment('string') => ".$GLOBALS["url"]->getFragment('string')."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "getString() => ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "hasFile() => ".$GLOBALS["url"]->hasFile()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "hasFile() => ".$GLOBALS["url"]->hasFile()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "getDepth() => ".$GLOBALS["url"]->getDepth()."<br>";

echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";

echo "getDepth() => ".$GLOBALS["url"]->getDepth()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "linkRoot() => ".$GLOBALS["url"]->linkRoot()."<br>";
echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "linkRoot() => ".$GLOBALS["url"]->linkRoot()."<br>";


echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeScheme();
echo "removeScheme() => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeHost();
echo "removeHost() => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeRoot();
echo "removeRoot() => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removePath();
echo "removePath() => URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removePath(["aaa", "bbb"]);
echo "removePath(['aaa', 'bbb']) => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";


$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html?member=me&age=15");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeQuery();
echo "removeQuery() => URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html?member=me&age=15");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeQuery("member");
echo "removeQuery('member') => URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";
$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html?member=me&age=15");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeQuery(["member", "age"]);
echo "removeQuery('member') => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html#hashtag");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->removeFragment();
echo "removeFragment() => URL: ".$GLOBALS["url"]->getString()."<br>";

echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";



$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->addPath('ccc');
echo "addRoot('ccc') => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->addPath('ccc');
echo "addRoot('ccc') => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->addPath(['ccc', 'ddd.html']);
echo "addRoot(['ccc', 'ddd.html']) => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->addPath(['ccc', 'ddd']);
echo "addRoot(['ccc', 'ddd']) => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";





$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->beforePath(['rrr', 'sss']);
echo "beforePath(['rrr', 'sss']) => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>---------------------------------------------<br><br>";


$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->beforePath('ccc');
echo "beforePath('ccc') => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->beforePath('ccc');
echo "beforePath('ccc') => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->beforePath(['ccc', 'ddd.html']);
echo "beforePath(['ccc', 'ddd.html']) => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>";

$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->beforePath(['ccc', 'ddd']);
echo "beforePath(['ccc', 'ddd']) => PATH: ".$GLOBALS["url"]->getPath("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";



$GLOBALS["url"] = new \UrlParser\Url("http://www.web.cz//root/aaa/bbb/a.html");
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
$GLOBALS["url"]->addQuery(['color' => 'red', 'size' => 15]);
echo "addQuery(['color' => 'red', 'size' => 15]) => QUERY: ".$GLOBALS["url"]->getQuery("string")."<br>";
echo "URL: ".$GLOBALS["url"]->getString()."<br>";
echo "<br>---------------------------------------------<br><br>";
