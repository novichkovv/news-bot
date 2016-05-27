<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject theme-font bold uppercase">Доступы пользователей приложения</span>
                </div>
            </div>
            <div class="portlet-content">
                <div class="row permissions-list">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a data-toggle="tab" href="#system_routes">
                                <i class="fa fa-gear"></i>
                                Система
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#charts">
                                <i class="fa fa-bar-chart"></i>
                                Dashboard
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="background: none;">
                        <div id="system_routes" class="tab-pane active blue-frame">
                            <form class="permissions_form" id="permissions_form_1">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Основные данные
                                        </div>
                                        <div class="actions">
                                            <input type="submit" name="save_permissions_btn" value="Сохранить" class="btn btn-primary">
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <?php foreach($result as $user_group_id => $v): ?>
                                                    <div class="col-md-3 col-sm-6">
                                                        <h3><?php echo $v['group_name']; ?></h3>
                                                        <ul  class="list-style-none">
                                                            <?php foreach($v['routes'] as $route): ?>
                                                                <li>
                                                                    <div class="checkbox">
                                                                        <input type="checkbox" class="icheck" id="squaredFour_1_<?php echo $user_group_id; ?>_<?php echo $route['id']; ?>"  name="permission[1][<?php echo $user_group_id; ?>][<?php echo $route['id']; ?>]" value="<?php echo $route['id']; ?>" <?php if($route['checked']) echo 'checked'; ?> class="parent_perm styled-checkbox">
                                                                        <span class="styled-checkbox-label"><?php echo $route['title']; ?></span>
                                                                    </div>
                                                                    <?php if($route['children']): ?>
                                                                        <ul class="list-style-none">
                                                                            <?php foreach($route['children'] as $child): ?>
                                                                                <li>
                                                                                    <div class="checkbox">
                                                                                        <input type="checkbox" class="icheck" id="squaredFour_1_<?php echo $user_group_id; ?>_<?php echo $child['id']; ?>"  name="permission[1][<?php echo $user_group_id; ?>][<?php echo $child['id']; ?>]" value="<?php echo $child['id']; ?>" <?php if($child['checked']) echo 'checked'; ?> class="child_perm styled-checkbox">
                                                                                        <span class="styled-checkbox-label"><?php echo $child['title']; ?></span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <hr class="hr-dark-blue">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input class="btn btn-primary" type="submit" name="save_permissions_btn" value="Сохранить">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="charts" class="tab-pane">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function(){
        $(".parent_perm").change(function(){
            if(!$(this).prop('checked')) {
                $(this).closest('li').find('.child_perm').each(function()
                {
                    $(this).prop('checked', false);
                })
            } else {
                $(this).closest('li').find('.child_perm').each(function()
                {
                    $(this).prop('checked', true);
                })
            }
        });
        $('.child_perm').change(function() {
            if($(this).prop('checked')) {
//                if($(this).closest('li').closest('li').find('.parent_perm').prop('checked', false)) {
                $(this).closest('ul').closest('li').find('.parent_perm').prop('checked', true);
//                }
            }
        });
        $('[data-toggle="tab"]').click(function(){
            var part = $(this).attr('href').substr(1);
            var params = {
                'action': 'get_' + part + '_permissions',
                callback: function(msg) {
                    $("#" + part).html(msg);
                }
            };
            if(!$("#" + part).children().length) {
                ajax(params);
            }
        });
        $("body").on("submit", ".permissions_form", function(e)
        {
            e.preventDefault();
            var form_id = $(this).attr('id');
            var params = {
                action: 'save_permission',
                get_from_form: form_id,
                callback: function(msg) {
                    try {
                        var respond = JSON.parse(msg);
                    }
                    catch (e) {
                        Notifier.error('Не Сохранено', 'Непредвиденная Ошибка!');
                        return false;
                    }
                    if (respond.status == 1) {
                        Notifier.success('Информация Сохранена', 'Успешно!');
                    } else {
                        Notifier.error('Не Сохранено', 'Непредвиденная Ошибка!');
                    }
                }
            };
            ajax(params);
        });
    });
</script>