<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 27.09.2015
 * Time: 16:45
 */
class products_model extends model
{
    public function getProduct($product_id)
    {
        $stm = $this->pdo->prepare('
        SELECT
            p.*,
            rp.related_product_id,
            pi.id image_id,
            pi.image_name,
            pi.main,
            pi.small,
            pi.usual
        FROM
            products p
              LEFT JOIN
            product_images pi ON pi.product_id = p.id
              LEFT JOIN
            related_products rp ON rp.product_id = p.id
        WHERE
            p.id = :product_id
        ORDER BY pi.main DESC, pi.small DESC, pi.usual DESC
        ');
        $tmp = $this->get_all($stm, array('product_id' => $product_id));
        $res = [];
        foreach ($tmp as $v) {
            foreach ($v as $key => $val) {
                if(in_array($key, array('main', 'small'))) {
                    if($v[$key]) {
                        $res['images'][$key] = $v['image_name'];
                    }
                } elseif($key == 'usual' && $v[$key]) {
                    $res['images'][$key][$v['image_id']] = $v['image_name'];
                } elseif($key == 'image_name' && !$v['usual'] && !$v['small'] && !$v['main'] && $val) {
                    $res['images']['inactive'][$v['image_id']] = $v['image_name'];
                } elseif($key == 'related_product_id') {
                    $res['related'][$v['related_product_id']] = $val;
                } else {
                    $res[$key] = $val;
                }
            }
        }
        return $res;
    }

    public function getCategoryProducts($category_id = null, $order = null, $limit = null) {
        $stm = $this->pdo->prepare('
        SELECT
            p.id,
            p.product_name,
            p.product_key,
            p.short_description,
            p.price,
            p.special_price,
            i.image_name
        FROM
            products p
               JOIN
            products_categories_relations c ON c.product_id = p.id
               LEFT JOIN
            product_images i ON i.product_id = p.id AND i.main = "1"
        WHERE
        ' . (isset($category_id) ? '
            c.category_id = :category_id
              AND ' : '' ) .
            'p.active = 1
        GROUP BY
            p.id
        ' . ($order ? ' ORDER BY ' . $order : '') . '
        ' . ($limit ? ' LIMIT ' . $limit : '') . '

        ');
        return isset($category_id) ? $this->get_all($stm, array('category_id' => $category_id)) : $this->get_all($stm);
    }

    public function countCategoryProducts($category_id = null)
    {
        $stm = $this->pdo->prepare('
            SELECT
                count(p.id) qt
            FROM
                products p
            JOIN
                products_categories_relations c ON c.product_id = p.id
            WHERE
        ' . (isset($category_id) ? '
            c.category_id = :category_id
              AND ' : '') .
            'p.active = 1
        ');
        if (isset($category_id)) {
            return $this->get_row($stm, array('category_id' => $category_id))['qt'];
        } else {
            return $this->get_row($stm)['qt'];
        }
    }
    public function getCategoryBestsellers($category_id = null, $limit = null)
    {
        $stm = $this->pdo->prepare('
        SELECT
            p.id,
            p.product_name,
            p.product_key,
            p.short_description,
            p.price,
            p.special_price,
            i.image_name
        FROM
            products p
               JOIN
            products_categories_relations c ON c.product_id = p.id
               LEFT JOIN
            product_images i ON i.product_id = p.id AND i.main = "1"
        WHERE
        ' . (isset($category_id) ? '
            c.category_id = :category_id
              AND ' : '' ) .
            'p.active = 1
                AND
            p.bestseller = 1
        GROUP BY
            p.id
        ' . (isset($limit) ? ' LIMIT ' . $limit : '') . '
        ');
        return isset($category_id) ? $this->get_all($stm, array('category_id' => $category_id)) : $this->get_all($stm);
    }

    public function getRelatedProducts($product_id, $limit = 3)
    {
        $stm = $this->pdo->prepare('
        SELECT
            p.id,
            p.product_name,
            p.product_key,
            p.short_description,
            p.price,
            p.special_price,
            i.image_name
        FROM
            products p
               JOIN
            related_products rp ON rp.related_product_id = p.id
               LEFT JOIN
            product_images i ON i.product_id = p.id AND i.main = "1"
        WHERE
            rp.product_id = :product_id
              AND
            p.active = 1
        GROUP BY
            p.id
        ' . (isset($limit) ? ' LIMIT ' . $limit : '') . '
        ');
        return $this->get_all($stm, array('product_id' => $product_id));
    }

    public function getProductCopies($copy_id)
    {
        $stm = $this->pdo->prepare('
            SELECT
                p.*,
                i.image_name
            FROM
                products_copies c
                    JOIN
                products p ON p.copy_id = c.id
                    LEFT JOIN
                product_images i ON i.product_id = p.id AND i.main = "1"
            WHERE
                c.id = :copy_id
        ');
        $this->writeLog('test', $stm->getQuery(array('copy_id' => $copy_id)));
        return $this->get_all($stm, array('copy_id' => $copy_id));
    }
}