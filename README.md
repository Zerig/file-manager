# FILE MANAGER \ FF
 parent class of every File and Folder


```php
// BOTH variant are possile ↓
$ff = new \FileManager\FF("root/aaa/bbb/file.txt");
$ff = new \FileManager\FF( new \UrlParser\Url("root/aaa/bbb/file.txt") );

public $url 	=> \UrlParser\Url::getString() => "root/aaa/bbb/file.txt"
public $size 	=> 80
public $name 	=> "file.txt"
public $mode 	=> 0777

public $dir 	=> \UrlParser\Url::getString() => "root/aaa/bbb"
```
