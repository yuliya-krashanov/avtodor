<?php require_once ROOT.'/engine/templates/header.php';     
    // if(isset($_SESSION['lang'])){$lang = $_SESSION['lang'];};
    // $url = file_get_contents($_SERVER['DOCUMENT_ROOT']."/engine/lang/".$lang.".json");
    // $lang_arr = json_decode($url, true);     
?>
    <div id="entrance" class="entrance">
        <div class="section">
            <div class="map-wrapper">
                <div id="map-canvas" class="map-canvas">Loading map...</div>
                <div class="container">
                    <div class="row wd">
                        <div class="login-form centered vertical-center">
                            <div class="col-sm-5 login-logo">
                                <div class="left-content-wrap">
                                    <img src="engine/templates/assets/img/logo.png" alt="Logo" />
                                    <p class="text" lng="auth_about_system">Система моніторингу автодоріг України</p>
                                </div>
                            </div>
                            <div class="col-sm-7 login-user-data">
                                <form class="enter-form" id="auth-form">
                                    <ul class="tab-group">
                                        <li class="active"><a rel="#authorization" href="javascript:void(0);" lng="auth_auth">Авторизація</a></li>
                                        <li><a rel="#registration" href="javascript:void(0);" lng="auth_reg">Реєстрація</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="authorization" class="login-tabs active-tab">
                                            <span class="input input--hoshi">
                                                <input name="user_login" class="input__field input__field--hoshi" type="text" id="input-4" />
                                                <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                                    <span class="input__label-content input__label-content--hoshi" lng="auth_login">Логін</span>
                                                </label>
                                            </span>
                                            <span class="input input--hoshi">
                                                <input name="user_ps_log" class="input__field
                                                input__field--hoshi" type="password" id="input-5" />
                                                <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                                    <span class="input__label-content input__label-content--hoshi" lng="auth_pass">Пароль</span>
                                                </label>
                                            </span>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="submit" class="login-submit-btn" name="authorization_btn" value="Ввійти" lng="auth_entry"/>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="forgot-pass-wrap">
<!--                                                        <a href="#" lng="auth_pass_forget">Нагадати пароль</a>-->
                                                    </span>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </form>
                                             <!-- Регистрация -->
                                    <form class="enter-form" id="reg-form">
                                        <div id="registration" class="login-tabs">
                                            <div id="step1" class="reg-step active-step">
                                                <div class="step-indicator-wrap">
                                                    <p class="steps-indicator" lng="auth_step1">Крок 1 з 4</p>
                                                </div>
                                                <span class="input input--hoshi">
                                                    <input name="user_name" class="input__field input__field--hoshi" type="text" id="user_name_input" />
                                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="user_name_input">
                                                        <span class="input__label-content input__label-content--hoshi" lng="auth_name">Ваше ім'я</span>
                                                    </label>
                                                </span>
                                                <span class="input input--hoshi">
                                                    <input name="user_password" class="input__field input__field--hoshi" type="text" id="user_second_name_input" />
                                                    <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="user_second_name_input">
                                                        <span class="input__label-content input__label-content--hoshi"  lng="auth_lastname">Ваше прізвище</span>
                                                    </label>
                                                </span>
                                                <input type="submit" class="login-submit-btn" name="authorization_btn" value="Далі"  lng="auth_next" rel="#step2" />
                                            </div>
                                            <div id="step2" class="reg-step">
                                                <div class="step-indicator-wrap">
                                                    <p class="steps-indicator" lng="auth_step2">Крок 2 з 4</p>
                                                </div>
                                                <span class="input input--hoshi">
                                                    <input name="user_registration_pass" class="input__field
                                                    input__field--hoshi" type="text" id="user_register_login" />
                                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="user_registration_pass">
                                                        <span class="input__label-content input__label-content--hoshi" lng="auth_login_to_auth">Логін для входу</span>
                                                    </label>
                                                </span>
                                                <span class="input input--hoshi">
                                                    <input name="user_password_confirm" class="input__field input__field--hoshi" type="text" id="user_register_telephone" />
                                                    <label class="input__label input__label--hoshi
                                                    input__label--hoshi-color-2" for="user_register_telephone">
                                                        <span class="input__label-content input__label-content--hoshi" lng="auth_mobile">Мобільний телефон</span>
                                                    </label>
                                                </span>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="submit" class="login-submit-btn" name="authorization_btn" value="Далі" lng="auth_next" rel="#step3" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span class="forgot-pass-wrap">
                                                            <a href="#" rel="#step1" lng="auth_back">Назад</a>
                                                        </span>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <div id="step3" class="reg-step">
                                                <div class="step-indicator-wrap">
                                                    <p class="steps-indicator" lng="auth_step3">Шаг 3 из 4</p>
                                                </div>
                                                <span class="input input--hoshi">
                                                    <input name="user_name" class="input__field input__field--hoshi"
                                                    type="password" id="user_register_password" />
                                                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="user_name_input">
                                                        <span class="input__label-content input__label-content--hoshi" lng="auth_pass">Пароль</span>
                                                    </label>
                                                </span>
                                                <span class="input input--hoshi">
                                                    <input name="user_password" class="input__field
                                                    input__field--hoshi" type="password"
                                                    id="user_register_password_confirm" />
                                                    <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="user_second_name_input">
                                                        <span class="input__label-content input__label-content--hoshi" lng="auth_confirm_pass">Підтвердження пароля</span>
                                                    </label>
                                                </span>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="submit" class="login-submit-btn" name="authorization_btn" value="Далі" lng="auth_next" rel="#step4" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span class="forgot-pass-wrap">
                                                            <a href="#" rel="#step2" lng="auth_back">Назад</a>
                                                        </span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div id="step4" class="reg-step">
                                                <div class="step-indicator-wrap">
                                                    <p class="steps-indicator" lng="auth_step4">Шаг 4 из 4</p>
                                                </div>
                                                <div class="inputs-container">
                                                    <input type="hidden" name="user_region" value="" />
                                                    <span class="input-label" lng="auth_chooce_region">Оберіть регіон</span>
                                                    <div class="selected-value">Оберіть регіон</div>
                                                    <div class="select-container">
                                                        <ul id="region-select">
                                                            <?php foreach ($activeRegion as $reg): ?>
                                                                <li data-reg="<?=$reg['region']?>"><?=$reg['area']?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="submit" class="login-submit-btn" name="authorization_btn" value="Зареєструватися" lng="auth_reg_bt" rel="#step5" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span class="forgot-pass-wrap">
                                                            <a href="#" rel="#step3" lng="auth_back">Назад</a>
                                                        </span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div id="step5" class="reg-step">
                                                <span class="thanks-text"><img src="engine/templates/assets/img/senks_arrow.png"><span lng="auth_senks">Дякуємо!</span></span>
                                                <p class="thanks" lng="auth_senks_text">Ви успішно зареєструвалися в системі, очікуйте підтвердження адміністратора.</p>
                                                <input type="submit" class="login-submit-btn" name="authorization_btn" value="Ок" lng="auth_entry"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="entrance_footer">
        <div class="row">
            <div class="col-sm-4">
                <p class="copyright">copyright &copy; 2015</p>
            </div>
            <div class="col-sm-4">
                <ul class="localization-list">
                    <li id="lang_ukr" class="active">UA</li>
                    <li id="lang_ru">RU</li>
                    <li id="lang_en">EN</li>
                </ul>
            </div>
            <div class="col-sm-4">
                <p class="author to-right">by lazarev.studio</p>
            </div>
        </div>
    </footer>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>