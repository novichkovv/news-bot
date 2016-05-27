<li class="dd-item" data-id="<?php echo $category['id']; ?>">
    <div class="dd-handle"><?php echo $category['category_name']; ?></div>
    <a style="padding: 6px 0;" class="btn btn-xs nestable-edit inactivate_category">
        <i class="fa text-danger fa-remove"></i>
    </a>
    <a style="padding: 6px 0;" class="btn btn-icon nestable-delete edit_category" href="#add_category_modal" data-toggle="modal">
        <i class="fa fa-pencil"></i>
    </a>
    <?php if ($child = $category['children']): ?>
        <?php require(TEMPLATE_DIR . DS . 'products' . DS . 'nested_category.php'); ?>
    <?php endif; ?>
</li>