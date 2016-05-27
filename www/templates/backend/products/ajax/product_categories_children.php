<li>
    <label class="checkbox-inline">
        <input class="icheck" type="checkbox" name="category[<?php echo $category['id']; ?>]" value="1" <?php if($category['checked']) echo 'checked'; ?>>
        <?php echo $category['category_name']; ?>
    </label>
    <?php if ($category['children']): ?>
        <ul>
            <?php foreach ($category['children'] as $category): ?>
                <?php require(TEMPLATE_DIR . 'products' . DS . 'ajax' . DS . 'product_categories_children.php'); ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</li>