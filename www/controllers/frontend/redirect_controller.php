<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 18.05.2016
 * Time: 2:40
 */
class redirect_controller extends controller
{
    public function index()
    {

    }

    public function index_na()
    {
        $api = new feedly_api_class($_GET['state']);
//        $api->getAccessToken();
    }
}