<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$isset = true;
		$i = 0;
		/* The Test */
		$t = microtime(true);
		while($i < 2000){
			isset($isset);
			++$i;
		}
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'isSet() with var that was set';
	}
}