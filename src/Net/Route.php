<?php

namespace Paranic\Proc\Net;

class Route
{
	private $records = [];

	public function read()
	{
		$this->records = [];

		$file = file('/proc/net/route');

		array_shift($file);

		foreach ($file as $line)
		{
			$line = trim($line);
			$line = preg_replace('/\s+/S', " ", $line);

			$columns = explode(' ', $line);

			$record = new Route_Record();
			$record->interface = $columns[0];
			$record->destination = $columns[1];
			$record->gateway = $columns[2];
			$record->flags = $columns[3];
			$record->references = $columns[4];
			$record->use = $columns[5];
			$record->metric = $columns[6];
			$record->mask = $columns[7];
			$record->mtu = $columns[8];
			$record->window = $columns[9];
			$record->irtt = $columns[10];

			array_push($this->records, $record);
		}
	}

	public function get_records()
	{
		return $this->records;
	}
}