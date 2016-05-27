<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 04.09.2015
 * Time: 15:17
 */
class finance_streams_model extends model
{
    protected function rules()
    {
        return array(
            'rules' => array(
                'stream_sum' => array(
                    'required' => true,
                    'label' => 'Сумма'
                ),
                'creator' => array(
                    'required' => true,
                    'label' => 'Вноситель'
                ),
                'create_date' => array(
                    'required' => true,
                    'label' => 'Дата'
                )
            )
        );
    }
}