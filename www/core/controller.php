<?php
/**
 * Created by PhpStorm.
 * User: novichkov
 * Date: 06.03.15
 * Time: 19:47
 */
abstract class controller extends base
{
    protected $vars = array();
    public $user;
    protected $args;
    protected $system_header;
    protected $header;
    protected $footer;
    protected $system_footer;
    protected $controller_name;
    protected $action_name;
    protected $sidebar;
    private $redirect;
    public  $check_auth;
    protected $scripts = [];
    protected $styles = [];
    protected $append_to_body_elements = [];
    protected $tools;
    private $api_instance;

    function __construct($controller, $action)
    {
        if(isset($_POST['log_out_btn'])) {
            $this->logOut();
            header('Location: ' . SITE_DIR);
            exit;
        }
        if(isset($_POST['login_btn'])) {
            if($this->auth($_POST['email'], md5($_POST['password']), $_POST['remember'])) {
                header('Location: ' . SITE_DIR);
                exit;
            } else {
                $this->render('error', true);
            }
        }
        registry::set('log', array());
//        if($_SESSION['timestamp']) {
//            echo time() - $_SESSION['timestamp'];
//            if(time() - $_SESSION['timestamp'] >= 24*3600) {
//                unset($_SESSION['timestamp']);
//                unset($_SESSION['entries']);
//            }
//        }
        $this->controller_name = $controller;
        $this->check_auth = $this->checkAuth();
        if(PROJECT != 'frontend' && !$this->check_auth and !in_array($controller, array('common_controller', 'index_controller'))) {
            header('Location: ' . SITE_DIR);
            exit;
        }
        if(PROJECT == 'frontend' && $controller == 'common_controller') {
            //$this->check_client_auth();
        }
        if($this->check_auth)
        {
//            $this->sidebar();
        }
        $this->init();
        $this->action_name = $action . ($this->check_auth ? '_na' : '');
    }

    /**
     * @param string $template
     * @return string
     * @throws Exception
     */

    public function fetch($template)
    {
        $template_file = TEMPLATE_DIR . $template . '.php';
        if(!file_exists($template_file)) {
            throw new Exception('cannot find template in ' . $template_file);
        }
        foreach($this->vars as $k => $v) {
            $$k = $v;
        }
        ob_start();
        @require($template_file);
        return ob_get_clean();
    }

    /**
     * @param string $template
     * @throws Exception
     */

    protected function view($template)
    {
        $this->render('log', registry::get('log'));
        if(registry::get('common_vars')) {
            $this->render('common_vars', registry::get('common_vars'));
        }
        $template_file = TEMPLATE_DIR . $template . '.php';
        if(!file_exists($template_file)) {
            throw new Exception('Can not find template ' . $template_file);
        }
        $this->render('scripts', $this->scripts);
        $this->render('styles', $this->styles);
        $this->render('append_to_body_elements', $this->append_to_body_elements);
        foreach($this->vars as $k => $v) {
            $$k = $v;
        }
        if($this->system_header !== false) {
            require_once(!$this->system_header ? TEMPLATE_DIR . 'common' . DS . 'system_header.php' : TEMPLATE_DIR . 'common' . DS . $this->system_header . '.php');
        }

        if($this->header !== false) {
            require_once(!$this->header ? TEMPLATE_DIR . 'common' . DS . 'header.php' : TEMPLATE_DIR . 'common' . DS .$this->header . '.php');
        }
//        if($this->sidebar !== false && PROJECT == 'backend') {
//            require_once(!$this->header ? TEMPLATE_DIR . 'common' . DS . 'sidebar.php' : TEMPLATE_DIR . 'common' . DS .$this->sidebar() . '.php');
//        }
        if($template_file !== false) {
            require_once($template_file);
        }
        if($this->sidebar !== false && PROJECT == 'frontend') {
//            require_once(!$this->header ? TEMPLATE_DIR . 'common' . DS . 'sidebar.php' : TEMPLATE_DIR . 'common' . DS .$this->sidebar() . '.php');
        }

        if($this->footer !== false) {
            require_once(!$this->footer ? TEMPLATE_DIR . 'common' . DS . 'footer.php' : TEMPLATE_DIR . 'common' . DS .$this->footer . '.php');
        }
        if($this->system_footer !== false) {
            require_once(!$this->system_footer ? TEMPLATE_DIR . 'common' . DS . 'system_footer.php' : TEMPLATE_DIR . 'common' . DS .$this->system_footer . '.php');
        }
    }

