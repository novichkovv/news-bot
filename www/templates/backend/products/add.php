<div class="row">
    <div class="col-md-12">
    <form id="product_form">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject theme-font bold uppercase">Добавление Товара</span>
                </div>
                <div class="actions">
                    <input type="button" value="Сохранить" id="save_btn" class="btn btn-primary">
                    <?php if ($_GET['id']): ?>
                        <input type="button" id="save_and_continue_btn" value="Сохранить и продолжить" class="btn btn-info">
                    <?php endif; ?>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
                    </a>
                </div>
            </div>
            <div class="portlet-content">
                <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab">Основные данные</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Цены</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Изображения</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Мета Данные</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Категории</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Related Products</a></li>
                    </ul>
                    <?php if ($product['images']['main']): ?>
                        <img id="product_thumbnail" src="<?php echo SITE_DIR . 'uploads/images/product_images/' . $product['images']['main']; ?>" />
                    <?php endif; ?>
                </div>
                <div class="col-md-9 blue-frame">
                    <input type="hidden" name="product[id]" value="<?php echo $product['id']; ?>">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Основные данные
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-horizontal form-bordered">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Название <span class="required">*</span> </label>
                                                    <div class="col-md-8">
                                                        <input type="text" data-require="1" name="product[product_name]" value="<?php echo $product['product_name']; ?>" class="form-control">
                                                        <div class="error-require validate-message">
                                                            Обязательное поле
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Url-Ключ <span class="required">*</span> </label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="product[product_key]" data-require="1" value="<?php echo $product['product_key']; ?>" class="form-control">
                                                        <div class="error-require validate-message">
                                                            Обязательное поле
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php /*
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Артикул <span class="required">*</span> </label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="product[product_article]" value="<?php echo $product['product_article']; ?>" class="form-control">
                                                        <div class="error-require validate-message">
                                                            Обязательное поле
                                                        </div>
                                                    </div>
                                                </div>
                                                */ ?>
                                                <div class="form-group">
                                                    <div class="col-md-offset-4">
                                                        <label class="col-md-6">
                                                            <input type="checkbox" class="icheck" name="product[active]" <?php if($product['active'] || !$product) echo 'checked'; ?> value="1">
                                                            Активный
                                                        </label>
                                                        <label class="col-md-6">
                                                            <input type="checkbox" class="icheck" name="product[bestseller]" <?php if($product['bestseller'] || !$product) echo 'checked'; ?> value="1">
                                                            Хит продаж
                                                        </label>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="form-group">
                                                    <label>Краткое описание </label>
                                                    <div class="summernote" id="summernote_1" data-require="1" data-name="product[short_description]">
                                                        <?php echo $product['short_description']; ?>
                                                    </div>
                                                    <div class="error-require validate-message">
                                                        Обязательное поле
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Описание </label>
                                                    <div class="summernote" id="summernote_2" data-require="1" data-name="product[description]">
                                                        <?php echo $product['description']; ?>
                                                    </div>
                                                    <div class="error-require validate-message">
                                                        Обязательное поле
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default tab-next" data-tab="1">Далее <i class="fa fa-angle-right"></i> </button>
                            </div>
                        <div class="tab-pane" id="tab_2">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Цены
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-horizontal form-bordered">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Обычная цена <span class="required">*</span> </label>
                                            <div class="col-md-8">
                                                <input type="text" name="product[price]" data-require="1" value="<?php echo $product['price']; ?>" class="form-control">
                                                <div class="error-require validate-message">
                                                    Обязательное поле
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Специальная цена</label>
                                            <div class="col-md-8">
                                                <input type="text" name="product[special_price]" id="portions_quantity" value="<?php echo $product['special_price']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button type="button" class="btn btn-default tab-next" data-tab="2">Далее <i class="fa fa-angle-right"></i> </button>
                        </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="tab-pane" id="tab_1">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Изображения
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12 table-scrollable">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 120px;">Изображение</th>
                                                            <th style="width: 100px;">Основное</th>
                                                            <th style="width: 100px;">Миниатюра</th>
                                                            <th style="width: 100px;">Дополнительное</th>
                                                            <th>Действия</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Нет изображения
                                                                <input type="hidden" id="rand" value="<?php echo mktime() . registry::get('user')['id'] . rand(); ?>">
                                                            </td>
                                                            <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                                <input type="radio" class="icheck null" name="main_image" value="0" checked>
                                                            </td>
                                                            <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                                <input type="radio" class="icheck null" name="small_image" value="0" checked>
                                                            </td>
                                                            <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                            </td>
                                                            <td rowspan="2" style="vertical-align: middle; text-align: center;">

                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="image_form_container">
                                                        <?php echo $image_template; ?>
                                                        <?php require(TEMPLATE_DIR . 'products' . DS . 'ajax' . DS . 'image_form.php'); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default tab-next" data-tab="3">Далее <i class="fa fa-angle-right"></i> </button>
                    </div>
                    <div class="tab-pane" id="tab_4">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Мета Данные
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-horizontal form-bordered">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Meta Title </label>
                                            <div class="col-md-8">
                                                <input type="text" name="product[meta_title]" value="<?php echo $product['meta_title']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Meta Keywords </label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="product[meta_keywords]"><?php echo $product['meta_keywords']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Meta Description </label>
                                            <div class="col-md-8">
                                                <textarea rows="10" class="form-control" name="product[meta_description]"><?php echo $product['meta_description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default tab-next" data-tab="4">Далее <i class="fa fa-angle-right"></i> </button>
                    </div>
                    <div class="tab-pane" id="tab_5">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> Категории
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-horizontal form-bordered">
                                    <div class="form-body">
                                        <ul id="product_category_form">
                                            <?php foreach ($categories as $category): ?>
                                                <li>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="icheck" name="category[<?php echo $category['id']; ?>]" value="1" <?php if($category['checked']) echo 'checked'; ?>>
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
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default tab-next" data-tab="5">Далее <i class="fa fa-angle-right"></i> </button>                    </div>
                    <div class="tab-pane" id="tab_6">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> Related products
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-horizontal form-bordered">
                                    <div class="form-body">
                                        <?php foreach ($products as $item): ?>
                                            <?php if($product['id'] == $item['id']) continue; ?>
                                            <label class="checkbox">
                                                <input type="checkbox" class="icheck" name="related[<?php echo $item['id']; ?>]" value="1" <?php if(is_array($product['related']) && in_array($item['id'], $product['related'])) echo 'checked'; ?>>
                                                <?php echo $item['product_name']; ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="save_sec_btn" class="btn btn-danger tab-next">Сохранить <i class="fa fa-angle-right"></i> </button>
                    </div>

                        </div>
                        </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="add_copy_modal">
    <div class="modal-dialog" style="width: 800px;">
        <div class="blue-frame">
            <form id="copy_form">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <span class="caption-subject theme-font bold uppercase">Заполните данные</span>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <a class="btn btn-circle btn-icon-only btn-default close-btn" data-dismiss="modal" aria-hidden="true">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-horizontal form-bordered">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-4">
                                        Название <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text"  name="copy[product_name]" value="<?php echo $product['product_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">
                                        Url-Ключ <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text"  name="copy[product_key]" value="<?php echo $product['product_key']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Общий вес (г)</label>
                                    <div class="col-md-8">
                                        <input type="text" name="copy[common_weight]" id="copy_common_weight" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Вес порции (г)</label>
                                    <div class="col-md-8">
                                        <input type="text" name="copy[portion_weight]" id="copy_portion_weight" value="<?php echo $product['portion_weight']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Порций в упаковке</label>
                                    <div class="col-md-8">
                                        <input type="text" name="copy[portions_quantity]" id="copy_portions_quantity" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Обычная цена <span class="required">*</span> </label>
                                    <div class="col-md-8">
                                        <input type="text" name="copy[price]" data-require="1" value="" class="form-control">
                                        <div class="error-require validate-message">
                                            Обязательное поле
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 120px;">Изображение</th>
                                                    <th style="width: 100px;">Основное</th>
                                                    <th style="width: 100px;">Миниатюра</th>
                                                    <th style="width: 100px;">Дополнительное</th>
                                                    <th>Действия</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Нет изображения
                                                        <input type="hidden" id="copy_rand" value="<?php echo mktime() . registry::get('user')['id'] . rand(); ?>">
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                        <input type="radio" class="icheck null" name="copy_main_image" value="0" checked>
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                        <input type="radio" class="icheck null" name="copy_small_image" value="0" checked>
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle; text-align: center;">

                                                    </td>
                                                </tr>
                                                </thead>
                                                <tbody id="copy_image_form_container">
                                                <?php require(TEMPLATE_DIR . 'products' . DS . 'ajax' . DS . 'copy_image_form.php'); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_image_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удалить Изображение</h4>
            </div>
            <div class="modal-body with-padding">
                Удалить Изображение?
            </div>
            <div class="modal-footer">
                <button type="button" id="delete_image_btn" class="btn btn-primary">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $(".tab-next").click(function()
        {
            var offset = $("#product_form").offset().top;
            var tab_id = $(this).closest('.tab-pane').attr('id');
            if(validate(tab_id)) {
                var next_tab_id = parseInt($(this).attr('data-tab')) + 1;
                $('body').animate( { scrollTop: offset }, 200 );
                var timeout = 100;
                timeout = $(window).scrollTop() > offset ? 200 : 0;
                setTimeout(function() {
                    $("a[href='#tab_" + next_tab_id + "']").tab('show');
                }, timeout);
            } else {
                var error_offset = $(".validate-message:visible").first().offset().top - 100;
                $('body').animate( { scrollTop: error_offset }, 200 );
            }

        });



        $('#summernote_1').summernote({
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', []],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['codeview', ['codeview']]
            ],
            height: 100,
            minHeight: null,
            maxHeight: null
        });
        $('#summernote_2').summernote({
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', []],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['codeview', ['codeview']]
            ],
            height: 400,
            minHeight: null,
            maxHeight: null
        });
        $(".btn-plus").click(function()
        {
            var input = $(this).parent().find('.countable');
            var val = parseInt($(input).val());
            if(isNaN(val)) {
                val = 0;
            }
            $(input).val(val + 1);
        });

        $(".btn-minus").click(function()
        {
            var input = $(this).parent().find('.countable');
            var val = parseInt($(input).val());
            if(isNaN(val)) {
                val = 1;
            }
            if(val > 0) {
                $(input).val(val - 1);
            }
        });

        $("#common_weight").keyup(function()
        {
            var common_weight = parseFloat($(this).val());
            var portion_weight;
            if(portion_weight = parseFloat($("#portion_weight").val())) {
                if(!isNaN(common_weight) && !isNaN(portion_weight)) {
                    $("#portions_quantity").val(Math.ceil(common_weight / portion_weight));
                }
            }
        });

        $("#portion_weight").keyup(function()
        {
            var portion_weight = parseFloat($(this).val());
            var common_weight;
            if(common_weight = parseFloat($("#common_weight").val())) {
                if(!isNaN(portion_weight) && !isNaN(common_weight)) {
                    $("#portions_quantity").val(Math.ceil(common_weight / portion_weight));
                }
            }
        });

        $("#copy_common_weight").keyup(function()
        {
            var common_weight = parseFloat($(this).val());
            var portion_weight;
            if(portion_weight = parseFloat($("#copy_portion_weight").val())) {
                if(!isNaN(common_weight) && !isNaN(portion_weight)) {
                    $("#copy_portions_quantity").val(Math.ceil(common_weight / portion_weight));
                }
            }
        });

        $("#copy_portion_weight").keyup(function()
        {
            var portion_weight = parseFloat($(this).val());
            var common_weight;
            if(common_weight = parseFloat($("#copy_common_weight").val())) {
                if(!isNaN(portion_weight) && !isNaN(common_weight)) {
                    $("#copy_portions_quantity").val(Math.ceil(common_weight / portion_weight));
                }
            }
        });

        $(".product_upload_button").each(function()
        {
            var id = parseInt($(this).attr('id').substr(22));
            product_image_upload(id);
        });

        $(".copy_product_upload_button").each(function()
        {
            var id = parseInt($(this).attr('id').substr(27));
            copy_product_image_upload(id);
        });

        $("#save_btn, #save_sec_btn").click(function()
        {
            if(validate('product_form')) {
                var params = {
                    'action': 'save_product',
                    'get_from_form': 'product_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function(respond) {
                                location.href = 'http://' + document.domain + '/products/';
                            });
                    }
                };
                ajax(params);
            } else {
                var error = $(".validate-message.down").first();
                $("a[href='#" + $(error).closest('.tab-pane').attr('id') + "']").tab('show');
                var error_offset = $(error).offset().top - 100;
                $('body').animate( { scrollTop: error_offset }, 200 );
            }
        });

        $("#save_and_continue_btn").click(function()
        {
            if(validate('product_form')) {
                var params = {
                    'action': 'save_product',
                    'get_from_form': 'product_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function(respond) {
                                Notifier.success('Товар успешно сохранен!');
                            });
                    }
                };
                ajax(params);
            } else {
                var error = $(".validate-message.down").first();
                $("a[href='#" + $(error).closest('.tab-pane').attr('id') + "']").tab('show');
                var error_offset = $(error).offset().top - 100;
                $('body').animate( { scrollTop: error_offset }, 200 );
            }
        });

        $("body").on('click', '.delete_image', function()
        {
            var id = $(this).closest('.image_form').attr('data-id');
            $("#delete_image_btn").attr('data-id', id);
        });

        $("body").on('click', '#delete_image_btn', function()
        {
            var id = $(this).attr('data-id');
            $("#product_form").append('<input type="hidden" name="delete_image[]" value="' + id + '">');
            $(".image_form[data-id='" + id + "']").remove();
            $("#delete_image_modal").modal('hide');
        });

        $('.depends').on('ifChecked', function(event){
            var name = $(this).attr('name');
            $(this).closest('tr').find('.depends').each(function()
            {
                if($(this).attr('name') != name) {
                    if ($(this).prop('checked')) {
                        $(this).iCheck('uncheck');
                        $('.null[name="' + $(this).attr('name') + '"]').iCheck('check');
                    }
                }
            });
        });

        $("[name='product[product_name]']").change(function()
        {
            var val = $(this).val();
            $("[name='product[product_key]']").val(transliterate(val));
        });

        $("[name='copy[product_name]']").change(function()
        {
            var val = $(this).val();
            $("[name='copy[product_key]']").val(transliterate(val));
        });

        $('body').on('submit', '#copy_form', function()
        {
            if(validate('copy_form')) {
                var params = {
                    'action': 'save_copy',
                    'get_from_form': 'copy_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function (respond) {
                                $("#product_copies_table").html(respond.template);
                                $("#add_copy_modal").modal('hide');
                            });
                    }
                };
                ajax(params);
            }
            return false;
        })
    });

    function product_image_upload(id)
    {
        var params = {
            name: 'image',
            button: 'product_upload_button_' + id,
            data: {
                'rand': $("#rand").val(),
                'ajax': true,
                'action': 'save_product_img',
                'image_form_id': id,
                'image_name': $("input[name='image[" + id + "][old]']").val() ? $("input[name='image[" + id + "][old]']").val() : ''
            },
            success: function (respond) {
                if (respond.status == 1) {
                    $("#preview_" + id).html('<img src="<?php echo SITE_DIR; ?>tmp/uploaded/' + respond.img + '?' + Math.round(Math.random() * 1000) + '" id="logo_preview">');
                    var image_form = $(".image_form[data-id='" + respond.image_form_id + "']");
                    var next = $(image_form).next();
                    $(image_form).remove();
                    if(!$(next).length) {
                        $("#image_form_container").append(respond.template);
                        $("#image_form_container").append(respond.image_form);
                        $('.icheck').iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal',
                            increaseArea: '20%' // optional
                        });
                        $('.depends').on('ifChecked', function(event){
                            var name = $(this).attr('name');
                            $(this).closest('tr').find('.depends').each(function()
                            {
                                if($(this).attr('name') != name) {
                                    if ($(this).prop('checked')) {
                                        $(this).iCheck('uncheck');
                                        $('.null[name="' + $(this).attr('name') + '"]').iCheck('check');
                                    }
                                }
                            });
                        });
                    } else {
                        $(next).before(respond.template);
                    }
                    var next_id = id + 1;
                    product_image_upload(next_id)
                } else {
                    Notifier.error('Unexpected Error!');
                }
                ajax_file_upload(params);
            },
            error: function (respond) {
                Notifier.error('Unexpected Error!');
            }
        };
        ajax_file_upload(params);
    }

    function copy_product_image_upload(id)
    {
        var params = {
            name: 'copy_image',
            button: 'copy_product_upload_button_' + id,
            data: {
                'rand': $("#copy_rand").val(),
                'ajax': true,
                'action': 'save_copy_product_img',
                'copy_image_form_id': id,
                'copy_image_name': $("input[name='copy_image[" + id + "][old]']").val() ? $("input[name='copy_image[" + id + "][old]']").val() : ''
            },
            success: function (respond) {
                if (respond.status == 1) {
                    var image_form = $(".copy_image_form[data-id='" + respond.image_form_id + "']");
                    var next = $(image_form).next();
                    $(image_form).remove();
                    if(!$(next).length) {
                        $("#copy_image_form_container").append(respond.template);
                        $("#copy_image_form_container").append(respond.image_form);
                        $('.icheck').iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal',
                            increaseArea: '20%' // optional
                        });
                        $('.depends').on('ifChecked', function(event){
                            var name = $(this).attr('name');
                            $(this).closest('tr').find('.depends').each(function()
                            {
                                if($(this).attr('name') != name) {
                                    if ($(this).prop('checked')) {
                                        $(this).iCheck('uncheck');
                                        $('.null[name="' + $(this).attr('name') + '"]').iCheck('check');
                                    }
                                }
                            });
                        });
                    } else {
                        $(next).before(respond.template);
                    }
                    var next_id = id + 1;
                    copy_product_image_upload(next_id)
                } else {
                    Notifier.error('Unexpected Error!');
                }
                ajax_file_upload(params);
            },
            error: function (respond) {
                Notifier.error('Unexpected Error!');
            }
        };
        ajax_file_upload(params);
    }

    function transliterate(text)
    {
        var space = '-';
        var transl = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
            'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
            'А': 'a', 'Б': 'b', 'В': 'v', 'Г': 'g', 'Д': 'd', 'Е': 'e', 'Ё': 'e', 'Ж': 'zh',
            'З': 'z', 'И': 'i', 'Й': 'j', 'К': 'k', 'Л': 'l', 'М': 'm', 'Н': 'n',
            'О': 'o', 'П': 'p', 'Р': 'r','С': 's', 'Т': 't', 'У': 'u', 'Ф': 'f', 'Х': 'h',
            'Ц': 'c', 'Ч': 'ch', 'Ш': 'sh', 'Щ': 'sh','Ъ': '', 'Ы': 'y', 'Ь': '', 'Э': 'e', 'Ю': 'yu', 'Я': 'ya',
            ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
            '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
            '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space,
            ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
            '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
            '?': space, '<': space, '>': space, '№':space
        };

        var result = '';
        var curent_sim = '';

        for(i=0; i < text.length; i++) {
            if(transl[text[i]] != undefined) {
                if(curent_sim != transl[text[i]] || curent_sim != space){
                    result += transl[text[i]].toLowerCase();
                    curent_sim = transl[text[i].toLowerCase()];
                }
            }
            else {
                result += text[i].toLowerCase();
                curent_sim = text[i].toLowerCase();
            }
        }
        result = TrimStr(result);
        return result;
    }

    function TrimStr(s) {
        s = s.replace(/^-/, '');
        return s.replace(/-$/, '');
    }
</script>