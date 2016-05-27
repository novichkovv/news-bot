<div class="row">
    <div class="col-md-12 blue-frame">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject theme-font bold uppercase">Категории</span>
                </div>
                <div class="actions">
                    <a data-toggle="modal" id="add_category" href="#add_category_modal" class="btn btn-primary">Добавить категорию</a>
                    <?php if ($_GET['id']): ?>
                        <input type="button" id="save_and_continue_btn" value="Сохранить и продолжить" class="btn btn-info">
                    <?php endif; ?>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
                    </a>
                </div>
            </div>
            <div class="portlet-content" >
                <div class="row">
                    <div class="col-md-8">
                        <form method="post" action="">
                            <div class="row">
                                <div class="dd" style="margin: -20px 20px 0;">
                                    <ol class="dd-list" id="active_categories">
                                        <?php foreach ($categories as $category): ?>
                                            <li class="dd-item" data-id="<?php echo $category['id']; ?>">
                                                <div class="dd-handle"><?php echo $category['category_name']; ?></div>
                                                <a style="padding: 6px 0;" class="btn btn-xs nestable-edit inactivate_category">
                                                    <i class="fa text-danger fa-remove"></i>
                                                </a>
                                                <a style="padding: 6px 0;" class="btn btn-icon nestable-delete edit_category" href="#add_category_modal" data-toggle="modal">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <?php if ($child = $category['children']): ?>
                                                    <?php require(TEMPLATE_DIR . DS . 'products' . DS . 'nested_category.php'); ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel panel-heading">
                                <h3 class="panel-title">Неактивные Категории</h3>
                            </div>
                            <div class="panel-body">
                                <table style="width: 100%;" border="0" id="inactive_categories">
                                    <?php foreach ($inactive_categories as $category): ?>
                                        <tr class="inactive_category" data-id="<?php echo $category['id']; ?>" style="border-bottom: 1px solid #eee;">
                                            <td style="width: 35px;">
                                                <button class="btn btn-xs btn-default activate_category">
                                                    <i class="fa fa-long-arrow-left"></i>
                                                </button>
                                            </td>
                                            <td class="inactive_category_name"><?php echo $category['category_name']; ?></td>
                                            <td class="text-right" style="width: 75px;">
                                                <button class="btn btn-xs btn-default delete_category" data-target="#delete_modal" data-toggle="modal">
                                                    <i class="fa text-warning fa-remove"></i>
                                                </button>
                                                <a class="btn btn-xs btn-default edit_category" data-target="#add_category_modal" data-toggle="modal">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_category_modal">
    <div class="modal-dialog">
        <div class="modal-content  blue-frame" id="category_form_container">

        </div>
    </div>
</div>

