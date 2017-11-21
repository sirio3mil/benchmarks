<?php
header('Content-Type: application/json');
const TESTS_FOLDER = '../tests';
try{
	$json = [];
	$action = (!empty($_REQUEST['action']))?$_REQUEST['action']:null;
	switch($action){
		case 'DevolverListadoTests':
			$directoryIterator = new DirectoryIterator(TESTS_FOLDER);
			$json['files'] = [];
			foreach($directoryIterator as $fileInfo){
				if($fileInfo->isDot()){
					continue;
				}
				$json['files'][] = $fileInfo->getFilename();
			}
			break;
		case 'EjecutarTest':
			if(empty($_POST['test'])){
				throw new Exception("No se ha especificado ningún test a ejecutar");
			}
			$filepath = TESTS_FOLDER . DIRECTORY_SEPARATOR . $_POST['test'];
			if(!file_exists($filepath)){
				throw new Exception("El archivo de test $filepath no existe");
			}
			$realpath = realpath($filepath);
			$data = pathinfo($realpath);
			if(strtolower($data['extension']) !== 'php'){
				throw new Exception("El archivo de test $filepath no es un archivo de php válido");
			}
			include_once '../class/iTestFile.php';
			include_once $realpath;
			$json['elapsed'] = cTestFile::run();
			$json['title'] = cTestFile::getTitle();
			break;
		default:
			throw new Exception("Operación no reconocida");
	}
}
catch(Exception $e){
	$json['error'] = $e->getMessage();
}
finally {
	echo json_encode($json);
}