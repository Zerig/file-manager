<code style="white-space: pre;">
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="Upload" name="submit">
</form>
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing

$server_file;
$local_file;

if(isset($_POST["submit"])){
	$server_file = new \FileManager\File(new \UrlParser\Url(["root/a", $_FILES["file"]["name"]]));
	$local_file = new \FileManager\File($_FILES["file"]["tmp_name"]);

	echo '$server_file->exist() => '.$server_file->exist()."\n";
	echo '$local_file->exist()  => '.$local_file->exist()."\n";

	$server_file->upload($local_file);
	echo '<b>$server_file->upload($local_file)</b>'."\n";
	echo "<br>---------------------------------------------";
	echo "<br>---------------------------------------------<br><br>";
}


echo '<b>$server_file->url->getString() => </b>'.$server_file->url->getString()."\n";
echo '<b>$local_file->url->getString()  => </b>'.$local_file->url->getString()."\n";
echo '<b>$server_file->exist() => </b>'.$server_file->exist()."\n";
echo '<b>$local_file->exist()  => </b>'.$local_file->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

echo '<b>$copy_file = $server_file->copy()</b>'."\n";
$copy_file = $server_file->copy();
echo '$server_file->url->getString() => '.$server_file->url->getString()."\n";
echo '$copy_file->url->getString()   => '.$copy_file->url->getString()."\n";

echo '$server_file->exist() => '.$server_file->exist()."\n";
echo '$copy_file->exist()   => '.$copy_file->exist()."\n";

echo "<br>---------------------------------------------<br><br>";

echo '$server_file->exist() => '.$server_file->exist()."\n";
echo "\n";
echo '<b>$server_file->delete()</b>'."\n";
$server_file->delete();
echo '$server_file->url->getString() => '.$server_file->url->getString()."\n";
echo '$server_file->exist() => '.$server_file->exist()."\n";
