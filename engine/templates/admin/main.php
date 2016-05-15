<?php require_once ROOT.'/engine/templates/header.php'; ?>
<!--            pop-up                  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить пользователя</h4>
            </div>
            <div class="modal-body">
                <div class="pop-up-content">
                    <table>
                        <tr>
                            <td class="name1-pop-up">Имя</td>
                            <td class="name2-pop-up" id="popup-name">Кирилл Лазарев</td>
                        </tr>
                        <tr>
                            <td class="name1-pop-up">Телефон</td>
                            <td class="name2-pop-up" id="popup-tel">3806377434</td>
                        </tr>
                        <tr>
                            <td class="name1-pop-up">Логин</td>
                            <td class="name2-pop-up" id="popup-login">laz@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="name1-pop-up">Пароль</td>
                            <td class="name2-pop-up" id="popup-pass">laz@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="name1-pop-up">Область</td>
                            <td class="name2-pop-up" id="popup-area">Днипропетровская</td>
                        </tr>
                        <tr>
                            <td class="name1-pop-up">Доступ</td>
                            <td  class="name2-pop-up">
                                <select id="popup-access">
                                    <option value="base">Базовый</option>
                                    <option value="tech">Технарь</option>
                                    <option value="superadmin">Администратор</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 col-md-12 col-xs-12 pop-up-button-top">
                    <div class="pop-up-button">Подтвердить</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ----------  PopUp - 2  ---------- -->
