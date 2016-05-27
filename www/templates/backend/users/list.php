<div class="row">
    <div class="col-xs-2 col-md-1">
        <div class="stat-icon" style="color:#4BAAB7;">
            <i class="fa fa-user fa-3x stat-elem"></i>
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1>Сотрудники</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-10 custom-datatable">
        <table class="table table-bordered" id="get_users_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Группа Пользователей</th>
                <th>Email</th>
                <th>Дата Создания</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="delete_user_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удалить Сотрудника</h4>
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
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function() {
        ajax_datatable('get_users_table');
        $("body").on("click", ".delete_user", function()
        {
            var id = $(this).attr('data-id');
            $("#delete_input").val(id);
        });
    });
</script>