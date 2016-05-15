<?php
// 		Задаем переменные для подключения классов
	$option = 'index';
   	$getOption = $_GET['opt'];
// 		Проверяем пустая ли переменная
	if (isset($getOption)) {
// 			Путь подключения класса
		$path = ROOT.'/engine/classes/'.$getOption.'.class.php';
// 			Проверяем существует ли такой файл
		if (file_exists($path)) {
// 				Если файл существует погда подключаем его
			require_once $path;
// 				Проверяем в подключенном файле нужный ли класс
			if (class_exists($getOption)) {
// 					Если все правильно переопределяем переменную option
				$option = $getOption;
			}
		}
	}

// 		Подключаем файл index.class.php по умолчанию
	require_once ROOT.'/engine/classes/'.$option.'.class.php';
// 		Создаем объект класса
	$obj = new $option;
	$obj->getBody();
?>