<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
$root_folder = new \FileManager\Folder("root");
$root_folder->delete();
$root_folder_origin = new \FileManager\Folder("root_origin");
$root_folder_origin->copy("root");
