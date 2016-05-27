<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 27.05.2016
 * Time: 11:32
 */
class api_controller extends controller
{
    public function __construct()
    {
        if($_REQUEST['secret'] != PB_SECRET) {
            echo json_encode(array(
                'error' => true,
                'error_code' => 1,
                'error_text' => 'Permission Denied'
            ));
            exit;
        }
    }

    public function index()
    {

    }

    public function index_na()
    {

    }

    public function feed()
    {
        if(!$_GET['fb_id']) {
            echo json_encode(array(
                'error' => true,
                'error_code' => 3,
                'error_text' => 'Missing FB ID'
            ));
            exit;
        }
        $feed = $this->model('articles')->getAll('create_date DESC', 10);
        echo json_encode($feed, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function feed_na()
    {
        $this->feed();
    }

    public function default_action()
    {
        echo json_encode(array(
            'error' => true,
            'error_code' => 2,
            'error_text' => 'Method doesn\'t exist'
        ));
        exit;
    }
}