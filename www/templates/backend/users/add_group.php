<div class="row">
    <div class="col-xs-2 col-md-1">
        <div class="stat-icon" style="color:#4BAAB7;">
            <i class="fa fa-user-plus fa-3x stat-elem"></i>
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1><?php echo ($_GET['id'] ? 'Редактировать' : 'Добавить'); ?> Группу Пользователей</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <form action="" method="post" id="group_form">
            <div class="form-group">
                <label>Название Группы</label>
                <input type="text" class="form-control" name="group_name" value="<?php echo $group['group_name']; ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-lg" type="submit" name="save_group_btn" value="Сохранить">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function()
    {
        $("#group_form").submit(function()
        {
            if(!$("input[name='group_name']").val() || $("input[name='group_name']").val() == '') {
                alert('Enter Group Name!');
                return false;
            }

            return true;
        });
    });
</script>