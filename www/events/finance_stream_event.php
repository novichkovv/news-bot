<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 04.09.2015
 * Time: 13:48
 */
class finance_stream_event extends base implements event_interface
{
    private $event_data = array();

    public function __construct(array $data)
    {
        $this->event_data = $data;
        return $this->saveStream($data);
    }

    public function saveStream($stream)
    {
        if(!in_array($stream['stream_type'], array(1,2)) || (!$stream['type_id'] && !$stream['custom_comment'])) {
            return false;
        }
        $stream['create_date'] = date('Y-m-d H:i:s');
        if(!$stream['creator']) {
            $stream['creator'] = registry::get('user')['id'];
        }
        $stream['id'] = $this->model('finance_streams')->insert($stream);
        $this->event_data = $stream;
        return $stream['id'];
    }
}