<div class="row">
    <div class="col-xs-2 col-md-1">
        <div class="stat-icon" style="color:#4BAAB7;">
            <i class="fa fa-users fa-3x stat-elem"></i>
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1>Группы Пользователей</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($groups as $group): ?>
                <tr>
                    <td><?php echo $group['id']; ?></td>
                    <td><?php echo $group['group_name']; ?></td>
                    <th>
                        <a href="<?php echo SITE_DIR; ?>users/add_group/?id=<?php echo $group['id']; ?>" class="btn btn-default btn-icon">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="#delete_group_modal" class="btn btn-default btn-icon delete_group" data-id="<?php echo $group['id']; ?>" data-toggle="modal" role="button">
                            <span class="text-danger glyphicon glyphicon-remove-circle"></span>
                        </a>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="delete_group_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удалить Группу Пользователей</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
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
    $("body").on("click", ".delete_group", function()
    {
        var id = $(this).attr('data-id');
        $("#delete_input").val(id);
    });
</script>