<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 08.10.2015
 * Time: 23:28
 */
class clients_model extends model {
    public function getClientInfoWithCart($client_id)
    {
        $stm = $this->pdo->prepare('
        SELECT
            c.id,
            ci.client_id,
            client_name,
            client_surname,
            client_password,
            phone,
            post_code,
            city_id,
            street,
            building,
            housing,
            flat,
            ca.product_id
        FROM
            clients c
                LEFT JOIN
            client_info ci ON ci.client_id = c.id
                LEFT JOIN
            cart ca ON ca.client_id = c.id
        WHERE
            ca.state = 0
                AND
            c.id = :client_id
        ');
        $tmp = $this->get_all($stm, array('client_id' => $client_id));
        $res = [];
        foreach ($tmp as $v) {
            foreach ($v as $key => $val) {
                if(in_array($key, array('product_id'))) {
                    $res['cart'][$val] = $val;
                } else {
                    $res[$key] = $val;
                }
            }
        }
        return $res;
    }
}