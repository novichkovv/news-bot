<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 19.09.2015
 * Time: 21:08
 */
class common_controller extends controller
{
    public function index()
    {
//        $this->addStyle('');
//        $this->addScript('');
//        $categories = $this->model('categories')->getByFields(array('active' => 1, 'parent' => 0), true, 'position');
//        $this->render('common_categories', $categories);
//        $this->render('client', registry::get('client'));
    }

    public function index_ajax()
    {
        switch ($_REQUEST['action']) {
            case "add_to_cart":

                exit;
                break;
        }
    }

    protected function render($key, $value)
    {
        $common_vars = registry::get('common_vars');
        if(!$common_vars) {
            $common_vars = [];
        }
        $common_vars[$key] = $value;
        registry::set('common_vars', $common_vars);
    }
}