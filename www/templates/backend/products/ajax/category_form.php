<form id="category_form" style="background-color: #fff; padding: 10px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Новая Категория</h4>
    </div>
    <div class="modal-body with-padding">
        <div class="form-group">
            <label>Название <span class="required">*</span></label>
            <input type="text" data-require="1" class="form-control" name="category[category_name]" value="<?php echo $category['category_name']; ?>">
            <div class="error-require validate-message">
                Обязательное поле
            </div>
        </div>
        <div class="form-group">
            <label>Ключ <span class="required">*</span></label>
            <input type="text" data-require="1" id="category_key" class="form-control" name="category[category_key]" value="<?php echo $category['category_key']; ?>">
            <div class="error-require validate-message">
                Обязательное поле
            </div>
            <div class="validate-message" id="key_unique_error">
                Данный ключ уже используется
            </div>
        </div>
        <div class="form-group">
            <label>Изображение</label>
            <div class="row">
                <div class="col-md-3">
                    <input name="logo" type="button" value="Загрузить" class="btn btn-default" id="upload_btn" />
                    <input type="hidden" id="rand" value="<?php echo mktime() . registry::get('user')['id']; ?>">
                    <input type="hidden" name="category[image]" value="" id="category_image_hidden_input">
                </div>
                <div class="col-md-4">
                    <span id="upload_status"></span>
                <span id="preview">
                    <?php if($category['image'] && file_exists(ROOT_DIR . 'uploads' . DS . 'images' . DS . 'category_images'  . DS . $category['image'])): ?>
                        <img src="<?php echo SITE_DIR . 'uploads/images/category_images/' . $category['image'] . '?' . rand(); ?>" />
                    <?php endif; ?>
                </span>
                </div>
            </div>
        </div>
<!--        <div class="form-group">-->
<!--            <div class="checkbox">-->
<!--                <label>-->
<!--                    <input type="checkbox" name="category[mega_menu]" value="1" --><?php //if($category['mega_menu'] || !$category) echo 'checked'; ?><!-->-->
<!--                    Показывать в мега меню-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="category[active]" value="1" <?php if($category['active'] || !$category) echo 'checked'; ?> <?php if ($category['id']) echo 'disabled'; ?>>
                    Активный
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Описание</label>
            <textarea class="form-control" name="category[category_description]"><?php echo $category['category_description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" class="form-control" name="category[page_title]" value="<?php echo $category['page_title']; ?>">
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea class="form-control" name="category[meta_description]"><?php echo $category['meta_description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Meta Keywords</label>
            <textarea class="form-control" name="category[meta_keywords]"><?php echo $category['meta_keywords']; ?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="category[id]" value="<?php echo $category['id']; ?>">
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
</form>