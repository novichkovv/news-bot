<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 16.09.2015
 * Time: 23:31
 */
class categories_model extends model
{
    public function getCategories()
    {
        $tmp = $this->get_all($stm = $this->pdo->prepare('
                SELECT * FROM categories WHERE active = 1 ORDER BY parent, position
            '));
        $res = [];
        foreach ($tmp as $k => $v) {
            if(!$v['parent']) {
                $res[$v['id']] = $v;
                unset($tmp[$k]);
            }
        }
        foreach ($tmp as $k => $v) {
            if(array_key_exists($v['parent'], $res)) {
                unset($tmp[$k]);
                $res[$v['parent']]['children'][$v['id']] = $v;
                $res[$v['parent']]['children'] = $this->getCategoriesChildren($tmp, $res[$v['parent']]['children'], $v['id']);
            }
        }
        return $res;
    }

    private function getCategoriesChildren($tmp, $res, $parent)
    {
        foreach ($tmp as $k => $v) {
            if($parent == $v['parent']) {
                if(!array_key_exists($parent, $res)) {
                    unset($tmp[$k]);
                    $res[$v['id']] = $v;
                } else {
                    unset($tmp[$k]);
                    $res[$v['parent']]['children'][$v['id']] = $v;
                    $res[$v['parent']]['children'] = $this->getCategoriesChildren($tmp, $res[$v['parent']]['children'], $v['id']);
                }
            }

        }
        return $res;
    }

    public function getProductCategories($product_id)
    {
        if($product_id) {
            $tmp = $this->get_all($stm = $this->pdo->prepare('
            SELECT * FROM products_categories_relations WHERE product_id = :product_id
           '), array('product_id' => $product_id));
            if($tmp) {
                foreach ($tmp as $v) {
                    $product_categories[$v['category_id']] = $v['category_id'];
                }
            }
        }
        $this->log($product_categories);
        $tmp = $this->get_all($stm = $this->pdo->prepare('
            SELECT * FROM categories WHERE active = 1 ORDER BY parent, position
        '));
        $res = [];
        foreach ($tmp as $k => $v) {
            if(!$v['parent']) {
                $res[$v['id']] = $v;
                if($product_categories && in_array($v['id'], $product_categories)) {
                    $res[$v['id']]['checked'] = true;
                }
                unset($tmp[$k]);
            }
        }
        foreach ($tmp as $k => $v) {
            if(array_key_exists($v['parent'], $res)) {
                unset($tmp[$k]);
                $res[$v['parent']]['children'][$v['id']] = $v;
                if($product_categories && in_array($v['id'], $product_categories)) {
                    $res[$v['parent']]['children'][$v['id']]['checked'] = true;
                }
                $res[$v['parent']]['children'] = $this->getProductCategoriesChildren($tmp, $res[$v['parent']]['children'], $v['id'], $product_categories);
            }
        }
        return $res;
    }


    private function getProductCategoriesChildren($tmp, $res, $parent, $product_categories)
    {
        foreach ($tmp as $k => $v) {
            if($parent == $v['parent']) {
                if(!array_key_exists($parent, $res)) {
                    unset($tmp[$k]);
                    $res[$v['id']] = $v;
                    if($product_categories && in_array($v['id'], $product_categories)) {
                        $res[$v['id']]['checked'] = true;
                    }
                } else {
                    unset($tmp[$k]);
                    $res[$v['parent']]['children'][$v['id']] = $v;
                    if($product_categories && in_array($v['id'], $product_categories)) {
                        $res[$v['parent']]['children'][$v['id']]['checked'] = true;
                    }
                    $res[$v['parent']]['children'] = $this->getProductCategoriesChildren($tmp, $res[$v['parent']]['children'], $v['id'], $product_categories);
                }
            }

        }
        return $res;
    }

    public function makeInactive($ids)
    {
        if(!is_array($ids)) {
            return false;
        }
        $ids = '(' . implode(', ', $ids) . ')';
        $position = $this->get_row($this->pdo->prepare('SELECT position FROM categories WHERE parent = 0 ORDER BY position DESC LIMIT 1'))['position'] + 1;
        $stm = $this->pdo->prepare('
            UPDATE categories SET active = 0, parent = 0, position = :position  WHERE id IN ' . $ids . '
        ');
        return $stm->execute(array('position' => $position));
    }

}