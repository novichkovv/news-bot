<div class="row">
    <div class="col-md-12 blue-frame">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject theme-font bold uppercase">Единицы Товаров</span>
                </div>
                <div class="actions">
                    <a href="#unit_modal" data-toggle="modal" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Оприходовать Товар
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
                    </a>
                </div>
            </div>
            <div class="portlet-content">
                <div class="portlet-body">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="unit_modal">
    <div class="modal-dialog">
        <div class="blue-frame">
            <form id="unit_form">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <span class="caption-subject theme-font bold uppercase">Заполните данные</span>
                        </div>
                        <div class="actions">
                            <button class="btn btn-primary" type="submit">Сохранить</button>
                            <a class="btn btn-circle btn-icon-only btn-default close-btn" data-dismiss="modal" aria-hidden="true">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-horizontal form-bordered">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Продукт <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select data-require="1" class="form-control select2" data-placeholder="Выберите Продукт" name="unit[product_id]">
                                            <option value=""></option>
                                            <?php foreach ($products as $product): ?>
                                                <option value="<?php echo $product['id']; ?>">
                                                    <?php echo $product['product_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="error-require validate-message">
                                            Обязательное поле
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Вкус
                                    </label>
                                    <div class="col-md-7">
                                        <select class="form-control select2" id="taste_select" data-placeholder="Выберите Вкус" name="unit[taste_id]">
                                            <option value=""></option>
                                            <?php foreach ($tastes as $taste): ?>
                                                <option value="<?php echo $taste['id']; ?>">
                                                    <?php echo $taste['taste_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-icon btn-default" href="#taste_modal" data-toggle="modal">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Срок годности
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control datepicker" name="unit[expiration_date]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Закупочная цена <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit[cost]">
                                        <div class="error-require validate-message">
                                            Обязательное поле
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Количество
                                    </label>
                                    <div class="col-md-9">
                                        <button type="button" class="btn btn-default btn-minus pull-left">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input style="width: 60px !important;" type="text" data-require="1" name="quantity" value="<?php echo $unit['quantity'] ? $unit['quantity'] : 0; ?>" class="form-control pull-left countable">
                                        <button type="button" class="btn btn-default btn-plus pull-left">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <div class="error-require validate-message">
                                            Обязательное поле
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
<div class="modal fade" id="taste_modal">
    <div class="modal-dialog">
        <div class="blue-frame">
            <form id="taste_form">
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
                                        <input class="form-control" type="text"  name="taste[taste_name]">
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
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $(".select2").select2();
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#taste_form").submit(function()
        {
            if(validate('taste_form')) {
                var params = {
                    'action': 'save_taste',
                    'get_from_form': 'taste_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function (respond) {
                                $("#taste_select").append('<option value="' + respond.id + '">' + respond.taste_name + '</option>');
                                $("#taste_select").val(respond.id).trigger('change');
                                $("#taste_modal").modal('hide');
                            });
                    }
                };
                ajax(params);
            }
            return false;
        });
        $("#unit_form").submit(function()
        {
            if(validate('unit_form')) {
                var params = {
                    'action': 'save_unit',
                    'get_from_form': 'unit_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function (respond) {
                                $("#unit_modal").modal('hide');
                                document.getElementById('unit_form').reset();
                            });
                    }
                };
                ajax(params);
            }
            return false;
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

    });
</script>

