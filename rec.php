<?php

use Src\queue\WorkerReceiver;

chdir(dirname(__DIR__));

require_once('vendor/autoload.php');



$worker = new WorkerReceiver();

$worker->listen();