<div class="row">
    <div class="col-md-12 blue-frame">
        <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject theme-font bold uppercase">Список товаров</span>
                    </div>
                    <div class="actions">
                        <a href="<?php echo SITE_DIR; ?>products/add/" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить Товар</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
                        </a>
                    </div>
                </div>
                <div class="portlet-content">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 custom-datatable table-scrollable">
                                <table class="table table-bordered table-striped" id="get_list">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Название</th>
                                        <th>Ключ</th>
                                        <th>Активный</th>
                                        <th>Создан</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        ajax_datatable('get_list');
        $(".fancybox").fancybox();
        $("body").on('click', '.delete_product', function()
        {
            var id = $(this).attr('data-id');
            confirm_delete(id, 'products', function() {
                ajax_datatable('get_list');
            }, '', '', false, 'delete_product');
        })
    });
</script>