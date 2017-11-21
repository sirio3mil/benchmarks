<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$t = microtime(true);
		$size = 1000;
		for($i = 0; $i < $size; ++$i)
			;
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'for($i = 0; $i < $size; ++$i)';
	}
}