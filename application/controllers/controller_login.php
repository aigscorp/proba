<?php

class Controller_Login extends Controller
{

    public function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index()
    {
        session_start();
        unset($_SESSION['session_username']);
        $data = $this->model->isLogin();
        $this->view->render('login_view.php', 'template_view.php', $data);
    }
}
