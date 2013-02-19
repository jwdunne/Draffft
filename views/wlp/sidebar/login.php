<fieldset class="login-field" id="login">
    <legend><?=__('common.user-login');?></legend>
    <form action="<?=Application::link('login');?>" method="post" id="login-form">
        <div class="clr">
            <input class="txt_input" type="text" placeholder="<?=__('common.email');?>" name="email" />
        </div>
        <div class="clr">
            <input class="txt_input" type="password" placeholder="<?=__('common.password');?>" name="password" />
        </div>
        <input class="login-button login" value="<?=__('common.login');?>" type="submit" />
        <input type="checkbox" name="remember" value="1" id="login_remember" /><label for="login_remember">Remember?</label>
    </form>
</fieldset>
<fieldset class="login-field" id="register">
    <legend><?=__('common.register');?></legend>
    <form action="<?=Application::link('register');?>" method="post" id="register-form">
        <div class="clr">
            <input class="txt_input" placeholder="Nickname" type="text" name="username" />
            <input class="txt_input double" placeholder="<?=__('common.first-name');?>" type="text" name="first" />
            <input class="txt_input double" placeholder="<?=__('common.last-name');?>" type="text" name="last" />
        </div>
        <div class="clr">
            <input class="txt_input" autocomplete="off" placeholder="<?=__('common.email');?>" type="text" name="email"/>
        </div>
        <div class="clr">
            <input class="txt_input" autocomplete="off" placeholder="<?=__('common.password');?>" type="password" name="password"/>
        </div>
        <input class="login-button register" value="<?=__('common.register');?>" type="submit" />
    </form>
</fieldset>
