<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$i = 0;
		/* The Test */
		$t = microtime(true);
		while($i < 2000){
			empty($notSet);
			++$i;
		}
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'empty() with var that was *not* set';
	}
}