<?php
// 		Корневая папка
	$rootDir = dirname(__FILE__);
	$replace = str_replace('\\','/', $rootDir);
	define(ROOT, $replace);
		
// 		Доступы к базе данных

	define(TYPE, 'mysql');
	define(HOST, 's11.thehost.com.ua');
	define(DB, 'autodor-selfit');
	define(LOG, 'autodor-admin');
	define(PAS, 'autodor-admin');
?>