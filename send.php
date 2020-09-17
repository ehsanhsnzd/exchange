<?php

use Src\queue\WorkerSender;

chdir(dirname(__DIR__));
require_once('vendor/autoload.php');

$sender = new WorkerSender();
$sender->execute(json_encode([1,2]));