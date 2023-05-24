<?php
class Model_Login extends Model {

    public function isLogin(){
        $message = "";
        if(isset($_POST["login"])){

            if(!empty($_POST['username']) && !empty($_POST['password'])) {
                $db = $this->connect();
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($db, "SELECT * FROM users WHERE username='".$username . "'");
                $numrows = mysqli_num_rows($query);
                if($numrows != 0)
                {
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $dbhash = password_verify($password, $row['password']);
                        $dbusername = $row['username'];
                    }
                    if($username == $dbusername && $dbhash)
                    {
                        // старое место расположения
                        //  session_start();
                        $_SESSION['session_username'] = $username;
                        header('Location:'. 'http://'. $_SERVER['HTTP_HOST'].'/');

                    }
                } else {
                    $message = "Неправильный логин или пароль!";
                }
            } else {
                $message = "Заполните все поля!";
            }
        }
        return $message;
    }

}