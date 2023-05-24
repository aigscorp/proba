<?php

class Controller_Main extends Controller
{

    public function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    public function action_index()
	{
        session_start();
        $title = "<h2>Просмотр</h2>";
        $auth = 0;
        if(isset($_SESSION["session_username"])) {
            $title = "<h2>Редактированние</h2>" . "<p><a href='logout.php'>Выйти</a> из системы</p>";
            $auth = 1;
        }
	    $arr = $this->model->get_cat();
	    $data['cat'] = $this->model->view_cat($arr);
	    $data['auth'] = $auth;
	    $data['title'] = $title;
		$this->view->render('main_view.php', 'template_view.php', $data);
	}


}