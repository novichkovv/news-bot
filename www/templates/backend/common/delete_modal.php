<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удаление <span id="delete_modal_title"><?echo $delete_modal_title; ?></span></h4>
            </div>
            <div class="modal-body with-padding">
                <p id="delete_modal_text">Вы уверены что хотите удалить<span id="delete_modal_item"><?echo $delete_modal_item; ?></span>?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="delete_id_input" id="delete_id_input">
                <input type="hidden" name="delete_table" id="delete_table">
                <button type="button" id="delete_item_btn" class="btn btn-primary">Удалить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
            </div>
        </div>
    </div>
</div>