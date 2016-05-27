<td>
    <img style="max-width: 100px; max-height: 100px;" src="<?php echo SITE_DIR; ?>tmp/uploaded/<?php echo $image_name . '?' . rand(); ?>"
</td>
<td>
    <input type="radio" name="product[image][main]" value="1">
</td>
<td>
    <input type="radio" name="product[image][small]" value="1">
</td>
<td>
    <input type="checkbox" name="product[image][usual][]" value="1">
</td>
<td>
    <button class="btn btn-default btn-icon" type="button">
        <i class="fa fa-remove text-danger"></i>
    </button>
</td>