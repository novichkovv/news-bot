<?php
/**
 * Created by PhpStorm.
 * User: novichkov
 * Date: 06.03.15
 * Time: 19:34
 */
if(isset($_GET['route'])) {
    $route = trim($_GET['route'], '\\/');
    registry::set('route', $route);
    $parts = explode('?', $route);
    $arr = explode('/', $parts[0]);
    if(count($arr) === 1) {
        $controller = $arr[0];
        $action = 'index';
    } else {
        $controller = $arr[0];
        $action = $arr[1];
    }
    array_slice($arr, 2);
    unset($_GET['route']);
} else {
    $controller = 'index';
    $action = 'index';
}

$route_parts[0] = $controller;
$route_parts[1] = $action;
registry::set('route_parts', $route_parts);
$class_name = $controller . '_controller';

$common_controller = new common_controller('common_controller', 'index');
//if(PROJECT == 'frontend') {
//    $model = new default_model('frontend_routes');
//    if($route = $model->getByField('url_key', $route_parts[0])) {
//        $class_name = $route['controller'];
//        $action = $route['method'];
//    }
//}

if(!file_exists(CONTROLLER_DIR . $class_name . '.php')) {
    $class_name = 'default_controller';
}
registry::set('controller', $class_name);
$controller = new $class_name($class_name, $action);
if(!$controller->check_auth) {
    $action .= '_na';
}
if(isset($_REQUEST['ajax'])) {
    $ajax_action = $action . '_ajax';
    if(method_exists($controller, $ajax_action)) {
        if(!$_REQUEST['common']) {
            if(is_callable($controller->$ajax_action())) {
                $controller->$ajax_action();
            }
        } else {
            if(is_callable($common_controller->index_ajax())) {
                $controller->index_ajax();
            }
        }
    } elseif(method_exists($controller, 'catcher_ajax')) {
        if(!$_REQUEST['common']) {
            if(is_callable($controller->catcher_ajax())) {
                $controller->$ajax_action();
            }
        } else {
            if(is_callable($common_controller->catcher_ajax())) {
                $controller->catcher_ajax();
            }
        }
    }

}
$common_controller->index();
if(method_exists($controller ,$action)) {
    registry::set('action', $action);
    $controller->$action();
} elseif(method_exists($controller, 'catcher')) {
    $controller->catcher(str_replace('_na', '', $action));
} else {
    $controller->default_action();
    registry::set('action', 'four_o_four');
}