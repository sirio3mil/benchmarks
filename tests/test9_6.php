<?php
error_reporting(0);

class cTestFile implements iTestFile{

	public static function run(): float{
		$i = 0;
		/* The Test */
		$t = microtime(true);
		while($i < 2000){
			is_array($array);
			++$i;
		}
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'is_array() of a non set value';
	}
}