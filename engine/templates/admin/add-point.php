<?php require_once ROOT.'/engine/templates/header.php'; ?>

	<header>
        <div class="col-sm-7 left-part">
            <div class="logo"></div>
            <div class="header-tabs tabs--md">
                <ul class="tabs__list list-unstyled">
                    <li class="tabs__item">
                        <p data-tab="map-tab" class="tabs__link">Карта</p>
                        <hr />
                    </li>
                    <li class="tabs__item">
                        <p data-tab="cameras-tab" class="tabs__link">Камеры</p>
                        <hr />
                    </li>
                    <li class="tabs__item">
                        <p data-tab="tablo-tab" class="tabs__link">Табло</p>
                        <hr />
                    </li>
                </ul>
            </div>
           
        </div>
        <div class="col-sm-5 right-part">     

            <div class="authorized-user-info">
                <p>Игорь Дементьев</p>
                <img src="engine/templates/assets/img/addsett.png" height="16" width="16" alt="">
            </div>
        </div>
    </header>


	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1">
						<div class="row">
							<div class="sidebar-menu">
								<a href="?opt=admin&tmp=main">
									<div class="left-menu">
										<img src="engine/templates/assets/img/overview.png" height="25" width="20">
										<br>Обзор
									</div>
								</a>
								<a href="?opt=admin&tmp=settings">
									<div class="left-menu">
										<img src="engine/templates/assets/img/options.png" height="25" width="25">
										<br>Параметры
									</div>
								</a>
								<a href="?opt=admin&tmp=users">
									<div class="left-menu">
										<img src="engine/templates/assets/img/ico-menu-1.png" height="27" width="24">
										<br>Пользователи
									</div>
								</a>
								<a href="?opt=admin&tmp=add-point">
									<div class="left-menu">
										<img src="engine/templates/assets/img/ico-menu-2.png" height="26" width="19">
										<br>Добавить точку
									</div>
								</a>
								<div class="long-top-menu"></div>
							</div>
						</div>
					</div>

					<div class="col-lg-11 col-md-11 col-sm-11 content">
						<div class="add-point-wrap">
							<div id="add-point-map"></div>
							<div class="steps">
								<ul class="progressbar">
			                        <li class="active">
			                            <h4>Местоположение <br />новой точки</h4>
			                            <span class="small-circle"></span>
			                        </li>
			                        <li>
			                            <h4>Укажите имя точки <br/> и трассу</h4>
			                            <span class="small-circle"></span>
			                        </li>
			                        <li>
			                            <h4>Выберите необходимые <br/> датчики</h4>
			                            <span class="small-circle"></span>
			                        </li>
			                    </ul>
							</div>

                            <div id="step1" class="choose-district active">
                                <div class="popup">
                                    <div class="step-title">Выберите область</div>
                                    <ul class="district-list">
                                        <?php foreach ($regions as $region) : ?>
                                            <li data-id="<?= $region['id'] ?>"><?= $region['area'] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <div id="step2" class="add-point">
                                <div class="popup">
                                    <p class="add-point-text">
                                        Нажмите курсором на карте для выбора местоположения точки.<br/>
                                        Для изменения местоположения точки, кликните на нее два раза и перетащите.
                                    </p>
                                    <button class="add-point-next">Далее</button>
                                </div>

                            </div>

                            <div id="step3" class="point-title">
                                <div class="popup">
                                    <div class="step-title">Название точки</div>
                                    <div class="input-fields">
                                        <input type="text" name="point-title" class="text"/>
                                        <input type="hidden" name="region" id="region"/>
                                        <input type="hidden" name="coordinates" id="coordinates"/>
                                    </div>
                                    <div class="next-step">
                                        <p class="text">Имя точки должно состоять из названия трассы и километра.</p>
                                        <button class="next">Далее</button>
                                    </div>
                                </div>
                            </div>

                            <div id="final" class="thanks-for-add">
                                <div class="popup">
                                    <img class="ok" src="engine/templates/assets/img/ok-add-point.png" alt=""/>
                                    <p class="mes1">Спасибо!</p>
                                    <p class="mes2">Ваша точка успешно добавлена в систему.</p>                                    
                                </div>                                
                            </div>

						</div>


						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>