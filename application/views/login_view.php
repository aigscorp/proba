<?php
//    session_start();
?>
<?php
//    if(isset($_SESSION["message"])){
//        echo "<div>" . $_SESSION['message']. "</div>";
//    }
//?>
<div class="message"><?php echo $data; ?></div>
<div class="container mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="/login" id="loginform" method="post" name="loginform">
            <p><label for="user_login">Имя Пользователя<br>
                    <input class="input" id="username" name="username" size="20"
                           type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="button" name="login" type="submit" value="Log In"></p>
            <p class="regtext">Еще не зарегистрированы?<a href="/register">Регистрация</a>!</p>
        </form>
    </div>
</div>
