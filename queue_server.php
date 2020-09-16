<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\queue\WorkerReceiver;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$worker = new WorkerReceiver();
$worker->listen();