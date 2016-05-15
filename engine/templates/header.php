<?php
    if(isset($_SESSION['lang'])){$lang = $_SESSION['lang'];} else{$lang = "ukr";};
    $url = file_get_contents($_SERVER['DOCUMENT_ROOT']."/engine/lang/".$lang.".json");
    $lang_arr = json_decode($url, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="engine/templates/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="engine/templates/assets/css/exo2.css">
    <link rel="stylesheet" href="engine/templates/assets/css/al_style.css">
    <link rel="stylesheet" href="engine/templates/assets/css/animate.min.css">
    <link rel="stylesheet" href="engine/templates/assets/css/creative.css">
    <link rel="stylesheet" href="engine/templates/assets/css/font-awesome.css">
    <link rel="stylesheet" href="engine/templates/assets/css/pop-up.css">
    <link rel="stylesheet" href="engine/templates/assets/css/passport.css">
    <link rel="stylesheet" href="engine/templates/assets/css/uploadify.css">
    <link rel="stylesheet" href="engine/templates/assets/css/all_tickets.css">
    <link rel="stylesheet" href="engine/templates/assets/css/main.css">
    <link rel="stylesheet" href="engine/templates/assets/css/daterangepicker.css" />
    <script src="engine/templates/assets/js/modernizr.custom.js"></script>
</head>
<body class="page-top">
<!--        pop up error          -->
<div class="popup-message">
    <div class="message">
        <img src="engine/templates/assets/img/error.png" alt="error">
        <span id="mess-text"></span>
    </div>
    <div class="close-message">
        <img src="engine/templates/assets/img/close.png" alt="close">
    </div>
    <div class="time-line"></div>
</div>
<!--      left menu tablet        -->
<div class="pl-menu">
    <div class="title">
        <a href="#">Меню</a>
        <img id="close-menu-tablet" src="engine/templates/assets/img/close-menu-tablet.png" alt="close">
    </div>
    <div class="main-menu-tablet">
        <div><a href="?opt=index">Карты</a></div>
        <div><a href="?opt=index">Камеры</a></div>
        <div><a href="?opt=index">Табло</a></div>
    </div>
    <div class="admin-panel-tablet">
        <span>Административная панель</span>
    </div>
    <div class="add-menu-tablet">
        <div><a href="?opt=admin&tmp=main">Обзор</a></div>
        <div><a href="?opt=admin&tmp=settings">Параметры</a></div>
        <div><a href="?opt=admin&tmp=users">Пользователи</a></div>
        <div><a href="#">Добавить точку</a></div>
    </div>
</div>
<!--        Картинка для user         -->
<img id="arrow-users" src="engine/templates/assets/img/users-hover.png" alt="users-hover">