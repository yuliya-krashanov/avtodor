<?php require_once ROOT.'/engine/templates/header.php'; ?>
	<div class="container-fluid users">
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
								<a href="?opt=admin">
									<div class="left-menu">
										<img src="engine/templates/assets/img/ico-menu-2.png" height="26" width="19">
										<br>Добавить точку
									</div>
								</a>
								<div class="long-top-menu"></div>
							</div>
					</div>

					<div class="cn-tent">
						<div class="search">
							<div class="head-input-full">
								<a href="#">Данные пользователя<img src="engine/templates/assets/img/pan.png" height="27" width="27"></a>
							</div>
							<div class="head-block-all-users">
									<form id="user-search">
										<label class="search-text" for="search">ПОИСК ПО ИМЕНИ</label>
										<input type="search" id="search">
										<input type="submit">
									</form>
							</div>
						</div>
						<div class="line-hr col-lg-12 col-md-12 col-sm-12"></div>
						<div class="input-full">
							<div class="align-lock">
							<div class="input-full-one">
									<table class="tbl-1">
										<tr><td>Имя</td><td id="us-name"><?=$allUsers[0]['name']?></td></tr>
										<tr><td>Телефон</td><td id="us-tel"><?=$allUsers[0]['phone']?></td></tr>
										<tr><td>E-mail</td><td id="us-login"><?php //$allUsers[0]['login']?>Мыла нету !</td></tr>
										<tr><td>Пароль</td><td id="us-pass">*******</td></tr>
										<tr><td>Доступ</td><td id="us-access">
												<?php
													if ($allUsers[0]['type'] == 'superadmin') { echo 'Администратор'; }
													if ($allUsers[0]['base'] == 'tech') { echo 'Специалист'; }
													if ($allUsers[0]['type'] == 'base') { echo 'Базовый'; }
												?>
											</td>
										</tr>
										<tr>
											<td class="border-none input-bottom" colspan="2">
												<div class="form-group">
													<label for="new-pass">НОВЫЙ ПАРОЛЬ</label>
													<input type="password" class="form-control" id="new-pass">
												</div>
											</td>
										</tr>
										<tr>
											<td class="border-none" colspan="2">
												<label for="check-new-pass">НАЗНАЧИТЬ НОВУЮ ОБЛАСТЬ</label>
												<div class="select-area" data-update-user="">Выберите область</div>
												<div class="select-area-container">
													<ul id="select-area" data>
														<?php foreach($activeRegions as $getRegion): ?>
															<li data-value-region="<?=$getRegion['region']; ?>">
																<?=$getRegion['area']; ?>
															</li>
														<?php endforeach ?>
													</ul>
												</div>
											</td>
										</tr>
									</table>
							</div>
							<div class="input-full-two">
									<table class="tbl-1">
										<tr><td>Поле</td><td>Name</td></tr>
										<tr><td>Поле</td><td>Telephone</td></tr>
										<tr><td>Поле</td><td>witchep@gmail.com</td></tr>
										<tr><td>Поле</td><td>LKJguhGOLoi</td></tr>
										<tr><td>Поле</td><td>Запорожская</td></tr>
										<tr><td class="border-none input-bottom" colspan="2">
												<div class="form-group">
													<label for="check-new-pass">ПОДТВЕРДИТЕ НОВЫЙ ПАРОЛЬ</label>
													<input type="password" class="form-control" id="check-new-pass">
												</div>
											</td>
										</tr>
										<tr>
											<td class="border-none" colspan="2">
												<label for="check-new-pass">НАЗНАЧИТЬ НОВЫЙ ДОСТУП</label>
												<div class="select-access">Выберите тип доступа</div>
												<div class="select-access-container">
													<ul id="select-access">
														<li data-value-access="superadmin"
															class="act-access">Администратор</li>
														<li data-value-access="base">Базовый</li>
														<li data-value-access="tech">Специалист</li>
													</ul>
												</div>
											</td>
										</tr>
									</table>
							</div>
							</div>
							<div class="line-hr col-lg-12 col-md-12 col-sm-12"></div>
							<div class="col-lg-12 col-md-12 col-sm-12 i-custom-button-parent">
								<a href="#" class="i-custom-button-3"
								   id="confirm-update-user">Сохранить изменения</a>
								<a href="#" class="i-custom-button-link" id="delete-user">Удалить пользователя</a>
							</div>
						</div>
						<div class="block-all-users">
							<div class="row">
								<table class="tbl-all-users">
									<?php foreach($allUsers as $users):
											if ($users['type'] != 'none'):
									?>
										<tr class="col-light">
											<td class="arrow-left" data-us-id="<?=$users['id']?>">
												<span><?php echo $users['lastname'].' '.$users['name']; ?></span>
											</td>
										</tr>
									<?php
											endif;
										endforeach;
									?>
								</table>
							</div>
						</div>
					</div>
			</div>
	</div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>