<tr class="image_form" data-id="<?php echo $image_form_id; ?>">
    <?php if (!$image_name && !$new_image_name): ?>
        <td style="width: 200px;" colspan="10">
            <input type="button" value="Загрузить" class="btn btn-default product_upload_button" id="product_upload_button_<?php echo $image_form_id; ?>" />
            <input type="hidden" name="image_id" value="<?php echo $image_form_id; ?>">
        </td>
    <?php endif; ?>
    <?php if ($image_name || $new_image_name): ?>
    <td>
        <span id="upload_status_<?php echo $image_form_id; ?>"></span>
        <?php if($image_name && !$new_image_name && file_exists(ROOT_DIR . 'uploads' . DS . 'images' . DS . 'product_images'  . DS . $image_name)): ?>
            <img style="max-width: 100px; max-height: 100px;" src="<?php echo SITE_DIR . 'uploads/images/product_images/' . $image_name . '?' . rand(); ?>" />
        <?php endif; ?>
        <?php if($new_image_name && file_exists(ROOT_DIR . 'tmp' . DS . 'uploaded' . DS . $new_image_name)): ?>
            <img style="max-width: 100px; max-height: 100px;" src="<?php echo SITE_DIR . 'tmp/uploaded/' . $new_image_name . '?' . rand(); ?>" />
        <?php endif; ?>
    </td>
    <td style="width: 100px; vertical-align: middle; text-align: center;">
        <input type="radio" class="icheck depends" name="main_image" value="<?php echo $image_form_id; ?>" <?php if($type == 'main') echo 'checked'; ?>>
    </td>
    <td style="width: 100px; vertical-align: middle; text-align: center;">
        <input type="radio" class="icheck depends" name="small_image" value="<?php echo $image_form_id; ?>" <?php if($type == 'small') echo 'checked'; ?>>
    </td>
    <td style="width: 100px; vertical-align: middle; text-align: center;">
        <input type="checkbox" class="icheck depends" name="usual_image[<?php echo $image_form_id; ?>]" value="1" <?php if($type == 'usual') echo 'checked'; ?>>
    </td>
    <td style="vertical-align: middle; text-align: center;">
        <a class="btn btn-default btn-icon delete_image" href="#delete_image_modal" data-toggle="modal">
            <i class="fa fa-remove text-danger"></i>
        </a>
        <button name="logo" type="button" class="btn btn-default product_upload_button" id="product_upload_button_<?php echo $image_form_id; ?>">
            <i class="fa fa-pencil"></i>
        </button>
        <?php if ($image_name): ?>
            <input type="hidden" name="image[<?php echo $image_form_id; ?>][old]" value="<?php echo $image_name; ?>">
        <?php endif; ?>
        <?php if ($new_image_name): ?>
            <input type="hidden" name="image[<?php echo $image_form_id; ?>][new]" value="<?php echo $new_image_name; ?>">
        <?php endif; ?>
        <input type="hidden" name="image_id" value="<?php echo $image_form_id; ?>">
    </td>
    <?php endif; ?>
</tr>