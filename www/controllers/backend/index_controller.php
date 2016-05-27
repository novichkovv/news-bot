<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 29.08.2015
 * Time: 0:10
 */
class index_controller extends controller
{
    public function index()
    {
        $this->view('index' . DS . 'index');
    }

    public function index_na()
    {
        $this->sidebar = false;
        $this->header = false;
        $this->footer = false;
        $this->addStyle('backend/theme/login_form');
        $this->view('index' . DS . 'login_form');
    }
}