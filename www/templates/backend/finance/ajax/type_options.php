<option value="0">Без Типа</option>
<?php foreach ($types as $type): ?>
    <option value="<?php echo $type['id']; ?>" <?php if ($selected_type == $type['id']) echo 'selected' ?>>
        <?php echo $type['type_name']; ?>
    </option>
<?php endforeach; ?>