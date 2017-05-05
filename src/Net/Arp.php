<?php

namespace Paranic\Proc\Net;

class Arp
{
	private $records = [];

	public function read()
	{
		$this->records = [];

		$proc_net_arp = file('/proc/net/arp');

		array_shift($proc_net_arp);

		foreach ($proc_net_arp as $line)
		{
			$line = trim($line);
			$line = preg_replace('/\s+/S', " ", $line);

			$columns = explode(' ', $line);

			$arp_record = new Arp_Record();
			$arp_record->ip_address = $columns[0];
			$arp_record->hw_type = $columns[1];
			$arp_record->flags = $columns[2];
			$arp_record->hw_address = $columns[3];
			$arp_record->mask = $columns[4];
			$arp_record->device = $columns[5];

			array_push($this->records, $arp_record);
		}
	}

	public function get_records()
	{
		return $this->records;
	}

	public function find($property, $value)
	{
		return array_filter($this->records,
			function($record) use ($property, $value)
			{
				if (isset($record->$property))
				{
					if ($record->$property == $value) return true;
				}
			});
	}
}