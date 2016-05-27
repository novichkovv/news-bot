<body class="page-header-menu-fixed">
    <div class="page-header">
    <!-- BEGIN HEADER TOP -->
        <div class="page-header-top">
            <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?php echo SITE_DIR; ?>">
                    <img style="width: 100px;" s src="<?php echo SITE_DIR . 'images/main/logo200.png'; ?>" alt="1num.ru" class="logo-default">
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                    <li class="droddown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <?php if(0): ?>
                        <li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="circle">3</span>
                                <span class="corner"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have <strong>7 New</strong> Messages</h3>
                                    <a href="javascript:;">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="inbox.html?a=view">
                                                            <span class="photo">
                                                            <img src="<?php echo SITE_DIR; ?>images/backend/avatar.png" class="img-circle" alt="">
                                                            </span>
                                                            <span class="subject">
                                                            <span class="from">
                                                            Lisa Wong </span>
                                                            <span class="time">Just Now </span>
                                                            </span>
                                                            <span class="message">
                                                            Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="inbox.html?a=view">
                                                            <span class="photo">
                                                            <img src="<?php echo SITE_DIR; ?>images/backend/avatar.png" class="img-circle" alt="">
                                                            </span>
                                                            <span class="subject">
                                                            <span class="from">
                                                            Richard Doe </span>
                                                            <span class="time">16 mins </span>
                                                            </span>
                                                            <span class="message">
                                                            Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="inbox.html?a=view">
                                                            <span class="photo">
                                                            <img src="<?php echo SITE_DIR; ?>images/backend/avatar.png" class="img-circle" alt="">
                                                            </span>
                                                            <span class="subject">
                                                            <span class="from">
                                                            Bob Nilson </span>
                                                            <span class="time">2 hrs </span>
                                                            </span>
                                                            <span class="message">
                                                            Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="inbox.html?a=view">
                                                            <span class="photo">
                                                            <img src="<?php echo SITE_DIR; ?>images/backend/avatar.png" class="img-circle" alt="">
                                                            </span>
                                                            <span class="subject">
                                                            <span class="from">
                                                            Lisa Wong </span>
                                                            <span class="time">40 mins </span>
                                                            </span>
                                                            <span class="message">
                                                            Vivamus sed auctor 40% nibh congue nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="inbox.html?a=view">
                                                            <span class="photo">
                                                            <img src="<?php echo SITE_DIR; ?>images/backend/avatar.png" class="img-circle" alt="">
                                                            </span>
                                                            <span class="subject">
                                                            <span class="from">
                                                            Richard Doe </span>
                                                            <span class="time">46 mins </span>
                                                            </span>
                                                            <span class="message">
                                                            Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo SITE_DIR; ?>images/backend/avatar.png">
                            <span class="username username-hide-mobile"><?php echo registry::get('user')['user_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo SITE_DIR; ?>profile/">
                                    <i class="icon-user"></i> Профиль</a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="#" onclick="document.getElementById('logout_form').submit();">
                                    <i class="icon-key"></i> Выйти
                                </a>
                            </li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-header-menu">
            <div class="container">
                <form class="search-form" action="extra_search.html" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="query">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <div class="hor-menu ">
                    <ul class="nav navbar-nav">
                    <?php if($sidebar): ?>
                        <?php foreach($sidebar as $k => $v): ?>
                            <li class="<?php if(registry::get('route_parts')[0] == $v['route']) echo 'active'; if($v['children']) echo ' menu-dropdown mega-menu-dropdown'; ?>">
                                <a
                                    <?php if ($v['children']): ?>
                                    data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="#" class="dropdown-toggle"
                                    <?php endif; ?>
                                    <?php if (!$v['children']): ?>
                                    <?php endif; ?>>
                                    <?php if($v['icon']) echo '<i class="' . $v['icon'] . '"></i>'; ?>
                                    <span><?php echo $v['title']; ?></span>
                                </a>
                                <?php if($v['children']): ?>
                                    <ul class="dropdown-menu" style="min-width: 100px">
                                        <li>
                                            <div class="mega-menu-content">
                                                <div class="row">
                                                    <?php foreach($v['children'] as $child): ?>
                                                    <ul class="mega-menu-submenu">
                                                        <li>
                                                            <a href="<?php echo SITE_DIR . $child['route']; ?>/">
                                                                <i class="<?php echo $child['icon']; ?>"></i>
                                                                <?php echo $child['title']; ?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
                </div>
            <!-- END MEGA MENU -->
            </div>
        </div>
    </div>
    <?php if ($log): ?>
        <div id="log">
           <pre>
               <?php foreach ($log as $line): ?>
                   <?php echo $line; ?>
                   <hr>
               <?php endforeach; ?>
           </pre>
        </div>
        <div id="log-button">
        </div>
    <?php endif; ?>
    </header>
    <div class="page-container">
        <?php if ($breadcrumbs): ?>
            <?php echo $breadcrumbs; ?>
        <?php endif; ?>
        <div class="page-content">
            <div class="container">

