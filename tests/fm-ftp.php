<code style="white-space: pre;">
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="file[]" multiple>
	<input type="submit" value="Upload" name="submit">
</form>

<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing



$server_fm = new \FileManager\FM();
$local_fm = new \FileManager\FM();

if(isset($_POST["submit"])){
	$files = my__multipleFiles($_FILES);

	foreach($files as $file){
		$server_fm->add( new \FileManager\File(new \UrlParser\Url(["root/a", $file["name"]])) );
		$local_fm->add( new \FileManager\File($file["tmp_name"]) );
	}
	$server_fm->upload($local_fm);
}

echo '<b>$server_fm->get() => [</b>'."\n";
foreach($server_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";

echo "\n";
echo '<b>$local_fm->get() => [</b>'."\n";
foreach($local_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";

echo "\n";
echo '<b>$server_fm->exist() => [</b>'."\n";
foreach($server_fm->exist() as $key => $val){
	echo "	".'['.$key.'] => '.$val."\n";
}
echo ']'."\n";

echo "<br>---------------------------------------------<br><br>";

$delete_fm = clone $server_fm;
$notFiltered_fm = $delete_fm->removeFilter("%zana%");
$delete_fm->delete();

echo '$delete_fm = clone $server_fm'."\n";
echo '$notFiltered_fm = $delete_fm->removeFilter("%zana%")'."\n";
echo '<b>$delete_fm->delete()</b>'."\n";
echo "\n";

echo '$delete_fm->get() => ['."\n";
foreach($delete_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";
echo '$notFiltered_fm->get() => ['."\n";
foreach($notFiltered_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";
echo '$delete_fm->exist() => ['."\n";
foreach($delete_fm->exist() as $key => $val){
	echo "	".'['.$key.'] => '.$val."\n";
}
echo ']'."\n";

echo '$server_fm->exist() => ['."\n";
foreach($server_fm->exist() as $key => $val){
	echo "	".'['.$key.'] => '.$val."\n";
}
echo ']'."\n";

echo "<br>---------------------------------------------<br><br>";

$move_fm = clone $server_fm;
$notFiltered_fm = $move_fm->removeFilter("%zana%", 0);
$move_fm->move("root/aa");

echo '$move_fm = clone $server_fm'."\n";
echo '$notFiltered_fm = $move_fm->removeFilter("%zana%", 0)'."\n";
echo '<b>$move_fm->move("root/aa")</b>'."\n";

echo "\n";
echo '$move_fm->get() => ['."\n";
foreach($move_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";
echo '$notFiltered_fm->get() => ['."\n";
foreach($notFiltered_fm->get() as $key => $val){
	echo "	".'['.$key.'] => '.$val->url->getString()."\n";
}
echo ']'."\n";
echo '$move_fm->exist() => ['."\n";
foreach($move_fm->exist() as $key => $val){
	echo "	".'['.$key.'] => '.$val."\n";
}
echo ']'."\n";
echo '$server_fm->exist() => ['."\n";
foreach($server_fm->exist() as $key => $val){
	echo "	".'['.$key.'] => '.$val."\n";
}
echo ']'."\n";





















function my__multipleFiles($_files){
	$files = [];

	if(is_array($_files["file"]["tmp_name"])){
		for($i = 0; $i < count($_files["file"]["tmp_name"]); $i++){
			$files[] = [
				"name" => $_files["file"]["name"][$i],
				"type" => $_files["file"]["type"][$i],
				"tmp_name" => $_files["file"]["tmp_name"][$i],
				"error" => $_files["file"]["error"][$i],
				"size" => $_files["file"]["size"][$i]
			];

		}
	}else{
		$files[] = $_files["file"];
	}

	return $files;
}
