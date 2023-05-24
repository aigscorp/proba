<?php
class Model_Register extends Model{

    public function register(){

        if (isset($_POST["register"])) {

            if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $db = $this->connect();

                $full_name = htmlspecialchars($_POST['full_name']);
                $email = htmlspecialchars($_POST['email']);
                $username = htmlspecialchars($_POST['username']);

                $password = password_hash( htmlspecialchars($_POST['password']), PASSWORD_BCRYPT );

                $query = mysqli_query($db, "SELECT * FROM users WHERE username='" . $username . "'");
                $numrows = mysqli_num_rows($query);
                if ($numrows == 0) {
                    $sql = "INSERT INTO users (full_name, email, username,password)	
                            VALUES('$full_name','$email', '$username', '$password')";
                    $result = mysqli_query($db, $sql);
                    if ($result) {
                        $message = "Account Successfully Created";
//                        echo $message;
                        header('Location:'. 'http://'. $_SERVER['HTTP_HOST'].'/login');
                    } else {
                        $message = "Ошибка вставки данных";
                    }

                } else {
                        $message = "Логин такой уже есть! Введите другой!";
                }
            } else {
                $message = "Заполните все поля!";
            }
            return $message;
        }

    }


}