<div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog-2">
        <div class="modal-content">
            <div class="modal-header-2">
                <button type="button" class="close-2" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Внесение изминений в табло</h4>
            </div>
            <div class="modal-body-2">
                <div class="pop-up-content">
                    <div class="col-lg-5 col-md-5 col-xs-5 brd-r">
                        <div class="i-info-block">Данные пользователя</div>
                        <div class="i-info-block-2">имя</div>
                        <div class="i-info-block-2-name">Кирилл Лазарев</div>
                        <div class="i-info-block-2">телефон</div>
                        <div class="i-info-block-2-name">3806377434</div>
                        <div class="i-info-block-2">e-mail</div>
                        <div class="i-info-block-2-name">laz@gmail.com</div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-xs-7">
                        <div class="i-info-block-r">Изменения в табло</div>
                        <div class="bg-znack">
                            <div class="col-lg-4">
                                <div class="znack-1">60</div>
                            </div>
                            <div class="col-lg-4">Придерживайся дистанции</div>
                            <div class="col-lg-4">
                                <div class="bg-znack-2">
                                    <div class="znack-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-xs-6">Табло: M08 567+215 км</div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="col-lg-7 col-md-7 col-xs-7 pop-up-button-2">
                                Подтвердить
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-5 pop-up-button-3">
                                Отклонить
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--            content                 -->
    <div class="container-fluid main">
        <div class="row">
            <header>
                <div class="col-sm-7 left-part">
                    <div class="logo">
                        <div class="tablet-mini-menu">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="header-tabs tabs--md">
                        <ul class="tabs__list list-unstyled">
                            <li class="tabs__item">
                                <a href="?opt=index" data-tab="map-tab" class="tabs__link">Карта</a>
                                <hr />
                            </li>
                            <li class="tabs__item">
                                <a data-tab="cameras-tab" class="tabs__link">Камеры</a>
                                <hr />
                            </li>
                            <li class="tabs__item">
                                <a data-tab="tablo-tab" class="tabs__link">Табло</a>
                                <hr />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right-part">
                    <div class="authorized-user-info">
                        <div class="main-menu">
                            <span><?php echo $_SESSION['name']. '  ' .$_SESSION['lastname']; ?></span>
                            <img id="tickets_show_menu" src="/engine/templates/assets/img/open_menu.png">
                            <div class="tickets_menu">
                                <img src="/engine/templates/assets/img/tickets_triangle.png">
                                <p>Области:</p>
                                <ul>
                                    <?php foreach ($activeRegions as $rgs): ?>
                                        <li><a href="#"><?=$rgs['area']?></a></li>
                                    <?php endforeach; ?>
                                    <li><a href="?opt=passport&tmp=history" target="_blank">Мои тикеты</a></li>
                                    <li><a href="?opt=auth&out=exit">Выйти</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="sd-bar">
                <div class="sidebar-menu">
                    <a href="?opt=admin&tmp=main">
                        <div class="left-menu">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"  viewBox="0 0 752.807 752.807" style="enable-background:new 0 0 752.807 752.807;" xml:space="preserve"><g><g id="Home"><g><path d="M668.609,280.014L397.211,8.615c-11.486-11.487-30.105-11.487-41.616,0L84.197,280.014c-8.827,8.851-13.793,20.808-13.793,33.307v392.409c0,26.011,21.09,47.077,47.077,47.077H282.25c25.986,0,47.077-21.09,47.077-47.077V540.961h94.154v164.769c0,26.011,21.066,47.077,47.077,47.077h164.769c25.986,0,47.077-21.09,47.077-47.077V313.321C682.403,300.822,677.437,288.864,668.609,280.014z M611.788,682.191H494.096v-164.77c0-25.986-21.091-47.076-47.077-47.076h-141.23c-26.01,0-47.077,21.09-47.077,47.076v164.77H141.019V323.065L376.403,87.681l235.385,235.384V682.191z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            <p>Обзор</p>
                        </div>
                    </a>
                    <a href="?opt=admin&tmp=settings">
                        <div class="left-menu">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve"><g><g id="EQ"><g><path d="M129.818,124.495V74.181c0-15.374-12.444-27.818-27.818-27.818S74.182,58.807,74.182,74.181v50.314C31.435,136.643,0,175.959,0,222.545c0,46.586,31.435,85.902,74.182,98.051v217.223c0,15.355,12.444,27.818,27.818,27.818s27.818-12.463,27.818-27.818V320.596C172.565,308.447,204,269.15,204,222.545C204,175.959,172.565,136.643,129.818,124.495z M102,268.909c-25.556,0-46.364-20.808-46.364-46.364S76.444,176.181,102,176.181s46.364,20.808,46.364,46.364S127.556,268.909,102,268.909z M333.818,291.404V74.181c0-15.374-12.444-27.818-27.818-27.818s-27.818,12.444-27.818,27.818v217.223C235.435,303.551,204,342.867,204,389.453c0,46.588,31.435,85.904,74.182,98.051v50.314c0,15.355,12.444,27.818,27.818,27.818s27.818-12.463,27.818-27.818v-50.314C376.565,475.357,408,436.041,408,389.453C408,342.867,376.565,303.551,333.818,291.404z M306,435.818c-25.556,0-46.364-20.791-46.364-46.365c0-25.572,20.808-46.363,46.364-46.363s46.363,20.791,46.363,46.363C352.363,415.027,331.556,435.818,306,435.818z M537.818,124.495V74.181c0-15.374-12.444-27.818-27.818-27.818s-27.818,12.444-27.818,27.818v50.314C439.435,136.643,408,175.94,408,222.545c0,46.586,31.435,85.902,74.182,98.051v217.223c0,15.355,12.444,27.818,27.818,27.818s27.818-12.463,27.818-27.818V320.596C580.565,308.447,612,269.15,612,222.545C612,175.959,580.565,136.643,537.818,124.495z M510,268.909c-25.556,0-46.363-20.808-46.363-46.364s20.808-46.364,46.363-46.364s46.363,20.808,46.363,46.364S535.556,268.909,510,268.909z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            <p>Параметры</p>
                        </div>
                    </a>
                    <a href="?opt=admin&tmp=users">
                        <div class="left-menu">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 652.801 652.801" style="enable-background:new 0 0 652.801 652.801;" xml:space="preserve"><g><g id="Profile"><g><path d="M473.056,359.02C496.128,321.483,510,274.972,510,224.4C510,100.47,427.809,0,326.4,0S142.8,100.47,142.8,224.4c0,50.572,13.872,97.083,36.965,134.62C84.864,404.043,20.4,491.232,20.4,591.6V612c0,22.541,18.278,40.801,40.8,40.801h530.4c22.542,0,40.8-18.26,40.8-40.801v-20.4C632.4,491.211,567.937,404.043,473.056,359.02z M326.4,61.2c66.341,0,122.4,74.746,122.4,163.2s-56.06,163.2-122.4,163.2S204,312.854,204,224.4S260.06,61.2,326.4,61.2z M81.601,591.6c0-80.967,56.916-150.939,139.128-183.865c29.906,25.785,66.3,41.066,105.672,41.066s75.766-15.281,105.672-41.066C514.284,440.66,571.2,510.633,571.2,591.6H81.601z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            <p>Пользователи</p>
                        </div>
                    </a>
                    <a href="?opt=admin">
                        <div class="left-menu">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 792 792" style="enable-background:new 0 0 792 792;" xml:space="preserve"><g><g id="Pin_1_"><g><path d="M396,173.25c-68.359,0-123.75,55.391-123.75,123.75S327.641,420.75,396,420.75S519.75,365.359,519.75,297S464.359,173.25,396,173.25z M396,346.5c-27.299,0-49.5-22.226-49.5-49.5s22.201-49.5,49.5-49.5c27.299,0,49.5,22.201,49.5,49.5S423.299,346.5,396,346.5z M396,0C231.982,0,99,133.006,99,297c0,59.351,17.424,114.617,47.396,161.023L344,763.686C355.014,780.714,374.195,792,396,792s40.986-11.286,52-28.339l197.604-305.662C675.576,411.617,693,356.351,693,297C693,133.006,560.043,0,396,0z M583.233,417.706L396,707.355L208.766,417.73c-23.24-35.962-35.516-77.715-35.516-120.73c0-122.834,99.94-222.75,222.75-222.75S618.75,174.166,618.75,297C618.75,340.016,606.474,381.769,583.233,417.706z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            <p>Добавить точку</p>
                        </div>
                    </a>
                    <div class="long-top-menu"></div>
                </div>
            </div>
            <div class="cn-tent">
                <div id="main-height" class="block-area">
                    <!-- ===================  top block  ================== -->
                    <div class="content-block">
                        <?php foreach($activeRegions as $region): ?>
                            <div class="row">
                                <div class="content-block-title">
                                    <?=$region['area']?>
                                </div>
                                <div class="col-md-4 col-sm-4 block-one">
                                    <div class="content-block-number">
                                        <?php
                                            $alarm = array();
                                            foreach ($all_tickets as $key) {
                                                if ($region['region'] == $key['region']) {
                                                    array_push($alarm, $key['region']);
                                                }
                                            }
                                            echo count($alarm);
                                        ?>
                                    </div>
                                    <div class="content-block-text line">
                                        неполадок по станциям
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 block-two">
                                    <div class="content-block-number-2">
                                        0
                                    </div>
                                    <div class="content-block-text line-r">
                                        заявок на редактирование
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 block-three">
                                    <div class="content-block-number-3">
                                        <?php
                                            $people = array();
                                            foreach ($users as $unRegPeople) {
                                                if ($region['region'] == $unRegPeople['region']) {
                                                    array_push($people, $unRegPeople['region']);
                                                }
                                            }
                                            echo count($people);
                                        ?>
                                    </div>
                                    <div class="content-block-text">
                                        заявок на добавление
                                    </div>
                                </div>
                                <div class="col-sm-12 line-0"></div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                        <!-- ====================  right top block  ====================== -->
                <div class="application">
                    <div class="content-block-bottom" id="child-height">
                        <div class="title-block">Заявки</div>
                        <div class="border-top-block"></div>
                        <div class="custom-scroll">
    <!--                               Изменение табло                                 -->
                            <?php foreach ($users as $disUsers): ?>
    <!--                                   Регистрация пользователей                           -->
                                <div class="i-register-user" id="nu<?=$disUsers[id]?>">
                                    <div class="col-md-1 col-sm-1" data-usid="<?=$disUsers[id]?>">
                                        <div class="icon-block-2"></div>
                                    </div>
                                    <div class="col-md-7 col-sm-7 add-block">
                                        <div class="text-top-block line-2">
                                            Добавление пользователя
                                        </div>
                                        <div class="text-bottom-block bottom-line">
                                            <?=$disUsers[area]?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 add-block-click">
                                        <div class="custom-button-right" data-toggle="modal" data-id="<?=$disUsers[id]?>" data-target="#myModal">
                                            Открыть
                                        </div>
                                    </div>
                                    <div class="line-3"></div>
                                    <div class="padd-2"></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="content-block-2-right">
                    <div class="top-color border-bottom-block">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-2 col-sm-2">
                                <div class="title-content-block-2 pad1">
                                    Тикет
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="title-content-block-2 pad2">
                                    Статус
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="title-content-block-2 pad3">
                                    Дата
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="title-content-block-2 pad4">
                                    Ответственный
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="title-content-block-2 pad5">
                                    Примечание
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-scroll-2">
                        <table class="tbl">
                            <?php foreach($all_tickets as $value): if ($value['finish'] == 0) continue;?>
                                <tr class="bg-tbl">
                                    <td class="b-r-2 i-checkbox">
                                        <div class="checkbox-wrap custom-checkbox-style">
                                            <input id="<?=$value['id']?>" data-check="<?=$value['id']?>" type="checkbox">
                                            <label for="check1">
                                            </label>
                                        </div>
                                        <div class="checkbox-text"><?=$value['id']?></div>
                                    </td>
                                    <td></td>
                                    <td class="b-r <?php if ($value['finish'] == 1) { echo 'check-text'; } else { echo 'open-text'; } ?>  b-r-stat">
                                        <?php if ($value['finish'] == 1) { echo 'На проверке'; } else { echo 'Открыт'; } ?>
                                    </td>
                                    <td></td>
                                    <td class="b-r"><?=$value['date']?></td>
                                    <td></td>
                                    <td class="b-r"><?=$value['liable']?></td>
                                    <td></td>
                                    <td class="b-r"><?=$value['note']?></td>
                                    <td class="b-r-2 hidd-text"><a href="?opt=passport&tmp=history" target="_blank">Смотреть</a></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class="top-close">
                        <div class="bottom-fixed-block">
                            <div class="button-right-fixed-block">Завершить</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>
