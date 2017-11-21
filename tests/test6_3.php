<?php

class cTestFile implements iTestFile{

	public static function run(): float{
		ob_start();
		$i = 0;
		$t = microtime(true);
		while($i < 1000){
			echo 'aaaaaaa' . 'aaaaaaa' . 'aaaaaaa' . 'aaaaaaa';
			++$i;
		}
		$tmp = microtime(true) - $t;
		ob_end_clean();
		return $tmp;
	}

	public static function getTitle(): string{
		return 'echo \'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\'';
	}
}