<div class="row">
    <div class="col-md-3">
        <a href="#add_outcome_modal" data-toggle="modal" class="btn btn-lg btn-danger"><i class="fa fa-minus"></i> Внести расход</a>
    </div>
    <div class="col-md-3">
        <a href="#add_income_modal" data-toggle="modal" class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Внести приход</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                <h3 class="panel-title">Таблица Прихода/Расхода</h3>
            </div>
            <div class="panel-body custom-datatable">
                <table class="table table-bordered" id="finance_streams_table">
                    <thead>
                    <tr>
                        <td>
                            <select data-placeholder="Тип" data-sign="=" name="s.stream_type" class="form-control select-search filter-field" tabindex="2">
                                <option value="">Все</option>
                                <option value="1">Приход</option>
                                <option value="2">Расход</option>
                            </select>
                        </td>
                        <td>
                            <select data-placeholder="Тип" data-sign="=" name="s.type_id" class="form-control select-search filter-field" tabindex="2">
                            <?php if ($stream_types): ?>
                                <option value="">Все</option>
                                <?php foreach ($stream_types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>">
                                        <?php echo $type['type_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Вид</th>
                        <th>Тип</th>
                        <th>Описание</th>
                        <th>Сотрудник</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_outcome_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal add_stream_form" id="add_outcome_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Добавить Расход</h4>
                </div>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Тип
                        </label>
                        <div class="col-md-5">
                            <select class="form-control type_select" name="stream[type_id]">
                                <option value="0">Без Типа</option>
                                <?php if ($stream_types): ?>
                                    <?php foreach ($stream_types as $type): ?>
                                        <option value="<?php echo $type['type_id']; ?>">
                                            <?php echo $type['type_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <a href="#add_outcome_type_modal" class="btn btn-info" data-toggle="modal">
                                <i class="fa fa-plus"> Добавить тип</i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Комментарии</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="stream[custom_comment]"></textarea>
                            <div class="validate-message error-comment">
                                Комментарий обязателен для расхода без типа
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Сумма</label>
                        <div class="col-md-9">
                            <input type="text" data-require="1" data-validate="numeric" class="form-control" name="stream[stream_sum]">
                            <div class="validate-message error-require">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="stream[stream_type]" value="2">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add_outcome_type_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal stream_type_form" id="outcome_type_form" data-parent="add_outcome_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Добавить Тип Расхода</h4>
                </div>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Название Типа
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="type[type_name]" class="form-control" data-require="1">
                            <div class="error-require validate-message">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Комментарии
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="type[type_comment]" data-require="1"></textarea>
                            <div class="error-require validate-message">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type[stream_type]" value="2">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add_income_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal add_stream_form" id="add_income_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Добавить приход</h4>
                </div>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Тип
                        </label>
                        <div class="col-md-5">
                            <select class="form-control type_select" name="stream[type_id]">
                                <option value="0">Без Типа</option>
                                <?php if ($stream_types): ?>
                                    <?php foreach ($stream_types as $type): ?>
                                        <option value="<?php echo $type['type_id']; ?>">
                                            <?php echo $type['type_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <a href="#add_income_type_modal" class="btn btn-info" data-toggle="modal">
                                <i class="fa fa-plus"> Добавить тип</i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Комментарии</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="stream[custom_comment]"></textarea>
                            <div class="validate-message error-comment">
                                Комментарий обязателен для прихода без типа
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Сумма</label>
                        <div class="col-md-9">
                            <input type="text" data-require="1" data-validate="numeric" class="form-control" name="stream[stream_sum]">
                            <div class="validate-message error-require">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="stream[stream_type]" value="1">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add_income_type_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal stream_type_form" id="income_type_form" data-parent="add_income_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Добавить Тип прихода</h4>
                </div>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Название Типа
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="type[type_name]" class="form-control" data-require="1">
                            <div class="error-require validate-message">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Комментарии
                        </label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="type[type_comment]" data-require="1"></textarea>
                            <div class="error-require validate-message">
                                Обязательное Поле
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type[stream_type]" value="1">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    ajax_datatable('finance_streams_table');
    $(document).ready(function () {
        $('.add_stream_form').submit(function()
        {
            var modal = $(this).closest('.modal');
            var form_id = $(this).attr('id');
            if(validate(form_id)) {
                if($(modal).find("[name='stream[type_id]']").val() == '0' && !$(modal).find("[name='stream[custom_comment]']").val()) {
                    $(".error-comment").slideDown();
                } else {
                    var params = {
                        'action': 'save_stream',
                        'get_from_form': form_id,
                        'callback': function (msg) {
                            ajax_respond(msg,
                                function() {
                                    Notifier.success('Данные успешно внесены');
                                    $(modal).modal('hide');
                                },
                                function()
                                {
                                    Notifier.error('Неизвестная Ошибка!');
                                })
                        }
                    };
                    ajax(params);
                }
            }
            return false;
        });

        $('.stream_type_form').submit(function()
        {
            var modal = $(this).closest('.modal');
            var parent = $(this).attr('data-parent');
            var form_id = $(this).attr('id');
            if(validate(form_id)) {
                var params = {
                    'action': 'save_stream_type',
                    'get_from_form': form_id,
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function(respond) {
                                Notifier.success('Данные успешно внесены');
                                $("#" + parent).find('.type_select').html(respond.options);
                                $(modal).modal('hide');
                            },
                            function()
                            {
                                Notifier.error('Неизвестная Ошибка!');
                            })
                    }
                };
                ajax(params);
            }
            return false;
        })
    });
</script>
