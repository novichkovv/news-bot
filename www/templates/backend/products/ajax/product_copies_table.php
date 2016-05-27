<table class="table-bordered table">
    <thead>
    <tr>
        <th>Изображение</th>
        <th>Вес</th>
        <th>Цена</th>
        <th>Основной</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($product_copies as $k => $product): ?>
        <tr>
            <td>
                <img class="product_table_image" src="<?php echo SITE_DIR; ?>uploads/images/product_images/<?php echo $product['image_name']; ?>" />
            </td>
            <td>
                <?php echo $product['common_weight']; ?>
            </td>
            <td>
                <?php echo $product['price']; ?>
            </td>
            <td>
                <input type="radio" class="icheck" value="<?php echo $product['id']; ?>" name="main_copy" <?php if($product['main_copy']) echo 'checked'; ?>>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>