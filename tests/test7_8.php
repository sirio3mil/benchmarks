<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		$aHash = array_fill(5, 1000, PHP_INT_MAX);
		reset($aHash);
		$t = microtime(true);
		while(list(, $val) = each($aHash))
			;
		return (microtime(true) - $t);
	}

	public static function getTitle(): string{
		return 'while(list(,$val) = each($aHash))';
	}
}