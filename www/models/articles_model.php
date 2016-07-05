<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 05.07.2016
 * Time: 21:17
 */
class articles_model extends model
{
    public function getArticles(array $ids)
    {
        $stm = $this->pdo->prepare('
            SELECT
                a.*,
                f.title as feed_title,
                f.icon_url
            FROM
                articles a
                  JOIN
                feeds f ON a.stream_id = f.feed_id
                  WHERE
                a.id IN (' . implode(',', $ids) . ')
        ');
        return $this->get_all($stm);
    }
}