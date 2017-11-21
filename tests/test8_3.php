<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$t = microtime(true);
		for($i = 0; $i < 1000; $i++)
			;
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'for($i = 0; $i < 1000; $i++)';
	}
}