    /**
     * @param string $template
     * @throws Exception
     */

    protected function view_only($template)
    {
        $this->render('log', registry::get('log'));
        $template_file = TEMPLATE_DIR . $template . '.php';
        if(!file_exists($template_file)) {
            throw new Exception('cannot find template in ' . $template_file);
        }
        foreach($this->vars as $k => $v) {
            $$k = $v;
        }
        require_once($template_file);
    }

    abstract function index();

    /**
     * @param string $key
     * @param mixed $value
     */

    protected function render($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function default_action() {
        $this->view('common' . DS . '404');
    }

    /**
     * @return bool
     */
    protected function checkAuth()
    {
        $this->user = $this->model('users')->getById(1);
        registry::set('auth', true);
        registry::set('user', $this->user);
        if(!$this->user['feedly_id'] && $this->user['refresh_token']) {
            $profile = $this->api()->getProfile();
            $this->user['feedly_id'] = $profile['id'];
            $this->model('users')->insert($this->user);
            registry::remove('user');
            registry::set('user', $this->user);
        }
//        if($_SESSION['auth']) {
//            if($user = $this->model('backend_users')->getByFields(array(
//                'id' => $_SESSION['user']['id'],
//                'email' => $_SESSION['user']['email'],
//                'user_password' => $_SESSION['user']['user_password']
//            ))
//            ) {
//                registry::set('auth', true);
//                registry::set('user', $user);
//                return true;
//            } else {
//                return false;
//            }
//        } elseif($_COOKIE['auth']) {
//            if($user = $this->model('backend_users')->getByFields(array(
//                'id' => $_COOKIE['id'],
//                'email' => $_COOKIE['email'],
//                'user_password' => $_COOKIE['user_password']
//            ),0,'','',0)) {
//                registry::set('auth', true);
//                registry::set('user', $user);
//                return true;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool
     */

    protected function auth($email, $password, $remember = false)
    {
        if(!$password) return false;
        if($user = $this->model('backend_users')->getByFields(array(
            'email' => $email,
            'user_password' => $password
        ))) {
            if(!$remember) {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['email'] = $user['email'];
                $_SESSION['user']['user_password'] = $user['user_password'];
                $_SESSION['auth'] = 1;
            } else {
                setcookie('id', $user['id'], time() + 3600 * 24 * 90);
                setcookie('email', $user['email'], time() + 3600 * 24 * 90);
                setcookie('user_password', $user['user_password'], time() + 3600 * 24 * 90);
                setcookie('auth', 1, time() + 3600 * 24 * 90);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return void
     */

    protected function logOut()
    {
        unset($_SESSION['user']);
        unset($_SESSION['auth']);
        setcookie('id', '', time() - 3600);
        setcookie('email', '', time() - 3600);
        setcookie('user_password', '', time() - 3600);
        setcookie('auth', '', time() - 3600);
    }

    protected function check_client_auth()
    {
        if($_COOKIE['client_id'] || $_SESSION['client_id']) {
            $client_id = $_SESSION['client_id'] ? $_SESSION['client_id'] : $_COOKIE['client_id'];
            if($client = $this->model('clients')->getById($client_id)) {
                if(!$_SESSION['client_id']) {
                    $client['last_login'] = date('Y-m-d H:i:s');
                    $this->model('clients')->insert($client);
                }
                $client = $this->model('clients')->getClientInfoWithCart('client_id', $client['id']);
                registry::set('client', $client);
            } else {
                $client = [];
                $date = date('Y-m-d H:i:s');
                $client['create_date'] = $date;
                $client['last_login'] = $date;
                $client['id'] = $this->model('clients')->insert($client);
                registry::set('client', $client);
            }
        } else {
            $client = [];
            $date = date('Y-m-d H:i:s');
            $client['create_date'] = $date;
            $client['last_login'] = $date;
            $client['id'] = $this->model('clients')->insert($client);
            registry::set('client', $client);
        }
        setcookie('client_id', $client['id'], time() + 3600 *24*90);
    }

    protected function breadcrumbs()
    {
        $this->render('breadcrumbs', $this->fetch('common' . DS . 'breadcrumbs'));
    }

    private function sidebar()
    {
        $system_route = trim($_REQUEST['route'], '/');
        $tmp = $this->model('system_routes_user_groups_relations')->getByField('user_group_id', registry::get('user')['user_group_id'], true);
        $permissions = [];
        foreach($tmp as $v) {
            $permissions[$v['system_route_id']] = 1;
        }
        $sidebar = [];
        $tmp = $this->model('system_routes')->getAll('position');
        $permit_page = false;
        $permitted_urls = [];

        foreach($tmp as $v) {
            if(!$v['parent']) {
                foreach($v as $key => $val) {
                    if($permissions[$v['id']] || $v['permitted']) {
                        if(!in_array($v['route'], $permitted_urls)) {
                            $permitted_urls[] = $v['route'];
                        }
                        if($v['route'] == $system_route || $v['permitted']) {
                            $permit_page = true;
                        }
                        if(!$v['hidden']) {
                            $sidebar[$v['id']][$key] = $val;
                        }
                        if($v['route'] == $system_route) {
                            registry::set('system_route', $v);
                        }
                    }
                }
            } else {
                foreach($v as $key => $val) {
                    if($permissions[$v['id']] || $v['permitted']) {
                        if(!in_array($v['route'], $permitted_urls)) {
                            $permitted_urls[] = $v['route'];
                        }
                        if($v['route'] == $system_route || $v['permitted']) {
                            $permit_page = true;
                        }
                        if(!$v['hidden']) {
                            $sidebar[$v['parent']]['children'][$v['id']][$key] = $val;
                        }
                        if($v['route'] == $system_route) {
                            registry::set('system_route', $v);
                        }
                    }
                }
            }
        }
        if(count($permitted_urls) == 1 && $system_route != $permitted_urls[0]) {
            header('Location: ' . SITE_DIR . $permitted_urls[0] . '/');
            exit;
        }
        if(count($permitted_urls) == 1) {
            $sidebar = false;
        }
        if(!$permit_page) {
            $this->view('access_denied');
            exit;
        }
        $this->render('sidebar', $sidebar);
    }

    /**
     * @param array $params
     * @param bool $print
     * @return mixed
     */

    public function getDataTable(array $params, $print = false)
    {
        $search = get_object_vars(json_decode($_REQUEST['params']));
        foreach($search as $k=>$v)
        {
            $params['where'][$k] = array(
                'sign' => $v->sign,
                'value' => $v->value
            );
        }
        $params['limits'] = isset($_REQUEST['iDisplayStart']) ? $_REQUEST['iDisplayStart'].','.$_REQUEST['iDisplayLength'] : '';
        $params['order'] = $_REQUEST['iSortCol_0'] ? $params['select'][$_REQUEST['iSortCol_0']].($_REQUEST['sSortDir_0'] ? ' '.$_REQUEST['sSortDir_0'] : '') : '';
        $res = $this->model('default')->getFilteredData($params, $params['table']);
        if($print) {
            print_r($res);
        }
        $rows['aaData'] = $res['rows'];
        $rows['iTotalRecords'] = $this->model(explode(' ', $params['table'])[0])->countByField();
        $rows['iTotalDisplayRecords'] = $res['count'];
        return($rows);
    }

    /**
     * @param mixed $value
     */

    protected function log($value)
    {
        $log = registry::get('log');
        registry::remove('log');
        $log[] = print_r($value,1);
        registry::set('log', $log);
    }

    /**
     * @param mixed $file_name
     */

    protected function addScript($file_name) {
        if(is_array($file_name)) {
            foreach($file_name as $file) {
                $this->scripts[] = $file;
            }
        } else {
            $this->scripts[] = $file_name;
        }
    }

    /**
     * @param mixed $file_name
     */

    protected function addStyle($file_name) {
        if(is_array($file_name)) {
            foreach($file_name as $file) {
                $this->styles[] = $file;
            }
        } else {
            $this->styles[] = $file_name;
        }
    }

    /**
     * @param $html
     */

    protected function appendToBody($html) {
        $this->append_to_body_elements[] = $html;
    }

    /**
     * @param string $title
     * @param string $text
     * @param string $item
     * @throws Exception
     */

    protected function deleteModal($title = '', $text = '', $item = '')
    {
        $this->render('delete_modal_title', $title);
        $this->render('delete_modal_title', $text);
        $this->render('delete_modal_title', $item);
        $this->appendToBody($this->fetch('common' . DS . 'delete_modal'));
    }

    protected function init()
    {

    }

}
