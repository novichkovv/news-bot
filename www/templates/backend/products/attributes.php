<div class="row">
    <div class="col-xs-2 col-md-1">
        <div class="stat-icon" style="color:#4BAAB7;">
            <i class="fa fa-user-plus fa-3x stat-elem"></i>
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1>Аттрибуты</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <a href="#add_attribute_modal" class="btn btn-info" data-toggle="modal">Добавить Аттрибут</a>
    </div>
</div>
<div class="row">
    <div class="col-md-10 custom-datatable">
        <table class="table table-bordered" id="get_attributes_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Ключ</th>
                <th>Тип</th>
                <th>Обязательный</th>
                <th>Особый</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="delete_attribute_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удалить Аттрибут</h4>
            </div>
            <div class="modal-body">
                <p>Вы уверены?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input name="delete_id" id="delete_input" type="hidden" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                    <button type="submit" name="delete_btn" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_attribute_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="attribute_modal_title"></span> </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">Название</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="attribute[attribute_name]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Ключ</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="attribute[attribute_key]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Тип</label>
                    <div class="col-md-6">
                        <select name="attribute[attribute_type]" class="form-control">
                            <?php foreach ($attribute_types as $type): ?>
                                <option value="<?php echo $type['type_name']; ?>">
                                    <?php echo $type['type_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input name="delete_id" id="delete_input" type="hidden" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                    <button type="submit" name="delete_btn" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {

    });
</script>