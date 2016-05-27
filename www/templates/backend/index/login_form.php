    <body class="login">
    <div class="logo">
        <a href="<?php echo MAIN_SITE_DIR; ?>">
            <img style="width: 100px; margin-bottom: -20px;" src="<?php echo SITE_DIR; ?>images/main/logo200.png" alt="Магазин"/>
        </a>
    </div>
    <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form id="login_form" action="" method="post">
        <h3 class="form-title">Авторизация</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
                <span>
                Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Логин</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Логи" name="email"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Пароль</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Пароль" name="password"/>
        </div>
        <div class="form-actions">
            <button type="submit" name="login_btn" class="btn btn-success uppercase">Войти</button>
            <label class="rememberme check">
                <input type="checkbox" class="icheck" name="remember" value="1" checked>Запомнить
            </label>
            <a href="#" id="forget-password" class="forget-password">Забыли Пароль?</a>
        </div>
        <div style="height: 100px;">

        </div>
        <div class="create-account">
            <p>
                <a href="<?php echo MAIN_SITE_DIR; ?>" id="register-btn" class="uppercase">Магазин</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form id="forget_form" action="" method="post">
        <h3>Забыли Пароль?</h3>
        <p>
            Укажите Email для восстановления пароля.
        </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
        </div>
        <div class="form-actions">
            <button type="button" id="back_btn" class="btn btn-default">Назад</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Отправить</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    </div>
    <div class="copyright">
        2015 © tvoydom-norilsk.ru | Административное Приложение
    </div>
</body>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $("#forget-password").click(function()
        {
            $('#login_form').slideUp();
            $('#forget_form').slideDown();
        });
        $("#back_btn").click(function()
        {
            $('#login_form').slideDown();
            $('#forget_form').slideUp();
        });
    });
</script>