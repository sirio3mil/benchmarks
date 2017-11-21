<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$x = array_fill(5, 1000, PHP_INT_MAX);
		$t = microtime(true);
		for($i = 0; $i < sizeof($x); $i++)
			;
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'for without pre calc array sizeof()';
	}
}