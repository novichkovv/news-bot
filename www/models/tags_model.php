<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 14.06.2016
 * Time: 18:09
 */
class tags_model extends model
{
    public function getUserTags($user_id)
    {
        $stm = $this->pdo->prepare('
            SELECT
                t.*
            FROM
                user_tags ut
                    JOIN tags t ON ut.tag_id = t.id
            WHERE
                user_id = :user_id
        ');
        return $this->get_all($stm, array('user_id' => $user_id));
    }
}