<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$t = microtime(true);
		$i = 0;
		$size = 1000;
		while($i < $size)
			$i++;
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return '$i = 0; while($i < $size) $i++;';
	}
}