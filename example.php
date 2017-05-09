<?php

require 'vendor/autoload.php';

$arp = new \Paranic\Proc\Net\Arp();
$arp->read();
var_dump($arp->get_records());

$route = new \Paranic\Proc\Net\Route();
$route->read();
var_dump($route->get_records());