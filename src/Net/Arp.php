<?php

namespace Paranic\Proc\Net;

class Arp
{
	private $records = [];

	public function read()
	{
		$this->records = [];

		$file = file('/proc/net/arp');

		array_shift($file);

		foreach ($file as $line)
		{
			$line = trim($line);
			$line = preg_replace('/\s+/S', " ", $line);

			$columns = explode(' ', $line);

			$record = new Arp_Record();
			$record->ip_address = $columns[0];
			$record->hw_type = $columns[1];
			$record->flags = $columns[2];
			$record->hw_address = $columns[3];
			$record->mask = $columns[4];
			$record->device = $columns[5];

			array_push($this->records, $record);
		}
	}

	public function get_records()
	{
		return $this->records;
	}

}