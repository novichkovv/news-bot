<aside class="left-side sidebar-offcanvas<?php if(!$sidebar) echo ' collapse-left'; ?>">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <?php if($sidebar): ?>
                <?php foreach($sidebar as $k => $v): ?>
                    <li <?php if(registry::get('route_parts')[0] == $v['route']) echo 'class="active"' ?>>
                        <?php if(!$v['children']): ?>
                        <a href="<?php echo ($v['external'] ? '' : SITE_DIR ) . ($v['route'] ? $v['route'] .'/' : '') ; ?>">
                            <?php endif; ?>
                            <?php if($v['children']): ?>
                            <a href="#" class="expand">
                                <?php endif; ?>
                                <!--                    <a href="--><?php //echo SITE_DIR . $v['route']; ?><!--/">-->
                                <?php if($v['icon']) echo '<i class="' . $v['icon'] . '"></i>'; ?>
                                <span><?php echo $v['title']; ?></span>
                            </a>
                            <?php if($v['children']): ?>
                                <ul class="sub-menu">
                                    <?php foreach($v['children'] as $child): ?>
                                        <li>
                                            <a href="<?php echo SITE_DIR . $child['route']; ?>/">
                                                <i class="<?php echo $child['icon']; ?>"></i>
                                                <?php echo $child['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
</aside>
<aside class="right-side<?php if(!$sidebar) echo ' strech'; ?>">
    <section class="content">