<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $('.dd').nestable({maxDepth:5});
        $('body').on('change', '.dd', function(){
            setTimeout(function()
            {
                var order = $('.dd').nestable('serialize');
                var params = {
                    'action': 'serialize',
                    'values': {'order': order},
                    callback: function (msg) {

                    }
                };
                ajax(params);
            },1000);
        });

        $("#add_category").click(function()
        {
            getCategoryForm(0);
        });

        $("body").on('submit', "#category_form", function()
        {
            if(validate('category_form') && $("#key_unique_error").css('display') == 'none') {
                var params = {
                    'action': 'save_category',
                    'get_from_form': 'category_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function(respond){
                                if(respond.active) {
                                    if($('.dd-item[data-id="' + respond.category_id + '"]').length) {
                                        $('.dd-item[data-id="' + respond.category_id + '"]').children('.dd-handle').html(respond.category_name);
                                    } else {
                                        $(".dd").children('.dd-list').append(respond.template);
                                    }
                                    $('.dd').nestable({maxDepth:5});
                                } else {
                                    if($("tr[data-id='" + respond.category_id + "']").length) {
                                        $("tr[data-id='" + respond.category_id + "']").find('.inactive_category_name').html(respond.category_name);
                                    } else {
                                        $("#inactive_categories").append(respond.template);
                                    }
                                }
                                $("#add_category_modal").modal('hide');
                            }
                        );
                    }
                };
                ajax(params);
            }
            return false;
        });

        $('body').on('click', ".edit_category", function()
        {
            var category_id;
            var dd = $(this).closest('.dd-item');
            if ($(dd).length) {
                category_id = $(dd).attr('data-id');
            } else {
                category_id = $(this).closest('tr').attr('data-id');
            }
            getCategoryForm(category_id);
        });

        $('body').on('click', '.activate_category', function()
        {
            var item = $(this).closest('tr');
            var id = $(item).attr('data-id');
            var params = {
                'action': 'activate_category',
                'values': {id: id},
                'callback': function (msg) {
                    ajax_respond(msg,
                        function (respond) {
                            $(item).remove();
                            $("#active_categories").append(respond.template);
                            $('.dd').nestable({maxDepth:5});
                        });
                }
            };
            ajax(params);
        });


        $('body').on('click', ".inactivate_category", function()
        {
            var item = $(this).closest('.dd-item');
            var category_id = $(item).attr('data-id');
            var category_name = $(item).find('.dd-handle').html();
            var array = new Object();
            array[category_id] = category_name;
            $(item).find('.dd-item').each(function()
            {
                var category_id = $(this).attr('data-id');
                var category_name = $(this).find('.dd-handle').html();
                if (category_id) {
                    array[category_id] = category_name;
                }
                var item = $(this);
                $(this).find('.dd-item').each(function() {
                    recursion($(item), array);
                });
            });
            $(item).remove();
            var params = {
                'action': 'get_inactive_category',
                'values': {categories: array},
                'callback': function (msg) {
                    ajax_respond(msg,
                        function(respond) {
                            $("#inactive_categories").append(respond.template);
                        }
                    );
                }
            };
            ajax(params);
        });

        $("body").on('click', '.delete_category', function()
        {
            var item = $(this).closest('tr');
            var id = $(item).attr('data-id');
            confirm_delete(id, 'categories', function()
            {
                $(item).remove();
                Notifier.success('Категория удалена успешно!');
            }, '', '', true, 'delete_category');
        });

        $("body").on('change', '#category_key', function()
        {
            var value = $(this).val();
            var error_message = $("#key_unique_error");
            $(error_message).slideUp();
            if(value) {
                var params = {
                    'action': 'check_unique_category_key',
                    'values': {category_key: value},
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function(respond){},
                            function(respond) {
                                $(error_message).slideDown();
                            }
                        );
                    }
                };
                ajax(params);
            }
        })
    });
     function recursion(item, array)
     {
         $(item).find('.dd-item').each(function()
         {
             var category_id = $(this).attr('data-id');
             var category_name = $(this).find('.dd-handle').html();
             if (category_id) {
                 array[category_id] = category_name;
             }
             var item = $(this);
             $(this).find('.dd-item').each(function() {
                 recursion($(item), array);
             });
         });
     }

    function getCategoryForm(category_id)
    {
        var params = {
            'action': 'get_category_form',
            'values': {category_id: category_id},
            'callback': function (msg) {
                ajax_respond(msg,
                    function(respond) {
                        $("#category_form_container").html(respond.template);
                        var params = {
                            name: 'category[image]',
                            data: {'rand': $("#rand").val(), 'ajax': true, 'action': 'save_category_img'},
                            success: function (respond) {
                                if (respond.status == 1) {
                                    $("#preview").html('<img src="<?php echo SITE_DIR; ?>tmp/uploaded/' + respond.img + '?' + Math.round(Math.random() * 1000) + '" id="logo_preview">');
                                    $("#category_image_hidden_input").val(respond.img);
                                } else {
                                    Notifier.error('Unexpected Error!');
                                }
                                ajax_file_upload(params);
                            },
                            error: function (respond) {
                                Notifier.error('Unexpected Error!');
                                $('a[href="#tab_0"]').tab('show');
                            }
                        };
                        ajax_file_upload(params);
                    }
                );
            }
        };
        ajax(params);
    }
</script>