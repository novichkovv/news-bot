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