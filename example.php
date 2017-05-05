<?php

require 'vendor/autoload.php';

$arp = new \Paranic\Proc\Net\Arp();
$arp->read();

$arp_record = $arp->find('ip_address', '127.0.0.1'))

var_dump($arp_record);