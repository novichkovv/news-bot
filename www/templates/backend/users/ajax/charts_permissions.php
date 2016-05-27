<form class="permissions_form" id="permissions_form_2">
    <div class="row">
        <div class="col-xs-12">
            <?php foreach($result as $user_group_id => $v): ?>
                <div class="col-md-3 col-sm-6">
                    <h3><?php echo $v['group_name']; ?></h3>
                    <ul style="">
                        <?php foreach($v['charts'] as $chart): ?>
                            <li>
                                <div class="checkbox">
                                    <div class="squaredFour">
                                        <input type="checkbox" id="squaredFour_2_<?php echo $user_group_id; ?>_<?php echo $chart['id']; ?>"  name="permission[2][<?php echo $user_group_id; ?>][<?php echo $chart['id']; ?>]" value="<?php echo $chart['id']; ?>" <?php if($chart['checked']) echo 'checked'; ?> class="parent_perm styled-checkbox">
                                        <label for="squaredFour_2_<?php echo $user_group_id; ?>_<?php echo $chart['id']; ?>"></label>
                                    </div>
                                    <span class="styled-checkbox-label"><?php echo $chart['chart_name']; ?></span>
                                </div>
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
            <input class="btn btn-info btn-lg btn-big" type="submit" name="save_permissions_btn" value="Save">
        </div>
    </div>
</form>