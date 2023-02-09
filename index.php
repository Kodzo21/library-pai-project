<?php

require 'Routing.php';

$path=trim($_SERVER['REQUEST_URI'],'/');
$path=parse_url($path,PHP_URL_PATH);
file_put_contents('path',$path."\n",FILE_APPEND);

Routing::get('','DefaultController');
Routing::get('books','BookController');
Routing::get('profile','ProfileController');
Routing::get('like','BookController');
Routing::get('dislike','BookController');
Routing::post('login','SecurityController');
Routing::post('register','SecurityController');
Routing::post('logout','SecurityController');
Routing::post('addBook','BookController');
Routing::post('search','BookController');
Routing::post('manage','ProfileController');
Routing::post('reserve','BookController');
Routing::post('returnBook','BookController');

Routing::run($path);
